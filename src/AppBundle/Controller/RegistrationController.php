<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 15/07/15
 * Time: 18:53
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Registration;
use AppBundle\Entity\Participant;
use AppBundle\Event\RegistrationEvent;
use AppBundle\Event\RegistrationEvents;
use AppBundle\Form\ParticipantType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;


class RegistrationController extends Controller
{
    private function getRegistration()
    {
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $user = $this->getUser();
        $registration = $this->getDoctrine()->getRepository('AppBundle:Registration')->findOneBy(array('user' => $user, 'convention' => $convention));
        return $registration;
    }

    private function setRegistrationStatus(Registration $registration, $status)
    {
        $registration->setStatus($status);
        $em = $this->getDoctrine()->getManager();
        $em->persist($registration);
        $em->flush();
    }

    /**
     * @Route("/inscripciones", name="registration_list")
     * @Template("Registration/my_registrations.html.twig")
     * Muestra todas las inscripciones del usuario
     */
    public function showRegistrations()
    {
        $user = $this->getUser();
        $registrations_open = $this->getDoctrine()->getRepository('AppBundle:Registration')->findAll();
        return [
            'user'=> $user,
            'registrations_open'=> $registrations_open,
        ];
    }

    /**
     * @Route("/confirmar_registro", name="registration_confirmed")
     * Manda el evento para confirmar el registro
     */
    public function confirmedRegistrationAction(Request $request)
    {
        $registration = $this->getRegistration();
        if ($registration->getStatus()==Registration::STATUS_OPEN)
        {
            $this->setRegistrationStatus($registration, Registration::STATUS_CONFIRMED);
            $this->container->get('event_dispatcher')->dispatch(RegistrationEvents::CONFIRMED, new RegistrationEvent($registration));
        }


        return $this->redirectToRoute('registration');
    }

    /**
     * @Route("/abrir_registro", name="registration_open")
     * Manda el evento para abrir el registro
     */
    public function openRegistrationAction(Request $request)
    {
        $registration = $this->getRegistration();
        if ($registration->getStatus()==Registration::STATUS_CONFIRMED)
        {
            $this->setRegistrationStatus($registration, Registration::STATUS_OPEN);
            $this->container->get('event_dispatcher')->dispatch(RegistrationEvents::OPEN, new RegistrationEvent($registration));
        }
        return $this->redirectToRoute('registration');
    }

    /**
     * @Route("/registro", name="registration")
     * Muestra pantalla de edición del registro
     */
    public function registrationAction(Request $request)
    {
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $registration = $this->getRegistration();
        $user = $this->getUser();

        if (!$registration)
        {
            return $this->redirectToRoute('sylius_flow_start', array('scenarioAlias' => 'asamblea'));
        }
        $participant = new Participant();

        $types = $this->getDoctrine()->getRepository('AppBundle:ParticipantType')->findParticipationsTypesAvailables($convention);
        $participant = new Participant();
        $participant->setRegistration($registration);
        $form = $this->createForm($this->get('ritsiga.participant.form.type'), $participant);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $participant_type = $this->getDoctrine()->getRepository('AppBundle:ParticipantType')->findOneBy(array('id' => $form["participant_type"]->getData()));
            $num_participants = $this->getDoctrine()->getRepository('AppBundle:Participant')->getNumParticipationsTypesAvailables($registration,$participant_type);
            if ($participant_type && ($participant_type->getNumParticipants() > $num_participants))
            {
                $participant->setParticipantType($participant_type);
                $em = $this->getDoctrine()->getManager();
                $em->persist($participant);
                $em->flush();
            }
            else
            {
                $this->addFlash('warning', $this->get('translator')->trans( 'Sorry, the seats are already occupied'));
            }

        }
        if ($registration->getStatus()==Registration::STATUS_OPEN)
        {
            return $this->render(':Registration:registration_open.html.twig', array(
                'user'=> $user,
                'registration' => $registration,
                'types' => $types,
                'form'=> $form->createView(),
            ));
        }
        if ($registration->getStatus()==Registration::STATUS_CONFIRMED)
        {
            return $this->render(':Registration:registration_confirmed.html.twig', array(
                'user'=> $user,
                'registration' => $registration,
            ));
        }

    }

}
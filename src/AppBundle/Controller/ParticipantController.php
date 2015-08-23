<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 23/08/15
 * Time: 20:26
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Participant;
use AppBundle\Entity\ParticipantType;
use AppBundle\Entity\Registration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class ParticipantController
 * @package AppBundle\Controller
 * @Route(path="/convention/{code}")
 */
class ParticipantController extends Controller
{


    /**
     * @Route("/nueva-inscripcion/{participanttype}", name="participant_new")
     * Muestra pantalla de nueva inscripción
     */
    public function newParticipantAction(Request $request, \AppBundle\Entity\ParticipantType $participanttype)
    {
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $user = $this->getUser();
        $registration = $this->getDoctrine()->getRepository('AppBundle:Registration')->findOneBy(array('user' => $user, 'convention' => $convention));

        $user = $this->getUser();

        if (!$registration)
        {
            return $this->redirectToRoute('sylius_flow_start', array('scenarioAlias' => 'asamblea'));
        }
        if ($registration->getStatus()!=Registration::STATUS_OPEN)
        {
            return $this->redirectToRoute('registration');
        }

        $participant = new Participant();

        $participant->setRegistration($registration);
        $form = $this->createForm($this->get('ritsiga.participant.form.type'), $participant);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $num_participants = $this->getDoctrine()->getRepository('AppBundle:Participant')->getNumParticipationsTypesAvailables($registration,$participanttype);
            if ($participanttype && ($participanttype->getNumParticipants() > $num_participants))
            {
                $participant->setParticipantType($participanttype);
                $em = $this->getDoctrine()->getManager();
                $em->persist($participant);
                $em->flush();
                return $this->redirectToRoute('registration');
            }
            else
            {
                $this->addFlash('warning', $this->get('translator')->trans( 'Sorry, the seats are already occupied'));
                return $this->redirectToRoute('registration');
            }

        }
        return $this->render(':frontend/registration:participant.html.twig', array(
            'user'=> $user,
            'registration' => $registration,
            'form'=> $form->createView(),
        ));

    }


    /**
     * @Route("/editar-inscripcion/{id}", name="participant_edit")
     * Muestra pantalla de edición de un participante
     */
    public function editParticipantAction(Request $request, Participant $participant)
    {
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $user = $this->getUser();
        $registration = $this->getDoctrine()->getRepository('AppBundle:Registration')->findOneBy(array('user' => $user, 'convention' => $convention));
        $participanttype = $participant->getParticipantType();
        if (!$registration)
        {
            return $this->redirectToRoute('sylius_flow_start', array('scenarioAlias' => 'asamblea'));
        }
        if ($registration->getStatus()!=Registration::STATUS_OPEN || $participant->getRegistration() != $registration)
        {
            return $this->redirectToRoute('registration');
        }
        $form = $this->createForm($this->get('ritsiga.participant.form.type'), $participant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $num_participants = $this->getDoctrine()->getRepository('AppBundle:Participant')->getNumParticipationsTypesAvailables($registration,$participanttype);
            if ($participanttype && ($participanttype->getNumParticipants() > $num_participants))
            {
                $participant->setParticipantType($participanttype);
                $em = $this->getDoctrine()->getManager();
                $em->persist($participant);
                $em->flush();
                return $this->redirectToRoute('registration');
            }
            else
            {
                $this->addFlash('warning', $this->get('translator')->trans( 'Sorry, the seats are already occupied'));
                return $this->redirectToRoute('registration');
            }

        }
        return $this->render(':frontend/registration:participant.html.twig', array(
            'user'=> $user,
            'registration' => $registration,
            'form'=> $form->createView(),
        ));

    }


    /**
     * @Route("/borrar_inscripcion/{id}", name="participant_delete")
     * Borra la inscripción enviada por argumento
     */
    public function deleteParticipantAction(Participant $participant)
    {
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $user = $this->getUser();
        $registration = $this->getDoctrine()->getRepository('AppBundle:Registration')->findOneBy(array('user' => $user, 'convention' => $convention));
        if ($registration->getStatus()==Registration::STATUS_OPEN && $participant->getRegistration() == $registration)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($participant);
            $em->flush();
        }
        return $this->redirectToRoute('registration');
    }
}
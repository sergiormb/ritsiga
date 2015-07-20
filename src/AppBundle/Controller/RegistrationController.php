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
use AppBundle\Form\ParticipantType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class RegistrationController extends Controller
{
    /**
     * @Route("/inscripciones", name="registration_list")
     * @Template("Registration/my_registrations.html.twig")
     * Muestra todas las inscripciones del usuario
     */
    public function showRegistrations()
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $registrations_open = $this->getDoctrine()->getRepository('AppBundle:Registration')->findAll();
        return [
            'user'=> $user,
            'registrations_open'=> $registrations_open,
        ];
    }

    /**
     * @Route("/completar_registro/", name="registration_complete")
     * @Template("Registration/registration.html.twig")
     * Muestra todas las inscripciones del usuario
     */
    public function registrationAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $registration = $this->getDoctrine()->getRepository('AppBundle:Registration')->findOneBy(array('user' => $user, 'convention' => $convention));
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
            $em = $this->getDoctrine()->getManager();
            $em->persist($participant);
            $em->flush();
        }
        return [
            'user'=> $user,
            'registration' => $registration,
            'types' => $types,
            'form'=> $form->createView(),
        ];
    }
}
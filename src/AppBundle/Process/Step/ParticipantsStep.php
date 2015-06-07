<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 2/05/15
 * Time: 12:05
 */

namespace AppBundle\Process\Step;

use AppBundle\Entity\Participant;
use AppBundle\Entity\ParticipantType;
use AppBundle\Entity\Registration;
use AppBundle\Form\RegistrationType;
use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;
use Sylius\Bundle\FlowBundle\Process\Step\ControllerStep;

class ParticipantsStep extends ControllerStep
{
    public function displayAction(ProcessContextInterface $context)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $request = $context->getRequest();
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $types = $this->getDoctrine()->getRepository('AppBundle:ParticipantType')->findParticipationsTypesAvailables($convention);
        $participant = new Participant();
        $form_participant = $this->createForm($this->get('ritsiga.participant.form.type'), $participant);

        $registration= new Registration();
        $registration->setConvention($convention);
        $registration->setUser($user);
        $form = $this->createForm($this->get('ritsiga.registration.form.type'), $registration);

        return $this->render(':Registration:participants.html.twig', array(
            'convention' => $convention,
            'form' => $form->createView(),
            'form_participant' => $form_participant,
            'user' => $user,
            'context' => $context,
            'tipos' => $types
        ));
    }

    public function forwardAction(ProcessContextInterface $context)
    {

        return $this->complete();

    }


}
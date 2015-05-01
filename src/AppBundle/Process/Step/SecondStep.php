<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 22/04/15
 * Time: 11:29
 */

namespace AppBundle\Process\Step;

use AppBundle\Entity\Registration;
use AppBundle\Form\RegistrationType;
use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;
use Sylius\Bundle\FlowBundle\Process\Step\ControllerStep;

class SecondStep extends ControllerStep
{
    public function displayAction(ProcessContextInterface $context)
    {
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $registration= new Registration();
        $registration->setConvention($convention);
        $form = $this->createForm(new RegistrationType(), $registration);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render(':Registration:first.html.twig', array(
            'convention' => $convention,
            'form' => $form->createView(),
            'user' => $user,
            'context' => $context
        ));
    }

    public function forwardAction(ProcessContextInterface $context)
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $form = $this->createForm('registration');

        if ($request->isMethod('POST') && $form->bind($request)->isValid()) {
            $context->getStorage()->set('registration', $form->getData());

            return $this->complete();
        }

        return $this->render(':Registration:first.html.twig', array(
            'form' => $form->createView(),
            'context' => $context
        ));
    }


}
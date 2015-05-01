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
use AppBundle\Form\UniversityType;
use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;
use Sylius\Bundle\FlowBundle\Process\Step\ControllerStep;

class SecondStep extends ControllerStep
{
    public function displayAction(ProcessContextInterface $context)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $request = $context->getRequest();
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $university=$user->getStudentDelegation()->getCentro()->getUniversidad();
        $form = $this->createForm(new UniversityType(), $university);


        return $this->render(':Registration:second.html.twig', array(
            'convention' => $convention,
            'form' => $form->createView(),
            'user' => $user,
            'context' => $context
        ));
    }

    public function forwardAction(ProcessContextInterface $context)
    {
        $siteManager = $this->container->get('ritsiga.site.manager');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $convention = $siteManager->getCurrentSite();
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $registration= new Registration();
        $registration->setConvention($convention);
        $registration->setUser($user);
        $form = $this->createForm(new RegistrationType(), $registration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($registration);
            $em->flush();

            $this->addFlash('info', $this->get('translator')->trans( 'You registration has been successfully'));

            return $this->complete();
        }

        return $this->render(':Registration:first.html.twig', array(
            'form' => $form->createView(),
            'context' => $context
        ));
    }


}
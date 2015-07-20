<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 4/06/15
 * Time: 13:40
 */

namespace AppBundle\Process\Step;
use AppBundle\Entity\Registration;
use AppBundle\Form\ResponsibleType;
use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;
use Sylius\Bundle\FlowBundle\Process\Step\ControllerStep;

class ResponsibleStep extends ControllerStep
{
    public function displayAction(ProcessContextInterface $context)
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $request = $context->getRequest();
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();

        $registration=new Registration();
        $registration->setConvention($convention);
        $form = $this->createForm(new ResponsibleType(), $registration);

        return $this->render(':Registration:responsible.html.twig', array(
            'convention' => $convention,
            'form' => $form->createView(),
            'user' => $user,
            'context' => $context
        ));
    }

    public function forwardAction(ProcessContextInterface $context)
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $em = $this->getDoctrine()->getManager();
        $registration=new Registration();
        $registration->setConvention($convention);
        $form = $this->createForm(new ResponsibleType(), $registration);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registration->setUser($user);
            $em->persist($registration);
            $em->flush();
            $this->addFlash('warning', $this->get('translator')->trans( 'Your responsible has been successfully updated'));
            return $this->complete();
        }

    }
}
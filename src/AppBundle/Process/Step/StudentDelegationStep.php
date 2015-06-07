<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 4/06/15
 * Time: 12:39
 */

namespace AppBundle\Process\Step;
use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;
use Sylius\Bundle\FlowBundle\Process\Step\ControllerStep;

use AppBundle\Form\StudentDelegationType;

class StudentDelegationStep extends ControllerStep
{
    public function displayAction(ProcessContextInterface $context)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $request = $context->getRequest();
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $student=$user->getStudentDelegation();
        $form = $this->createForm(new StudentDelegationType(), $student);

        return $this->render(':Registration:student_delegation.html.twig', array(
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
        $em = $this->getDoctrine()->getManager();
        $student=$user->getStudentDelegation();

        $form = $this->createForm(new StudentDelegationType(), $student);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($student);
            $em->flush();
            $this->addFlash('success', $this->get('translator')->trans( 'Your student delegation has been successfully updated'));
        }
        return $this->complete();
    }

}
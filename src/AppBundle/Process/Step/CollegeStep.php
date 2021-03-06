<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 2/05/15
 * Time: 10:01
 */

namespace AppBundle\Process\Step;
use AppBundle\Form\CollegeType;
use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;
use Sylius\Bundle\FlowBundle\Process\Step\ControllerStep;

class CollegeStep extends ControllerStep
{
    public function displayAction(ProcessContextInterface $context)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $request = $context->getRequest();
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $college=$user->getStudentDelegation()->getCollege();
        $form = $this->createForm(new CollegeType(), $college);

        return $this->render(':frontend/registration/process:college.html.twig', array(
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
        $college=$user->getStudentDelegation()->getCollege();

        $form = $this->createForm(new CollegeType(), $college);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($college);
            $em->flush();
            $this->addFlash('warning', $this->get('translator')->trans( 'Your college has been successfully updated'));
            return $this->complete();
        }
    }


}
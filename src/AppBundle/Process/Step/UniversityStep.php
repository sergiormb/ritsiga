<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 22/04/15
 * Time: 11:29
 */

namespace AppBundle\Process\Step;

use AppBundle\Entity\University;
use AppBundle\Form\UniversityType;
use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;
use Sylius\Bundle\FlowBundle\Process\Step\ControllerStep;

class UniversityStep extends ControllerStep
{
    public function displayAction(ProcessContextInterface $context)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $request = $context->getRequest();
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $university=$user->getStudentDelegation()->getCollege()->getUniversity();
        $form = $this->createForm(new UniversityType(), $university);


        return $this->render(':Registration/Process:university.html.twig', array(
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
        $university=$user->getStudentDelegation()->getCollege()->getUniversity();

        $form = $this->createForm(new UniversityType(), $university);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($university);
            $em->flush();
            $this->addFlash('warning', $this->get('translator')->trans( 'Your university has been successfully updated'));
        }
        return $this->complete();
    }


}
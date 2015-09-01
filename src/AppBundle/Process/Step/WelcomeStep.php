<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 22/04/15
 * Time: 11:29
 */

namespace AppBundle\Process\Step;

use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;
use Sylius\Bundle\FlowBundle\Process\Step\ControllerStep;

class WelcomeStep extends ControllerStep
{
    public function displayAction(ProcessContextInterface $context)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $request = $context->getRequest();
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $student_delegation = $user->getStudentDelegation();
        $registration = $this->getDoctrine()->getRepository('AppBundle:Registration')->findOneBy(array('user' => $user, 'convention' => $convention));
        if ($user->getUniversity() == null || $user->getCollege() == null || $user->getStudentDelegation() == null)
        {
            $this->addFlash('warning', $this->get('translator')->trans( 'Debe completar su perfil para inscribirse en una asamblea'));
            return $this->redirectToRoute('fos_user_profile_edit');
        }
        if ($registration)
        {
            return $this->redirectToRoute('registration');
        }

        return $this->render(':frontend/registration/process:welcome.html.twig', array(
            'convention' => $convention,
            'user' => $user,
            'student_delegation' => $student_delegation,
            'context' => $context
        ));
    }

    public function forwardAction(ProcessContextInterface $context)
    {
        return $this->complete();
    }


}
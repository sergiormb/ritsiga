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

        return $this->render(':Registration:welcome.html.twig', array(
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
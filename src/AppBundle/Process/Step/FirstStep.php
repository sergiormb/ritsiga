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

class FirstStep extends ControllerStep
{
    public function displayAction(ProcessContextInterface $context)
    {
        return $this->render(':Registration:first.html.twig');
    }

    public function forwardAction(ProcessContextInterface $context)
    {
        $request = $this->getRequest();
        $form = $this->createForm('my_form');

        if ($request->isMethod('POST') && $form->bind($request)->isValid()) {
            $context->getStorage()->set('my_data', $form->getData());

            return $this->complete();
        }

        return $this->render(':Registration:first.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
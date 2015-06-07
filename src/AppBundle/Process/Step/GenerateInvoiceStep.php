<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 4/06/15
 * Time: 16:56
 */

namespace AppBundle\Process\Step;
use AppBundle\Form\CollegeType;
use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;
use Sylius\Bundle\FlowBundle\Process\Step\ControllerStep;

class GenerateInvoiceStep extends ControllerStep
{
    public function displayAction(ProcessContextInterface $context)
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $request = $context->getRequest();
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();


        return $this->render(':Registration:display_invoice.html.twig', array(
            'convention' => $convention,
            'user' => $user,
            'context' => $context
        ));
    }

    public function forwardAction(ProcessContextInterface $context)
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $number_doc = $convention->getDomain() . '-' . rand();
        $this->get('knp_snappy.pdf')->generateFromHtml(
            $this->renderView(
                ':Registration:invoice-print.html.twig',
                array(
                    'variables' => 'variables'
                )
            ),
            '/home/tfg/'.$number_doc.'.pdf'
        );

        return $this->complete();
    }
}
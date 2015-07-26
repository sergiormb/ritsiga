<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 26/07/15
 * Time: 19:17
 */

namespace AppBundle\EventListener;


use AppBundle\Event\RegistrationEvent;
use Knp\Bundle\SnappyBundle\Snappy\LoggableGenerator;
use Symfony\Component\HttpKernel\Kernel;

class GeneratePDFListener
{
    private $loggableGenerator;
    private $twig_Environment;
    private $kernel;

    public function __construct(LoggableGenerator $loggableGenerator, \Twig_Environment $twig_Environment, Kernel $kernel)
    {
        $this->loggableGenerator = $loggableGenerator;
        $this->twig_Environment = $twig_Environment;
        $this->kernel = $kernel;
    }
    public function onRegistrationConfirmed(RegistrationEvent $event)
    {
        $registration = $event->getRegistration();
        $this->loggableGenerator->generateFromHtml(
            $this->twig_Environment->render(
                ':themes/invoice:invoice.html.twig',
                array(
                    'registration' => $registration
                )
            ),
            $this->kernel->getRootDir().'/private/documents/invoices/'.$registration->getId().'.pdf',array(),
            true
        );

    }
}
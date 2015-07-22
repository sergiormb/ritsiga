<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 20/07/15
 * Time: 18:50
 */

namespace AppBundle\EventListener;
use AppBundle\Site\SiteManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceListener
{

    /**
     * @var SiteManager
     */
    private $siteManager;
    /**
     * @var RouterInterface
     */
    private $routerInterface;

    public function __construct(SiteManager $siteManager, ContainerInterface $container)
    {
        $this->siteManager = $siteManager;
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $convention = $this->siteManager->getCurrentSite();
        $hoy = date("d-m-Y");
        if ($convention && ($convention->getMaintenance()==true || $hoy > $convention->getEndsAt()))
        {
            $engine = $this->container->get('templating');
            $content = $engine->render(':Conventions:maintenance.html.twig');
            $event->setResponse(new Response($content, 503));
            $event->stopPropagation();
        }

    }
}
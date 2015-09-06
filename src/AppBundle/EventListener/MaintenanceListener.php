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
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
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
        if ( in_array($this->container->get('kernel')->getEnvironment(), array('test', 'dev')) ) {
            return;
        }

        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return;
        }

        $route = $this->container->get('router')->getRouteCollection()->get($event->getRequest()->get('_route'));
        if (route && preg_match('/^\/admin\/.*/', $route->getPath() ) ) {
            return;
        }

        $convention = $this->siteManager->getCurrentSite();
        $hoy = date("d-m-Y");
        if ($convention && $convention->getDomain() !== 'ritsi' && ($convention->getMaintenance() == true || $hoy > $convention->getEndsAt()))
        {
            $engine = $this->container->get('templating');
            $content = $engine->render('/frontend/conventions/maintenance.html.twig');
            $event->setResponse(new Response($content, 503));
            $event->stopPropagation();
        }
    }
}
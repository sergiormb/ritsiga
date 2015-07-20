<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 20/07/15
 * Time: 18:50
 */

namespace AppBundle\EventListener;
use AppBundle\Site\SiteManager;
use Sonata\CoreBundle\Model\ManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\RouterInterface;

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

    public function __construct(SiteManager $siteManager, RouterInterface $routerInterface)
    {
        $this->siteManager = $siteManager;
        $this->routerInterface = $routerInterface;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $convention = $this->siteManager->getCurrentSite();
        if ($convention && $convention->isMaintenance())
        {
            $event->stopPropagation();
            $event->setResponse(new RedirectResponse($this->routerInterface->generate('homepage')));
        }

    }
}
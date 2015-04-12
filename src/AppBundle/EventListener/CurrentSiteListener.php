<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 12/04/15
 * Time: 19:22
 */

namespace AppBundle\EventListener;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Doctrine\ORM\EntityManager;
use AppBundle\Site\SiteManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CurrentSiteListener {
    private $siteManager;

    private $em;

    private $baseHost;

    public function __construct(SiteManager $siteManager, EntityManager $em, $baseHost)
    {
        $this->siteManager = $siteManager;
        $this->em = $em;
        $this->baseHost = $baseHost;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $currentHost = $request->getHost();
        $domain = str_replace('.'.$this->baseHost, '', $currentHost);

        $site = $this->em
            ->getRepository('AppBundle:Convention')
            ->findOneBy(array('domain' => $domain))
        ;
        if (!$site) {
            throw new NotFoundHttpException(sprintf(
                'No site for host "%s", domain "%s"',
                $this->baseHost,
                $domain
            ));
        }

        $this->siteManager->setCurrentSite($site);
    }
}
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
use Symfony\Component\HttpKernel\KernelInterface;

class CurrentSiteListener {
    private $siteManager;

    private $em;

    private $baseHost;
    /**
     * @var KernelInterface
     */
    private $kernel;

    public function __construct(SiteManager $siteManager, EntityManager $em, $baseHost, KernelInterface $kernel)
    {
        $this->siteManager = $siteManager;
        $this->em = $em;
        $this->baseHost = $baseHost;
        $this->kernel = $kernel;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if ("test" !== $this->kernel->getEnvironment()) {
            $request = $event->getRequest();

            $currentHost = $request->getHost();
            if ($currentHost === $this->baseHost) {
                return;
            }

            $domain = str_replace('.' . $this->baseHost, '', $currentHost);

            $site = $this->em
                ->getRepository('AppBundle:Convention')
                ->findOneBy(array('domain' => $domain));
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
}
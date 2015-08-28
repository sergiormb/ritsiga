<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 12/04/15
 * Time: 19:22
 */

namespace AppBundle\EventListener;
use AppBundle\Entity\Convention;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Doctrine\ORM\EntityManager;
use AppBundle\Site\SiteManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\RouterInterface;

class CurrentSiteListener {
    private $siteManager;

    private $em;

    private $baseCode;
    /**
     * @var KernelInterface
     */
    private $kernel;
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(SiteManager $siteManager, EntityManager $em, RouterInterface $router, $baseCode)
    {
        $this->siteManager = $siteManager;
        $this->em = $em;
        $this->baseCode = $baseCode;
        $this->router = $router;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $context = $this->router->getContext();
        preg_match('/^\/convention\/([a-z]\w+)/', $context->getPathInfo(), $matches);
        $code = isset($matches[1]) ? $matches[1] : $this->baseCode;

        if (!$context->hasParameter('code')) {
            $context->setParameter('code', $code);
        }

        if ($this->baseCode == $code) {
            $site = new Convention();
            $site->setDomain('ritsi');
            $this->siteManager->setCurrentSite($site);
            return;
        }

        $site = $this->em
            ->getRepository('AppBundle:Convention')
            ->findOneBy(array('domain' => $code));
        if (!$site) {
            throw new NotFoundHttpException(sprintf(
                'No site for code "%s"',
                $code
            ));
        }
        $this->siteManager->setCurrentSite($site);
    }
}
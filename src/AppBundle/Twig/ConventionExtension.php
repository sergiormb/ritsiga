<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 3/05/15
 * Time: 17:27
 */

namespace AppBundle\Twig;
use AppBundle\Site\SiteManager;
use Symfony\Component\HttpFoundation\RequestStack;
use AppBundle\Entity\Convention;

class ConventionExtension extends \Twig_Extension
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var SiteManager
     */
    private $siteManager;

    /**
     * @param RequestStack $requestStack
     */
    function __construct($requestStack, SiteManager $siteManager)
    {
        $this->siteManager = $siteManager;
        $this->requestStack = $requestStack;
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('convention_url',[$this, 'conventionURL']),
            new \Twig_SimpleFunction('convention_domain',[$this, 'conventionDomain']),
        ];
    }

    /**
     * Returns the base url of a convention
     *
     *
     * @param Convention $convention
     * @return string
     */
    public function conventionURL(Convention $convention)
    {
        $request = $this->requestStack->getCurrentRequest();
        $domain = $convention->getDomain();
        $url = str_replace('http://', '', $request->getUri());
        $url_complete = "http://" . $domain . "." . $url;
        return $url_complete;
    }

    /**
     * Returns code domain
     *
     * @return string
     */
    public function conventionDomain()
    {
        $convention = $this->siteManager->getCurrentSite();
        return $convention->getDomain();
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ritsiGA_conference';
    }
}
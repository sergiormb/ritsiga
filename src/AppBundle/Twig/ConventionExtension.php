<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 3/05/15
 * Time: 17:27
 */

namespace AppBundle\Twig;
use Symfony\Component\HttpFoundation\RequestStack;
use AppBundle\Entity\Convention;

class ConventionExtension extends \Twig_Extension
{
    /**
     * @var RequestStack
     */
    private $requestStack;


    /**
     * @param RequestStack $requestStack
     */
    function __construct($requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('convention_url',[$this, 'conventionURL']),
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
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ritsiGA_conference';
    }
}
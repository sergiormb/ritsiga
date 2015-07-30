<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 30/07/15
 * Time: 17:56
 */

namespace AppBundle\Security\Handler;


use AppBundle\Site\SiteManager;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Security\Handler\RoleSecurityHandler;

class RoleConventionSecurityHandler extends RoleSecurityHandler
{
    /**
     * @var SiteManager
     */
    protected $siteManager;

    public function __construct($authorizationChecker, array $superAdminRoles, SiteManager $siteManager)
    {
        parent::__construct($authorizationChecker, $superAdminRoles);
        $this->siteManager = $siteManager;
    }


    public function isGranted(AdminInterface $admin, $attributes, $object = null)
    {
        $is_auth = parent::isGranted($admin, $attributes, $object);

        if($is_auth)
        {
            $is_auth = $this->authorizationChecker->isGranted('ORGANIZE', $this->siteManager->getCurrentSite());
        }

        return $is_auth;
    }

}
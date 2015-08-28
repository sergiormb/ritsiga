<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 24/03/15
 * Time: 20:55
 */

namespace AppBundle\Admin;


namespace AppBundle\Admin;
use Sonata\AdminBundle\Admin\Admin as BaseAdmin;

class Admin extends BaseAdmin
{
    /**
     * Return service from container
     *
     * @param $repository
     * @return object
     */
    protected function getRepository($repository)
    {
        return $this->getConfigurationPool()->getContainer()->get('ritsiGA.repository.' . $repository);
    }

    protected  function getCurrentConvention()
    {
        return $this->getConfigurationPool()->getContainer()->get('ritsiga.site.manager')->getCurrentSite();
    }
}
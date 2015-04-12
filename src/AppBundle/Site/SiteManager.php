<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 12/04/15
 * Time: 19:55
 */

namespace AppBundle\Site;
use AppBundle\Entity\Convention;

class SiteManager
{
    /** @var Convention */
    private $currentSite;

    public function getCurrentSite()
    {
        return $this->currentSite;
    }

    public function setCurrentSite(Convention $currentSite)
    {
        $this->currentSite = $currentSite;
    }
}
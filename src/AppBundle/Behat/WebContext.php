<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 24/03/15
 * Time: 22:36
 */

namespace AppBundle\Behat;


class WebContext extends CoreContext
{
    /**
     * @Given que estoy en la página del dashboard
     */
    public function iAmOnDashboard()
    {
        $this->getSession()->visit($this->generatePageUrl('sonata_admin_dashboard'));
    }

    /**
     * @When /^presiono (.*) l.s (.*)$/
     */
    public function iClickActionOnBlock($action, $block)
    {
        $action = ucfirst($action);
        $block = ucfirst($block);
        $this->iClickNear($action, $block);

    }
}
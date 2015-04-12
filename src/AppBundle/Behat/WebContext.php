<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 24/03/15
 * Time: 22:36
 */

namespace AppBundle\Behat;


use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class WebContext extends DefaultContext
{
    /**
     * @Given que estoy en la página del dashboard
     */
    public function iAmOnDashboard()
    {
        $this->getSession()->visit($this->generatePageUrl('sonata_admin_dashboard'));
    }

    /**
     * @Given que estoy en la página del listado de usuarios
     */
    public function iAmOnUserListPage()
    {
        $this->getSession()->visit($this->generatePageUrl('admin_app_user_list'));
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
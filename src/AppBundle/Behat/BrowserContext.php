<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 25/08/15
 * Time: 20:03
 */

namespace AppBundle\Behat;


use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class BrowserContext extends DefaultContext
{
    /**
     * First, force logout, then go to the login page, fill the informations and finally go to requested page
     *
     * @Given /^estoy conectado con "([^"]*)" y "([^"]*)" en "([^"]*)"$/
     *
     * @param string $login
     * @param string $rawPassword
     * @param string $url
     */
    public function iAmConnectedWithOn($login, $rawPassword, $url)
    {
        $this->getSession()->visit('logout');
        $this->getSession()->visit('login');
        $this->fillField('_username', $login);
        $this->fillField('_password', $rawPassword);
        $this->pressButton('_submit');
        $this->getSession()->visit($url);
    }

}
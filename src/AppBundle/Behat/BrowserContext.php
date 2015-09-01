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
     * @Given estoy autenticado como :username con :password
     */
    public function iAmAuthenticated($username, $password)
    {
        $this->getSession()->visit($this->generateUrl('fos_user_security_login', [], true));
        $this->fillField('_username', $username);
        $this->fillField('_password', $password);
        $this->pressButton('_submit');
    }

    /**
     * @Then /^presiono "([^"]*)" con clase "([^"]*)"$/
     *
     * @param string $text
     * @param string $class
     */
    public function iFollowLinkWithClass($text, $class)
    {
        $link = $this->getSession()->getPage()->find(
            'xpath', sprintf("//*[@class='%s' and contains(., '%s')]", $class, $text)
        );
        if (!$link) {
            throw new ExpectationException(sprintf('Unable to follow the link with class: %s and text: %s', $class, $text), $this->getSession());
        }
        $link->click();
    }
}
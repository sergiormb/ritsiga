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

    /**
     * @Given /^que estoy en la página (principal|creación) de (.*)$/
     */
    public function iAmOnActionResource($action, $resource)
    {
        $page = sprintf("ritsiga_%s_%s", $this->translate[$resource], $this->actions[$action]);
        $this->iAmOnPage($page);
    }

    /**
     * @When presiono :button junto a :value
     */
    public function iClickNear($button, $value)
    {
        $tr = $this->assertSession()->elementExists('css', sprintf('table tbody tr:contains("%s")', $value));
        $locator = sprintf('button:contains("%s")', $button);
        if ($tr->has('css', $locator)) {
            $tr->find('css', $locator)->press();
        } else {
            $tr->clickLink($button);
        }
    }

    /**
     * @Then /^debería ver (\d+) (.*) en la lista$/
     */
    public function iShouldSeeNumItems($num)
    {
        $this->assertSession()->pageTextContains(sprintf("%d %s", $num, $num == 1 ? "resultado" : "resultados"));
    }
}
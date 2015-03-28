<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 24/03/15
 * Time: 21:14
 */

namespace AppBundle\Behat;

use AppBundle\Entity\User;
use Behat\Gherkin\Node\TableNode;

class UserContext  extends CoreContext
{
    /**
     * @Given /^que existen los siguientes usuarios:$/
     */
    public function createUser(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $userHash) {
            $user = new User();
            $user->setUsername($userHash['username']);
            $user->setEmail($userHash['email']);
            $user->setPlainPassword($userHash['role']);
            $em->persist($user);
        }
        $em->flush();
    }

    /**
     * @Then debería ver :number usuario(s) en la lista
     */
    public function iShouldSeeUser($number)
    {
        $this->assertSession()->elementsCount('css', '.user', $number);
    }

}
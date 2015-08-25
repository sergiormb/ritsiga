<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 8/10/14
 * Time: 9:57
 */

namespace AppBundle\Behat;

use AppBundle\Entity\Convention;
use AppBundle\Entity\User;
use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class CoreContext extends DefaultContext
{
    /**
     * @Given /^que estoy autenticado como administrador$/
     */
    public function iAmLoggedInAsAdministrator()
    {
        $this->iAmLoggedInAsRole('ROLE_ADMIN');
    }

    /**
     * @Given estoy en el sitio de :domain
     */
    public function iAmOnConventionSite($domain)
    {
//        $siteManager = $this->getContainer()->get('ritsiga.site.manager');
//        $site = $this->getEntityManager()->getRepository('AppBundle:Convention')->findOneBy(['domain' => $domain]);
//        if (false === $site instanceof Convention) {
//            throw new \Exception("Site not found: $domain");
//        }
//        $siteManager->setCurrentSite($site);
//        $this->setMinkParameter('base_url', 'http://');
    }

    /**
     * Create user and login with given role.
     *
     * @param string $role
     * @param string $username
     */
    private function iAmLoggedInAsRole($role, $username = 'usuario')
    {
        $this->thereIsUser($username, 'password', $role);
        $this->getSession()->visit($this->generatePageUrl('sonata_user_admin_security_login'));
        $this->fillField('username', $username);
        $this->fillField('password', 'password');
        $this->pressButton('Entrar');
    }

    /**
     * Create an user if he doesn't exists.
     * @param $username
     * @param $password
     * @param null $role
     * @param string $enabled
     * @param null $address
     * @param array $groups
     * @param bool $flush
     * @return UserInterface
     */
    public function thereIsUser($username, $password, $role = null, $enabled = 'yes', $address = null, $groups = array(), $flush = true)
    {
        $addressData = explode(',', $address);
        $addressData = array_map('trim', $addressData);
        /** @var User $user */
        $user = new User();
        $user->setUsername($username);
        $user->setFirstname($this->faker->firstName);
        $user->setLastname($this->faker->lastName);
        $user->setFirstname(null === $address ? $this->faker->firstName : $addressData[0]);
        $user->setLastname(null === $address ? $this->faker->lastName : $addressData[1]);
        $user->setEmail($username . '@ritsiGA.com');
        $user->setEnabled('yes' === $enabled);
        $user->setPlainPassword($password);
        if (null !== $role) {
            $user->addRole($role);
        }
        $this->getEntityManager()->persist($user);
        foreach ($groups as $groupName) {
            if ($group = $this->findOneByName('group', $groupName)) {
                $user->addGroup($group);
            }
        }
        if ($flush) {
            $this->getEntityManager()->flush();
        }
        return $user;
    }
}
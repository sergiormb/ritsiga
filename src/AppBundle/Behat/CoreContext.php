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
use AppBundle\Entity\StudentDelegation;
use AppBundle\Entity\College;
use AppBundle\Entity\University;
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
     * @Given /^que estoy autenticado como estudiante$/
     */
    public function iAmLoggedInAsAdministratorWithEntities()
    {
        $this->thereIsUser('usuario', 'password', 'ANONYMOUS', true);
        $this->getSession()->visit($this->generatePageUrl('sonata_user_admin_security_login'));

        $this->fillField('username', 'usuario');
        $this->fillField('password', 'password');
        $this->pressButton('Entrar');
    }


    /**
     * @Given estoy en el sitio de :domain
     */
    public function iAmOnConventionSite($domain)
    {
        $siteManager = $this->getContainer()->get('ritsiga.site.manager');
        $site = $this->getEntityManager()->getRepository('AppBundle:Convention')->findOneBy(['domain' => $domain]);
        if (false === $site instanceof Convention) {
            throw new \Exception("Site not found: $domain");
        }
        $siteManager->setCurrentSite($site);
        $this->setMinkParameter('base_url', 'http://');
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
     * @param bool $create_entities
     * @param string $enabled
     * @param null $address
     * @param array $groups
     * @param bool $flush
     * @return UserInterface
     */
    public function thereIsUser($username, $password, $role = null, $create_entities = false, $enabled = 'yes', $address = null, $groups = array(), $flush = true)
    {
        $addressData = explode(',', $address);
        $addressData = array_map('trim', $addressData);

        if ($create_entities==true)
        {
            $student_delegation = new StudentDelegation();
            $student_delegation->setName($this->faker->word);
            $student_delegation->setCity($this->faker->word);
            $student_delegation->setProvince($this->faker->word);
            $student_delegation->setPostcode($this->faker->boolean());
            $student_delegation->setAddress($this->faker->word);
            $student_delegation->setSlug($this->faker->word);
            $college = new College();
            $college->addStudentsDelegation($student_delegation);
            $college->setName($this->faker->word);
            $college->setCity($this->faker->word);
            $college->setProvince($this->faker->word);
            $college->setPostcode($this->faker->boolean());
            $college->setAddress($this->faker->word);
            $college->setSlug($this->faker->word);
            $this->getEntityManager()->persist($college);
            $university = new University();
            $university->addCollege($college);
            $university->setName($this->faker->word);
            $university->setCity($this->faker->word);
            $university->setProvince($this->faker->word);
            $university->setCif($this->faker->word);
            $university->setPostcode($this->faker->boolean());
            $university->setAddress($this->faker->word);
            $university->setType($this->faker->word);
            $university->setSlug($this->faker->word);
            $student_delegation->setCollege($college);
            $college->setUniversity($university);
            $this->getEntityManager()->persist($student_delegation);
            $this->getEntityManager()->persist($university);
            $this->getEntityManager()->flush();
        }

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
        if ($create_entities==true)
        {
            $user->setStudentDelegation($student_delegation);
        }
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
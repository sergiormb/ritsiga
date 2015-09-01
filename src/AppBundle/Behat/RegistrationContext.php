<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 1/09/15
 * Time: 22:26
 */

namespace AppBundle\Behat;

use AppBundle\Entity\Registration;
use Behat\Gherkin\Node\TableNode;
use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class RegistrationContext extends DefaultContext
{
    /**
     * @Given /^que existen las inscripciones:$/
     */
    public function createStudentDelegation(TableNode $tableNode)
    {
        foreach ($tableNode->getHash() as $registrationHash) {
            $user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneBy(['username' => $registrationHash['usuario']]);
            $convention = $this->getEntityManager()->getRepository('AppBundle:Convention')->findOneBy(['domain' => $registrationHash['asamblea']]);
            $registration = new Registration();
            $registration->setUser($user);
            $registration->setName($registrationHash['nombre']);
            $registration->setPosition($registrationHash['cargo']);
            $registration->setConvention($convention);
            $registration->setStatus($registrationHash['estado']);
            $this->getEntityManager()->persist($registration);
        }
        $this->getEntityManager()->flush();
    }
}
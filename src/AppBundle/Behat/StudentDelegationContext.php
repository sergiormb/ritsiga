<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 25/08/15
 * Time: 19:16
 */

namespace AppBundle\Behat;


use AppBundle\Entity\StudentDelegation;
use Behat\Gherkin\Node\TableNode;
use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class StudentDelegationContext  extends DefaultContext
{
    /**
     * @Given /^que existen las delegaciones de estudiantes:$/
     */
    public function createStudentDelegation(TableNode $tableNode)
    {
        foreach ($tableNode->getHash() as $student_delegationHash) {
            $student_delegation = new StudentDelegation();
            $student_delegation->setName($student_delegationHash['name']);
            $student_delegation->setSlug($student_delegationHash['slug']);
            $student_delegation->setCity($student_delegationHash['city']);
            $student_delegation->setAddress($student_delegationHash['address']);
            $student_delegation->setProvince($student_delegationHash['province']);
            $student_delegation->setPostcode($student_delegationHash['postcode']);
            $this->getEntityManager()->persist($student_delegation);
        }
        $this->getEntityManager()->flush();
    }
}
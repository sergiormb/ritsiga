<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 26/08/15
 * Time: 20:39
 */

namespace AppBundle\Behat;


use AppBundle\Entity\College;
use AppBundle\Entity\StudentDelegation;
use AppBundle\Entity\University;
use Behat\Gherkin\Node\TableNode;
use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class EntityContext extends DefaultContext
{

    /**
     * @Given existen las universidades:
     */
    public function thereAreUniversities(TableNode $tableNode)
    {
        foreach($tableNode->getHash() as $universityHash)
        {
            $university = new University();
            $university->setName($universityHash['nombre']);
            $university->setCity($universityHash['ciudad']);
            $university->setProvince($universityHash['provincia']);
            $university->setCif($universityHash['cif']);
            $university->setPostcode($this->faker->boolean());
            $university->setAddress($this->faker->word);
            $university->setType($this->faker->word);
            $university->setSlug($this->faker->word);
            $this->getEntityManager()->persist($university);
        }
        $this->getEntityManager()->flush();

    }

    /**
     * @Given existen las facultades:
     */
    public function thereAreColleges(TableNode $tableNode)
    {
        foreach($tableNode->getHash() as $collegeHash)
        {
            $college = new College();
            $college->setName($collegeHash['nombre']);
            $college->setCity($collegeHash['ciudad']);
            $college->setProvince($collegeHash['provincia']);
            $college->setPostcode($this->faker->boolean());
            $college->setAddress($this->faker->word);
            $college->setSlug($this->faker->word);
            $this->getEntityManager()->persist($college);
        }
        $this->getEntityManager()->flush();

    }

    /**
     * @Given existen las delegaciones de estudiantes:
     */
    public function thereAreStudentDelegations(TableNode $tableNode)
    {
        foreach($tableNode->getHash() as $studentdelegationHash)
        {
            $student_delegation = new StudentDelegation();
            $student_delegation->setName($studentdelegationHash['nombre']);
            $student_delegation->setCity($studentdelegationHash['ciudad']);
            $student_delegation->setProvince($studentdelegationHash['provincia']);
            $student_delegation->setPostcode($this->faker->boolean());
            $student_delegation->setAddress($this->faker->word);
            $student_delegation->setSlug($this->faker->word);
            $this->getEntityManager()->persist($student_delegation);
        }
        $this->getEntityManager()->flush();

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 22/03/15
 * Time: 19:29
 */

namespace AppBundle\Behat;


use AppBundle\Entity\Convention;
use Behat\Gherkin\Node\TableNode;

class ConventionContext extends CoreContext
{

    /**
     * @Given existen las asambleas:
     */
    public function thereAreConventions(TableNode $tableNode)
    {
        foreach($tableNode->getHash() as $conventionHash)
        {
            $convention = new Convention();
            $convention->setName($conventionHash['nombre']);
            $convention->setStartsAt(new \DateTime( $conventionHash['fechaInicio'] ));
            $convention->setEndsAt(new \DateTime( $conventionHash['fechaFin'] ));
            $this->getEntityManager()->persist($convention);
        }
        $this->getEntityManager()->flush();
    }

    /**
     * @Then debería ver :number asamblea(s)
     */
    public function iShouldSeeConvention($number)
    {
        $this->assertSession()->elementsCount('css', '.convention', $number);
    }
}
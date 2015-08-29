<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 29/08/15
 * Time: 18:20
 */

namespace AppBundle\Doctrine\ORM;


use AppBundle\Entity\Convention;
use Doctrine\ORM\EntityRepository;

class RegistrationRepository extends EntityRepository
{
    public function getQueryRegistration(Convention $convention)
    {
        $qb = $this->createQueryBuilder('registration');
        $alias = current($qb->getRootAliases());
        $qb->andWhere($qb->expr()->eq( $alias . '.convention', $convention->getId() ));
        return $qb;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 30/04/15
 * Time: 21:57
 */

namespace AppBundle\Entity;


class StudentDelegationRepository extends \Doctrine\ORM\EntityRepository
{
    public function findStudentDelegation($word)
    {
        $em=$this->getEntityManager();
        $query=$em->createQuery('
        SELECT o
        FROM AppBundle:StudentDelegation o
        WHERE o.name LIKE :word');

        $query->setParameter('word','%'.$word.'%');
        return $query->getResult();
    }
}

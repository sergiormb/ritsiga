<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 30/04/15
 * Time: 21:57
 */

namespace AppBundle\Doctrine\ORM;
use Doctrine\ORM\EntityRepository;


class StudentDelegationRepository extends EntityRepository
{
    public function findStudentDelegation($word)
    {
        $em=$this->getEntityManager();
        $query=$em->createQuery('
        SELECT o
        FROM AppBundle:StudentDelegation o
        WHERE o.nombre LIKE :word');

        $query->setParameter('word','%'.$word.'%');
        return $query->getResult();
    }

    public function findStudentDelegationByCollege($college)
    {
        $em=$this->getEntityManager();
        $query=$em->createQuery('
        SELECT o.id, o.name
        FROM AppBundle:StudentDelegation o
        WHERE o.college = :college');

        $query->setParameter('college',$college->getId());
        return $query->getResult();
    }
}

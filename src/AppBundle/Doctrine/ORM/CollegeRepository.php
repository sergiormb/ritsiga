<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 2/05/15
 * Time: 12:46
 */

namespace AppBundle\Doctrine\ORM;
use Doctrine\ORM\EntityRepository;


class CollegeRepository extends EntityRepository
{
    public function findCollege($word)
    {
        $em=$this->getEntityManager();
        $query=$em->createQuery('
        SELECT o
        FROM AppBundle:College o
        WHERE o.name LIKE :word');

        $query->setParameter('word','%'.$word.'%');
        return $query->getResult();
    }

    public function findCollegeByUniversity($university)
    {
        $em=$this->getEntityManager();
        $query=$em->createQuery('
        SELECT o.id, o.name
        FROM AppBundle:College o
        WHERE o.university = :university');

        $query->setParameter('university',$university->getId());
        return $query->getResult();
    }
}
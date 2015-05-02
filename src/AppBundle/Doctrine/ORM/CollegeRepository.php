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
    public function findUniversity($word)
    {
        $em=$this->getEntityManager();
        $query=$em->createQuery('
        SELECT o
        FROM AppBundle:College o
        WHERE o.name LIKE :word');

        $query->setParameter('word','%'.$word.'%');
        return $query->getResult();
    }
}
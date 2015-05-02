<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 2/05/15
 * Time: 11:25
 */

namespace AppBundle\Entity;
use Doctrine\ORM\EntityRepository;

class AcademicDegreeRepository extends EntityRepository
{
    public function getAllAcademicDegreeFromCollege(College $college)
    {
        $qb = $this->createQueryBuilder('t');
        $query = $qb
            ->leftJoin('t.academic_degrees', 'c')
            ->where($qb->expr()->eq('c.id', ':id'))
        ;
        $query->setParameter('id', $college->getId());

        return $query;
    }
}
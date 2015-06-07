<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 4/06/15
 * Time: 19:04
 */

namespace AppBundle\Doctrine\ORM;
use AppBundle\Entity\Convention;
use Doctrine\ORM\EntityRepository;

class ParticipationTypeRepository extends  EntityRepository
{
    public function findParticipationsTypesAvailables(Convention $convention)
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('
                SELECT o
                FROM AppBundle:ParticipantType o
                WHERE :today < o.endDate
                AND o.convention = :convention
                ORDER BY o.endDate DESC
            ')->setParameter('today', new \DateTime())
            ->setParameter('convention', $convention);

        return $consulta->getResult();
    }

    public function getParticipationsTypesAvailables(Convention $convention)
    {
        $query = $this->createQueryBuilder('o')
            ->where(':today < o.endDate')
            ->andWhere('o.convention = :convention')
            ->orderBy('o.endDate', 'DESC')
            ->setParameter('today', new \DateTime())
            ->setParameter('convention', $convention);

        return $query;
    }
}
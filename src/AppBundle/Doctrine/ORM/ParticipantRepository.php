<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 23/07/15
 * Time: 20:44
 */

namespace AppBundle\Doctrine\ORM;

use AppBundle\Entity\ParticipantType;
use AppBundle\Entity\Registration;
use Doctrine\ORM\EntityRepository;

class ParticipantRepository extends EntityRepository
{

    public function getNumParticipationsTypesAvailables(Registration $registration, ParticipantType $participantType)
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('
                SELECT count(o.id)
                FROM AppBundle:Participant o
                WHERE :participant_type = o.participant_type
                AND o.registration = :registration
            ')->setParameter('participant_type', $participantType)
            ->setParameter('registration', $registration);

        return $consulta->getSingleScalarResult();
    }
}
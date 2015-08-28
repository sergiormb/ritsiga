<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 22/08/15
 * Time: 01:31
 */

namespace AppBundle\Security\Voter;


use AppBundle\Entity\ParticipantType;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ParticipantTypeVoter extends AbstractOrganizationVoter
{

    function getClass()
    {
        return 'AppBundle\Entity\ParticipantType';
    }

    public function vote(TokenInterface $token, $object, array $attributes)
    {
        $vote = parent::vote($token, $object, $attributes);

        if ($vote === self::ACCESS_GRANTED && $object->getConvention() != $this->siteManager->getCurrentSite()) {
            $vote = self::ACCESS_DENIED;
        }

        return $vote;
    }
}
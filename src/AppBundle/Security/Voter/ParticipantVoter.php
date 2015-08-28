<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 22/08/15
 * Time: 10:57
 */

namespace AppBundle\Security\Voter;


use AppBundle\Entity\Participant;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ParticipantVoter extends AbstractOrganizationVoter
{

    function getClass()
    {
        return 'AppBundle\Entity\Participant';
    }

    /**
     * @param TokenInterface $token
     * @param null|Participant $object
     * @param array $attributes
     * @return int
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        $vote = parent::vote($token, $object, $attributes);

        if ($vote === self::ACCESS_GRANTED
            && $object->getRegistration()->getConvention() != $this->siteManager->getCurrentSite()) {
            $vote = self::ACCESS_DENIED;
        }

        return $vote;
    }
}
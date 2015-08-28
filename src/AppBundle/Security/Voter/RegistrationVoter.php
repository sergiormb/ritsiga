<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 22/08/15
 * Time: 10:59
 */

namespace AppBundle\Security\Voter;


use AppBundle\Entity\Registration;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class RegistrationVoter extends AbstractOrganizationVoter
{
    function getClass()
    {
        return 'AppBundle\Entity\Registration';
    }

    /**
     * @param TokenInterface $token
     * @param null|Registration $object
     * @param array $attributes
     * @return int
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        $vote = parent::vote($token, $object, $attributes);

        if ($vote === self::ACCESS_GRANTED
            && $object->getConvention() != $this->siteManager->getCurrentSite()) {
            $vote = self::ACCESS_DENIED;
        }

        return $vote;
    }


}
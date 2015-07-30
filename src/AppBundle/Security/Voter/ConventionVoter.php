<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 30/07/15
 * Time: 18:05
 */

namespace AppBundle\Security\Voter;


use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;

class ConventionVoter extends AbstractVoter
{
    /**
     * Return an array of supported classes. This will be called by supportsClass
     *
     * @return array an array of supported classes, i.e. array('Acme\DemoBundle\Model\Product')
     */
    protected function getSupportedClasses()
    {
        return ['AppBundle\Entity\Convention'];
    }

    /**
     * Return an array of supported attributes. This will be called by supportsAttribute
     *
     * @return array an array of supported attributes, i.e. array('CREATE', 'READ')
     */
    protected function getSupportedAttributes()
    {
        return ['ORGANIZE'];
    }

    /**
     * Perform a single access check operation on a given attribute, object and (optionally) user
     * It is safe to assume that $attribute and $object's class pass supportsAttribute/supportsClass
     * $user can be one of the following:
     *   a UserInterface object (fully authenticated user)
     *   a string               (anonymously authenticated user)
     *
     * @param string $attribute
     * @param object $object
     * @param User|string $user
     *
     * @return bool
     */
    protected function isGranted($attribute, $object, $user = null)
    {
        if ($user->hasRole('ROLE_ORGANIZER')) {
            if ($object)
            {
                foreach($object->getAdministrators() as $organizer)
                {
                    if ($organizer==$user)
                    {
                        return true;
                    }
                }
            }
            return false;
        }

        return true;
    }
}
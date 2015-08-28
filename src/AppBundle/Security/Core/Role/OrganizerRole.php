<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 21/08/15
 * Time: 23:58
 */

namespace AppBundle\Security\Core\Role;


use AppBundle\Entity\Convention;
use Symfony\Component\Security\Core\Role\RoleInterface;

class OrganizerRole implements RoleInterface
{
    /**
     * @var Convention
     */
    private $role;

    /**
     * OrganizerRole constructor.
     * @param Convention $convention
     */
    public function __construct(Convention $convention)
    {
        $this->role = 'ROLE_RITSIGA_ORGANIZER_' . strtoupper($convention->getDomain());
    }

    /**
     * Returns the role.
     *
     * This method returns a string representation whenever possible.
     *
     * When the role cannot be represented with sufficient precision by a
     * string, it should return null.
     *
     * @return string|null A string representation of the role, or null
     */
    public function getRole()
    {
        return $this->role;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 22/07/15
 * Time: 17:46
 */

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use AppBundle\Entity\Registration;

class RegistrationEvent extends Event
{
    private $registration;

    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
    }

    public function getRegistration()
    {
        return $this->registration;
    }
}
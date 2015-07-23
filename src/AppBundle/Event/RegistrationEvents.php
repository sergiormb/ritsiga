<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 22/07/15
 * Time: 17:38
 */

namespace AppBundle\Event;


final class RegistrationEvents
{
    /**
     * This event occurs when a registration is changed
     *
     * The event listener receives an
     * AppBundle\Event\RegistrationEvent instance.
     *
     * @var string
     */
    const OPEN= 'registration.open';
    const CONFIRMED = 'registration.confirmed';
    const PAID = 'registration.paid';
    const CANCELLED = 'registration.cancelled';
}
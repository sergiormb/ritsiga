<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 24/03/15
 * Time: 21:06
 */

namespace AppBundle\Admin;


class UserAdmin extends Admin {
    /**
     * {@inheritdoc}
     */
    protected $baseRouteName = "ritsiGA_user";
    /**
     * {@inheritdoc}
     */
    protected $baseRoutePattern = 'ritsiGA/user';
}
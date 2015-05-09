<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 1/05/15
 * Time: 12:55
 */

namespace AppBundle\Form\Type;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('name');
    }

    public function getName()
    {
        return 'acme_user_registration';
    }
}
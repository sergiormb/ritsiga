<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 10/05/15
 * Time: 18:07
 */

namespace AppBundle\Form\Type;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;


class ProfileType extends BaseType
{
    public function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildUserForm($builder, $options);

        $builder->add('firstname');
        $builder->add('lastname');
        $builder->add('university','entity', array('class' => 'AppBundle\Entity\University'));
        $builder->add('college','entity', array('class' => 'AppBundle\Entity\College'));
        $builder->add('studentdelegation','entity', array('class' => 'AppBundle\Entity\StudentDelegation'));
        $builder->add('email');
        $builder->add('phone');
        $builder->add('gender');
        $builder->add('website');
    }

    public function getName()
    {
        return 'ritsiga_user_profile';
    }
}
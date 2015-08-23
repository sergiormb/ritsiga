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
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('firstname', null, array(
                'label' => 'label.name'
            ))
            ->add('lastname', null, array(
                'label' => 'label.last_name'
            ))
            ->add('university','entity', array(
                'class' => 'AppBundle\Entity\University',
                'label' => 'label.university',
                'placeholder' => 'Selecciona tu Universidad',
                'mapped' => false,
                'data' => 'getUniversity',
            ))
            ->add('college','entity', array(
                'class' => 'AppBundle\Entity\College',
                'label' => 'label.college',
                'placeholder' => '--------',
                'mapped' => false
            ))
            ->add('studentdelegation','entity', array(
                'class' => 'AppBundle\Entity\StudentDelegation',
                'label' => 'label.student_delegation',
                'placeholder' => '--------'
            ))
            ->add('email')
            ->add('phone', null, array(
                'label' => 'label.phone'
            ))
            ->add('website', null, array(
                'label' => 'label.website'
            ));
    }

    public function getName()
    {
        return 'ritsiga_user_profile';
    }
}
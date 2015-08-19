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

        $builder->add('firstname', null, array('label' => 'label.name'));
        $builder->add('lastname', null, array('label' => 'label.last_name'));
        $builder->add('university','entity', array('class' => 'AppBundle\Entity\University', 'label' => 'label.university'));
        $builder->add('college','entity', array('class' => 'AppBundle\Entity\College', 'label' => 'label.college'));
        $builder->add('studentdelegation','entity', array('class' => 'AppBundle\Entity\StudentDelegation', 'label' => 'label.student_delegation'));
        $builder->add('email');
        $builder->add('phone', null, array('label' => 'label.phone'));
        $builder->add('gender', 'choice', array('label' => 'label.gender', 'choices'  => array('H' => 'Hombre', 'M' => 'Mujer'),
            'required' => true));
        $builder->add('website', null, array('label' => 'label.website'));
    }

    public function getName()
    {
        return 'ritsiga_user_profile';
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 3/08/15
 * Time: 19:48
 */

namespace AppBundle\Form;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class TravelInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('departuredate', 'collot_datetime', array('label' => 'label.departuredate'))
            ->add('arrivaldate', 'collot_datetime', array('label' => 'label.arrivaldate'))
            ->add('transport', null, array('label' => 'label.transport'))
            ->add('comentary', null, array('label' => 'label.comentary'))
            ->add('save', 'submit', array('label' => 'save'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Registration'
        ));
    }

    public function getName()
    {
        return 'registration';
    }

}
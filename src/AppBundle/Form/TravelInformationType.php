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
            ->add('departuredate')
            ->add('arrivaldate')
            ->add('transport')
            ->add('comentary');
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
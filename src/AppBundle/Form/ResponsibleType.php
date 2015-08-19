<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 4/06/15
 * Time: 13:37
 */

namespace AppBundle\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResponsibleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => 'label.name'))
            ->add('position', null, array('label' => 'label.position'));
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
<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 2/05/15
 * Time: 0:58
 */

namespace AppBundle\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UniversityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => 'label.name'))
            ->add('city', null, array('label' => 'label.city'))
            ->add('province', null, array('label' => 'label.province'))
            ->add('address', 'textarea', array('label' => 'label.address'))
            ->add('postcode', null, array('label' => 'label.postcode'))
            ->add('web')
            ->add('fax')
            ->add('phone', null, array('label' => 'label.phone'))
            ->add('cif', null, array('label' => 'label.cif'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\University'
        ));
    }

    public function getName()
    {
        return 'university';
    }
}
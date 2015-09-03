<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 2/05/15
 * Time: 10:02
 */

namespace AppBundle\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CollegeType extends AbstractType
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
            ->add('academic_degrees', null, array(
                'label' => 'label.academic_degrees',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\College'
        ));
    }

    public function getName()
    {
        return 'college';
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 4/06/15
 * Time: 12:46
 */

namespace AppBundle\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StudentDelegationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => 'label.name'))
            ->add('city', null, array('label' => 'label.city'))
            ->add('province', null, array('label' => 'label.province'))
            ->add('address', null, array('label' => 'label.address'))
            ->add('postcode', null, array('label' => 'label.postcode'))
            ->add('web')
            ->add('fax')
            ->add('phone', null, array('label' => 'label.phone'))
            ->add('facebook')
            ->add('twitter')
            ->add('cif', null, array('label' => 'label.cif'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\StudentDelegation'
        ));
    }

    public function getName()
    {
        return 'student_delegation';
    }

}
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
            ->add('nombre')
            ->add('ciudad')
            ->add('provincia')
            ->add('direccion')
            ->add('cod_postal')
            ->add('web')
            ->add('fax')
            ->add('telefono')
            ->add('cif')
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
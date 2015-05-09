<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 4/05/15
 * Time: 22:20
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('last_name');
        $builder->add('email');
        $builder->add('address');
        $builder->add('birthday');
        $builder->add('dni');
        $builder->add('type');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Participant'
        ));
    }

    public function getName()
    {
        return 'participant';
    }
}
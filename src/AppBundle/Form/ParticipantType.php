<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 4/05/15
 * Time: 22:20
 */

namespace AppBundle\Form;


use AppBundle\Doctrine\ORM\ParticipationTypeRepository;
use AppBundle\Site\SiteManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ParticipantType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, array('label' => 'label.name'));
        $builder->add('last_name', null, array('label' => 'label.last_name'));
        $builder->add('email');
        $builder->add('phone', null, array('label' => 'label.phone'));
        $builder->add('dni');
        $builder->add('save', 'submit', array(
            'attr' => array('class' => 'btn btn-primary'), 'label'=> 'save'
        ));
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
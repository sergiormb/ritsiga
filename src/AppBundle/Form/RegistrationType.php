<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 20/04/15
 * Time: 21:55
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationType extends AbstractType
{
    /**
     * @var ParticipantType
     */
    private $participantType;

    function __construct(ParticipantType $participantType)
    {
        $this->participantType = $participantType;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('participants', 'collection',
                array(
                    'type' => $this->participantType,
                    'allow_add'    => true,
                )
            )
        ;
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
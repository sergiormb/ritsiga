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
    /**
     * @var SiteManager
     */
    private $siteManager;
    /**
     * @var ParticipationTypeRepository
     */
    private $participant;

    function __construct(SiteManager $siteManager, ParticipationTypeRepository $participant)
    {
        $this->siteManager = $siteManager;
        $this->participant = $participant;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('last_name');
        $builder->add('email');
        $builder->add('address');
        $builder->add('birthday', 'sonata_type_date_picker');
        $builder->add('dni');
        $builder->add('participant_type', 'entity', array(
            'class' => 'AppBundle\Entity\ParticipantType',
            'query_builder' => $this->participant->getParticipationsTypesAvailables($this->siteManager->getCurrentSite())
        ));
        $builder->add('save', 'submit', array(
            'attr' => array('class' => 'btn btn-primary'),
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
<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 25/07/15
 * Time: 10:51
 */

namespace AppBundle\Admin;

use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ParticipantAdmin  extends Admin
{
    /**
     * {@inheritdoc}
     */
    public function createQuery($context = 'list')
    {
        /** @var QueryBuilder $query */
        $query = parent::createQuery($context);
        $alias = current($query->getRootAliases());
        $convention = $this->getConfigurationPool()->getContainer()->get('ritsiga.site.manager')->getCurrentSite();

        if ($convention->getId()) {
            $query->leftJoin($alias.'.registration', 'registration');
            $query->andWhere($query->expr()->eq('registration.convention', $convention->getId()));
        }

        return $query;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('registration', null, [
                'query_builder' => $this->getRepository('registration')->getQueryRegistration($this->getCurrentConvention()),
                'required' => true,
                'label' => 'label.registration',
            ])
            ->add('name', null, array('label' => 'label.name'))
            ->add('participant_type', null, [
                'query_builder' => $this->getRepository('participanttype')->getParticipationsTypesAvailables($this->getCurrentConvention()),
                'required' => true,
                'label' => 'label.participanttype',
            ])
            ->add('last_name', null, array('label' => 'label.last_name'))
            ->add('phone', null, array('label' => 'label.phone'))
            ->add('dni')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('registration', null, array('label' => 'label.registration'))
            ->add('name', null, array('label' => 'label.name'))
            ->add('last_name', null, array('label' => 'label.last_name'))
            ->add('phone', null, array('label' => 'label.phone'))
            ->add('dni')
            ->add('registration.convention', null, array('label' => 'label.convention'))
        ;
    }
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array('label' => 'label.name'))
            ->add('last_name', null, array('label' => 'label.last_name'))
            ->add('phone', null, array('label' => 'label.phone'))
            ->add('dni')
            ->add('registration.convention', null, array('label' => 'label.convention'))
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', null, array('label' => 'label.name'))
            ->add('last_name', null, array('label' => 'label.last_name'))
            ->add('phone', null, array('label' => 'label.phone'))
            ->add('registration.user.university', null, array(
                'label' => 'label.university'
            ))
            ->add('registration.user.college', null, array(
                'label' => 'label.college'
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'show' => array(),
                ), 'label' => 'label.actions'))
        ;
    }
}
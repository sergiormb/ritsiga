<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 31/05/15
 * Time: 18:39
 */

namespace AppBundle\Admin;

use AppBundle\Entity\ParticipantType;
use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ParticipantTypeAdmin  extends Admin
{
    /**
     * {@inheritdoc}
     */
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $alias = current($query->getRootAliases());
        $convention = $this->getConfigurationPool()->getContainer()->get('ritsiga.site.manager')->getCurrentSite();
        if($convention->getId())
        {
            $query->andWhere($query->expr()->eq($alias . '.convention', $convention->getId()));
        }
        /** @var QueryBuilder $query */


        return $query;
    }

    public function prePersist($participant_type)
    {
        $convention = $this->getConfigurationPool()->getContainer()->get('ritsiga.site.manager')->getCurrentSite();
        $participant_type->setConvention($convention);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('convention')
            ->add('name')
            ->add('description')
            ->add('startDate', 'sonata_type_datetime_picker')
            ->add('endDate', 'sonata_type_datetime_picker')
            ->add('price')
            ->add('num_participants');
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('description')
            ->add('startDate')
            ->add('endDate')
            ->add('price')
            ->add('num_participants');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('startDate')
            ->add('endDate')
            ->add('price')
            ->add('num_participants')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'show' => array(),
                )));
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('convention')
            ->add('description')
            ->add('startDate')
            ->add('endDate')
            ->add('price')
            ->add('num_participants')
        ;
    }
}
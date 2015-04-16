<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 28/03/15
 * Time: 11:13
 */


namespace AppBundle\Admin;

use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ConventionAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    public function createQuery($context = 'list')
    {
        $convention = $this->getConfigurationPool()->getContainer()->get('ritsiga.site.manager')->getCurrentSite();
        /** @var QueryBuilder $query */
        $query = parent::createQuery($context);
        $alias = current($query->getRootAliases());
        $query->andWhere($query->expr()->eq( $alias . '.id', $convention->getId() ));
        return $query;
    }


    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('organization', null, array(
                'label' => 'Organization',
                'help' => 'help.organization',
                'required' => true,
            ))
            ->add('name', 'text', array('label' => 'Name'))
            ->add('startsAt', 'date', array('label' => 'Start Date'))
            ->add('endsAt', 'date', array('label' => 'End Date'))
            ->add('email', 'email', array('label' => 'Email'))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array('label' => 'label.name'))
            ->add('startsAt', null, array('label' => 'label.startsAt'))
            ->add('endsAt', null, array('label' => 'label.endsAt'))
            ->add('email', null, array('label' => 'label.email'))
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('organization.name', null, array(
                'label' => 'Organization'
            ))
            ->add('name')
            ->add('startsAt')
            ->add('endsAt')
            ->add('email')
            ->add('web')
            ->add('domain')
            ->add('_action', 'actions', array(
            'actions' => array(
                'edit' => array(),
                'show' => array(),
            )))
        ;
    }
}

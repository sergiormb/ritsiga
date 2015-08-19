<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 25/07/15
 * Time: 10:51
 */

namespace AppBundle\Admin;

use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Admin\Admin;
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
        $query = parent::createQuery($context);

        return $query;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('last_name')
            ->add('phone')
            ->add('dni')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
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
            ->add('dni')
            ->add('registration.convention', null, array('label' => 'label.convention'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'show' => array(),
                ), 'label' => 'label.actions'))
        ;
    }
}
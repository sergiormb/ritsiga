<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 28/03/15
 * Time: 11:13
 */


namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ConventionAdmin extends Admin
{
    protected $baseRouteName = "ritsi_convention";
    protected $baseRoutePattern = 'ritsiGA/conventions';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Name'))
            ->add('startsAt', 'date', array('label' => 'Start Date'))
            ->add('endsAt', 'date', array('label' => 'End Date'))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('startsAt')
            ->add('endsAt')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('startsAt')
            ->add('endsAt')
        ;
    }
}

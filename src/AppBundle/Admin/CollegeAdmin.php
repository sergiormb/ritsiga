<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 30/04/15
 * Time: 21:48
 */

namespace AppBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CollegeAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('city')
            ->add('province')
            ->add('postcode')
            ->add('phone')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('city')
            ->add('province')
            ->add('postcode')
            ->add('phone')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('city')
            ->add('province')
            ->add('postcode')
            ->add('phone')
        ;
    }
}
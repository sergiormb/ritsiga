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
use Sonata\AdminBundle\Show\ShowMapper;

class ConventionAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $alias = current($query->getRootAliases());
        $convention = $this->getConfigurationPool()->getContainer()->get('ritsiga.site.manager')->getCurrentSite();
        if($convention != '')
        {
            $query->andWhere($query->expr()->eq( $alias . '.id', $convention->getId() ));
        }
        /** @var QueryBuilder $query */


        return $query;
    }


    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Name'))
            ->add('description', null, array('required' => false, 'attr' => array('class' => 'ckeditor')))
            ->add('startsAt', 'sonata_type_date_picker')
            ->add('endsAt', 'sonata_type_date_picker')
            ->add('email', 'email', array('label' => 'Email'))
            ->add('administrators', null, array('label' => 'Administrators'))
            ->add('image', 'file', array(
                'data_class' => null,
                'attr' => ['class' => 'filestyle'],
                'required' => false,
            ))
            ->add('maintenance', null, array(
                'label' => 'label.maintenance',
                'required' => false,
            ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('startsAt')
            ->add('endsAt')
            ->add('email')
            ->add('image',null,array(
                'template' => 'image/image.html.twig',
            ))
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
            ->add('maintenance', null, array('label' => 'label.maintenance'))
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('startsAt')
            ->add('endsAt')
            ->add('_action', 'actions', array(
            'actions' => array(
                'edit' => array(),
                'show' => array(),
            )))
        ;
    }

    public function prePersist($object)
    {
        if ($object->getImage()) {
            $this->getService('stof_doctrine_extensions.uploadable.manager')->markEntityToUpload($object, $object->getImage());
        }
    }

    public function preUpdate($object)
    {
        if ($object->getImage()) {
            $this->getService('stof_doctrine_extensions.uploadable.manager')->markEntityToUpload($object, $object->getImage());
        }
    }
}

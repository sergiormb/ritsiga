<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 1/05/15
 * Time: 19:19
 */

namespace AppBundle\Admin;

use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class RegistrationAdmin extends Admin
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
            $query->andWhere($query->expr()->eq( $alias . '.convention', $convention->getId() ));
        }
        /** @var QueryBuilder $query */


        return $query;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('convention')
            ->add('name')
            ->add('position')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('convention')
            ->add('name')
            ->add('position')
            ->add('status')
        ;
    }
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('convention')
            ->add('name')
            ->add('position')
            ->add('status')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('convention')
            ->add('name')
            ->add('position')
            ->add('status')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'show' => array(),
                )))
        ;
    }
}
<?php
namespace Base\TestBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;

//use Application\Sonata\AdminBundle\Admin\Admin as Base;

class AttributeCollectionAdmin extends Admin

{
    protected $maxPerPage = 8;

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('duplicate');
        $collection->add('view', $this->getRouterIdParameter().'/view');
        $collection->add('test', 'test');
    }  
    
    public function configureShowField(ShowMapper $showMapper)
    {

        $showMapper
            ->add('id')
            ->add('name')
            ->add('attributes')    
            ;
    }

    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('name')
                ->add('attributes','sonata_type_model', array())    
            ->end();
    }

    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('attributes')    
            ->add('_action', 'actions', array(
                    'actions' => array(
                                'view' => array(),
                                'edit' => array(),
                                'delete' => array(),
                                )
                            )
                    )
                ;
    }

    public function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('attributes')    
// ->add('tags', null, array('filter_field_options' => array('expanded' => true, 'multiple' => true)));
            ;
    }


}
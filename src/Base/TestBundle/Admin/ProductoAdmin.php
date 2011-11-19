<?php
namespace Base\TestBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;

//use Application\Sonata\AdminBundle\Admin\Admin as Base;

class ProductoAdmin extends Admin

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
            ->add('type')
            ->add('attribute1')    
            ->add('attribute2')    
            ->add('attribute3')    
            ->add('attribute4')    
            ->add('attribute5')                    
            ;
    }

    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('id')
                ->add('name')
                ->add('type')
                ->add('attribute1')    
                ->add('attribute2')    
                ->add('attribute3')    
                ->add('attribute4')    
                ->add('attribute5')                   
            ->end();
    }

    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('type')
            ->add('attribute1')    
            ->add('attribute2')    
            ->add('attribute3')    
            ->add('attribute4')    
            ->add('attribute5')                   
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
            ->add('type')
            ->add('attribute1')    
            ->add('attribute2')    
            ->add('attribute3')    
            ->add('attribute4')    
            ->add('attribute5')                   
// ->add('tags', null, array('filter_field_options' => array('expanded' => true, 'multiple' => true)));
            ;
    }


}
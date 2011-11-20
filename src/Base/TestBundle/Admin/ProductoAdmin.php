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
        $collection->add('createtype', 'createtype/'.$this->getRouterIdParameter());
        $collection->add('test', 'test');
          //ladybug_dump($this->getRouterIdParameter());
    }
    
    public function configureShowField(ShowMapper $showMapper)
    {

        $showMapper
            ->add('id')
            ->add('name')
            ->add('slug')
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
        $values = array('attribute1','attribute2','attribute3','attribute4');
                
        $formMapper
            ->with('General')
                ->add('name')
                ->add('slug','text',array('required' => false))
                ->add('type')
//                ->add('attribute1')    
//                ->add('attribute2')    
//                ->add('attribute3')    
//                ->add('attribute4')    
//                ->add('attribute5')                   
            ->end();
        
        $em = $this->getModelManager()->getEntityManager();

        $uri = $this->getRequest()->getUri();
        $uriArray = explode('/',$uri);
        $dato = array_pop($uriArray);
        $accion = array_pop($uriArray);
       // ladybug_dump_die($accion);
        if ( $accion == 'createtype'){
            $producto = $em->getRepository('BaseTestBundle:Producto')
                            ->find($dato);

            $tipo = $producto->getType()->getId();
            $entity = $em->getRepository('BaseTestBundle:AttributeCollection')->find($tipo);
            if (!is_null($entity)){            
                $data = array();
                foreach($entity->getAttributes() AS $key=>$field){
                    $data[$field->getName()] = $field->getName();
                }

            }        
            foreach($values As $value){
                echo $value;
                if (in_array($value, $data)){
                    $formMapper
                    ->with('General')
                            ->add($value)
                    ->end();
                }
            }            
        }else{
                
        $formMapper
            ->with('General')               
                ->add('attribute1')    
                ->add('attribute2')    
                ->add('attribute3')    
                ->add('attribute4')    
                ->add('attribute5')                   
            ->end();
        }

                   // ladybug_dump_die($this->getDatagrid()->getForm()->getChildren());
//          $keys = array();
//          $fields = $this->getDatagrid()->getForm()->getChildren();
//          foreach ($fields AS $key=>$field){
//              $keys[] = $key;
//          }
//              //ladybug_dump_die($keys);          
//         $test = $formMapper->with('Added');
//         foreach($keys AS $field){                
//                $test->add($field,'text' ,array("property_path" => false,'required' => false));
//            }          
//         $test->end();
//        $id = 4;
//        $em = $this->getModelManager()->getEntityManager();
//        //$entities = $em->getRepository('BaseTestBundle:AttributeCollection')->findAll();
//        $entity = $em->getRepository('BaseTestBundle:AttributeCollection')->find($id);
//        if (!is_null($entity)){
//            $test = $formMapper->with('Added');
//            $data = array();
//            foreach($entity->getAttributes() AS $key=>$field){
//                $data[$field->getName()] = $field->getName();
//                $test->add($field->getName(),'text' ,array("property_path" => false,'required' => false));
//            }
//            $test->end();        
//        }
    }

    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('slug')
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
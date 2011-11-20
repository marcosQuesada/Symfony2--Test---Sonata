<?php
namespace Base\TestBundle\Controller;

//use Application\Sonata\AdminBundle\Controller\CRUDController as Base;
use Sonata\AdminBundle\Controller\CRUDController as Base; 

class ProductoAdminController extends Base

{

    public function createtypeAction($id){
        echo "OK:$id";
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BaseTestBundle:Producto');
//        ladybug_dump_die($entities->findBySlug('testing'));
//        return $this->render('BaseTestBundle:Default:index.html.twig', array('name' => $id));
////        ladybug_dump_die($this);
////        die();
//        
        
        if (false === $this->admin->isGranted('EDIT')) {
            throw new AccessDeniedException();
        }

        $id = $this->get('request')->get($this->admin->getIdParameter());

        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        $this->admin->setSubject($object);

        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->get('request')->getMethod() == 'POST') {
            $form->bindRequest($this->get('request'));

            if ($form->isValid()) {
                $this->admin->update($object);
                $this->get('session')->setFlash('sonata_flash_success', 'flash_edit_success');

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array(
                        'result'    => 'ok',
                        'objectId'  => $this->admin->getNormalizedIdentifier($object)
                    ));
                }

                // redirect to edit mode
                return $this->redirectTo($object);
            }

            $this->get('session')->setFlash('sonata_flash_error', 'flash_edit_error');
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getEditTemplate(), array(
            'action' => 'edit',
            'form'   => $view,
            'object' => $object,
        ));        
    }
}
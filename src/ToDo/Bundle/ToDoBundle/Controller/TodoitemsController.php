<?php

namespace ToDo\Bundle\ToDoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ToDo\Bundle\ToDoBundle\Entity\Todoitems;
use ToDo\Bundle\ToDoBundle\Form\TodoitemsType;
use Symfony\Component\Finder\Exception\AccessDeniedException;

/**
 * Todoitems controller.
 *
 */
class TodoitemsController extends Controller
{

    /**
     * Lists all Todoitems entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        var_dump($this->getUser());
        //die();
        if ((false === $this->get('security.context')->isGranted('ROLE_ADMIN'))) {
            //filter about user
            //var_dump($this->getUser()->getId());
            $entities = $em->getRepository('ToDoToDoBundle:Todoitems')->findByUserId($this->getUser()->getId());
        }
        else
        {
            $entities = $em->getRepository('ToDoToDoBundle:Todoitems')->findAll();
        }
        return $this->render('ToDoToDoBundle:Todoitems:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Todoitems entity.
     *
     */
    public function createAction(Request $request)
    {
        if ((true === $this->get('security.context')->isGranted('ROLE_ADMIN'))) {
            throw new AccessDeniedException();
        }
        
        $entity = new Todoitems();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('todoitems_show', array('id' => $entity->getId())));
        }

        return $this->render('ToDoToDoBundle:Todoitems:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Todoitems entity.
     *
     * @param Todoitems $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Todoitems $entity)
    {
       
        $form = $this->createForm(new TodoitemsType(), $entity, array(
            'action' => $this->generateUrl('todoitems_create'),
            'method' => 'POST',
            'id' => $this->getUser()->getId()
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Todoitems entity.
     *
     */
    public function newAction()
    {
        if ((true === $this->get('security.context')->isGranted('ROLE_ADMIN'))) {
            throw new AccessDeniedException();
        }
        
        $entity = new Todoitems();
        $form   = $this->createCreateForm($entity);

        return $this->render('ToDoToDoBundle:Todoitems:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Todoitems entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ToDoToDoBundle:Todoitems')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Todoitems entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ToDoToDoBundle:Todoitems:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Todoitems entity.
     *
     */
    public function editAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ToDoToDoBundle:Todoitems')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Todoitems entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ToDoToDoBundle:Todoitems:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Todoitems entity.
    *
    * @param Todoitems $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Todoitems $entity)
    {
        $form = $this->createForm(new TodoitemsType(), $entity, array(
            'action' => $this->generateUrl('todoitems_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'id' => $this->getUser()->getId(),
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Todoitems entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ToDoToDoBundle:Todoitems')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Todoitems entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('todoitems_show', array('id' => $id)));
        }

        return $this->render('ToDoToDoBundle:Todoitems:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Todoitems entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ToDoToDoBundle:Todoitems')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Todoitems entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('todoitems'));
    }

    /**
     * Creates a form to delete a Todoitems entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('todoitems_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

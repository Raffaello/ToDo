<?php

namespace ToDo\Bundle\ToDoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ToDoToDoBundle:Default:index.html.twig');
    }
    
    public function adminAction()
    {
        //if ((false === $this->get('security.context')->isGranted('ROLE_ADMIN'))) {
        //    throw new AccessDeniedException();
        //}
        //return new Response("Admin page");
        return $this->render('ToDoToDoBundle:Default:admin.html.twig');
    }
    
    public function userAction($id)
    {
        //if ((false === $this->get('security.context')->isGranted('ROLE_USER'))) {
        //    throw new AccessDeniedException();
        //}
        //return new Response("User page id =".$id);
        return $this->render('ToDoToDoBundle:Default:user.html.twig', array('id' => $id));
    }
}

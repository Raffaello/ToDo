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
        //return new Response("Admin page");
        return $this->render('ToDoToDoBundle:Default:admin.html.twig');
    }
    
    public function userAction($id)
    {
        //return new Response("User page id =".$id);
        return $this->render('ToDoToDoBundle:Default:user.html.twig', array('id' => $id));
    }
}

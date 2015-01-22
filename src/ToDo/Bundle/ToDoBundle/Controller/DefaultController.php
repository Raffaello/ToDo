<?php

namespace ToDo\Bundle\ToDoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Response;
use ToDo\Bundle\ToDoBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultController extends Controller
{
    private function setUser($user)
    {
        $securityContext = $this->get('security.context');
        $oldtoken = $this->get('security.context')->getToken();
        var_dump($oldtoken);
        $providerKey = 'secured_area';
        var_dump('here');
        $token = new UsernamePasswordToken($user->getUsername(), $user->getPassword(), $providerKey, $user->getRoles());
        //todo change userprovider
        var_dump($token);
        $securityContext->setToken($token);
    }
    
    public function indexAction()
    {
        if ((true === $this->get('security.context')->isGranted('ROLE_OAUTH_USER'))) {
            $oauth = $this->getUser();
            var_dump($oauth);
            if (false === $oauth instanceof ToDo\Bundle\ToDoBundle\Entity\User) {
                var_dump('oauth');

                $em = $this->getDoctrine()->getManager();
                $entities = $em->getRepository('ToDoToDoBundle:User')->findByUsername($oauth->getUsername());    
                
                
                $ce = count($entities);
                var_dump($ce);
                if($ce == 0)
                {
                   // try {
                        $user = new User();

                        $user->setIsadmin(false);
                        $user->setPassword(""); //security issue, generate a random hask key
                        $user->setUsername($oauth->getUsername());

                        $em->persist($user);
                        $em->flush();
                        $this->setUser($user);
                        
                        
                    //}
                    
                }
                elseif($ce != 1)
                {
                    throw new \Symfony\Component\Config\Definition\Exception\Exception("more than 1 username with this openOAuth",0,0);
                }
                else
                {
                    $this->setUser($entities[0]);
                }
            }

        }
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
    
    /*
    public function userAction($id)
    {
        //if ((false === $this->get('security.context')->isGranted('ROLE_USER'))) {
        //    throw new AccessDeniedException();
        //}
        
        $em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('KitServerKatBundle:Autista')->findAll();
        $entities = $em->getRepository('ToDoToDoBundle:Todoitems')->findBy($id);

        
        return $this->render('ToDoToDoBundle:Default:user.html.twig', array(
            'id' => $id,
            'entities' => $entities));
    }
     */
    
    
}

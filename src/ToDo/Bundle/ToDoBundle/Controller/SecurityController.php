<?php

namespace ToDo\Bundle\ToDoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContext;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/login")
 */
class SecurityController extends Controller
{
    public function createSessionAction()
    {
        $usr    = $this->get('security.context');
        // if someone is logged in
        if($usr->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            // symfony automatically stores user, roles, authenticated
                    if($usr->isGranted('ROLE_ADMIN')) {
                        return $this->redirect($this->generateUrl('ToDoToDoBundle_admin'));
                    }elseif($usr->isGranted('ROLE_USER')){
                        return $this->redirect($this->generateUrl('ToDoToDoBundle_user'), $this->getUser()->getId());
                   }

        }

         $request = $this->get('request');
         $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        else if($request->attributes->has(SecurityContext::ACCESS_DENIED_ERROR)) {
           $error = $request->attributes->get(SecurityContext::ACCESS_DENIED_ERROR);
           // $error=0;
        }
        else
        {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        $lastusername=$session->get(SecurityContext::LAST_USERNAME);
        if($lastusername==NULL)
            $lastusername="";
        return array(
            'last_username' => $lastusername,//$last_username,
            'error'         => $error,
        );
    }

    /**
     * @Route("/login", name="_login")
     * @Template()
     */
    public function loginAction()
    {
        // check if user is already logged in
        $ret = $this->createSessionAction();
       // if($ret!=null)
        return $ret;

        //return array();
    }

    /**
     * @Route("/login_check", name="_login_check")
     */
    public function loginCheckAction()
    {
        // The security layer will intercept this request

    }

    /**
     * @Route("/logout", name="_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }

    /**
     * Changes current passsword
     *
     * @Route("/change_password", name="_change_password")
     * 
     */
    public function changePasswordAction()
    {
        //return $this->redirect($this->getRequest()->headers->get('referer'));
    }

}

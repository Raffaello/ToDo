<?php

namespace ToDo\Bundle\ToDoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Security\Core\User\UserInterface;
//use Symfony\Component\Security\Core\User\AdvancedUserInterface;
//use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUserProvider as BaseOAuthUserProvider;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * Users
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="ToDo\Bundle\ToDoBundle\Entity\Repository\UserRepository")
 */
 
//class User implements AdvancedUserInterface, \Serializable
//class User implements AdvancedUserInterface, \Serializable
class User extends BaseUser
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="isAdmin", type="boolean", nullable=true)
     */
    private $isadmin;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Constructor
     */
    public function __construct()
    {
         parent::__construct();
        //$this->salt     = md5(uniqid(null, true));
        $this->salt = "";
        $this->isActive = true;
    }

    public function getRoles()
    {
        if($this->getIsadmin() == true)
            return array('ROLE_ADMIN');
        else
            return array('ROLE_USER');
    }
    
    /**
     * Set isadmin
     *
     * @param boolean $isadmin
     * @return Users
     */
    public function setIsadmin($isadmin)
    {
        $this->isadmin = $isadmin;

        return $this;
    }

    /**
     * Get isadmin
     *
     * @return boolean 
     */
    public function getIsadmin()
    {
        return $this->isadmin;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}

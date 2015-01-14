<?php

namespace ToDo\Bundle\ToDoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Users
 *
 * @ORM\Table(name="Users")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="ToDo\Bundle\ToDoBundle\Entity\Repository\UserRepository")
 */
 
class User implements AdvancedUserInterface, \Serializable
{
    
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string",unique=true, length=25, nullable=false)
     */
    private $username;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=25, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=32, nullable=false)
     */
    private $salt;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive;
    
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=25, nullable=true)
     */
    private $password;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isAdmin", type="boolean", nullable=true)
     */
    private $isadmin;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Constructor
     */
    public function __construct()
    {
        //$this->salt     = md5(uniqid(null, true));
        $this->salt = "";
        $this->isActive = true;
    }
    
    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    public function isEqualTo(UserInterface $user)
    {
        return $this->username === $user->getUsername();
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            ) = unserialize($serialized);
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
    
    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    public function getRoles()
    {
        if($this->getIsadmin() == true)
            return array('ROLE_ADMIN');
        else
            return array('ROLE_USER');
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
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

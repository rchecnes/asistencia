<?php

namespace Chec\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Chec\UserBundle\Repository\UserRepository")
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=50)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $first_name;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $last_name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="password_ori", type="string", length=255, nullable=true)
     */
    private $password_ori;

    /**
     * @ORM\ManyToOne(targetEntity="Rol", inversedBy="user")
     * @ORM\JoinColumn(name="rol_id", referencedColumnName="id")
     */
    private $rol;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $is_active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at",nullable=true, type="datetime")
     */
    private $create_at;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at",nullable=true, type="datetime")
     */
    private $update_at;

    /**
     * @ORM\OneToMany(targetEntity="Chec\RegBundle\Entity\Asistencia", mappedBy="user")
     */
    private $asistencia;

    /**
     * @ORM\OneToMany(targetEntity="Chec\RegBundle\Entity\Asistencia", mappedBy="create_user")
     */
    private $asistencia_create_user;

    /**
     * @ORM\OneToMany(targetEntity="Chec\RegBundle\Entity\Asistencia", mappedBy="update_user")
     */
    private $asistencia_update_user;

    



    public function __construct()
    {
        //$this->tasks = new ArrayCollection();
        $this->is_active = true;
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

    /**
     * Set username
     *
     * @param string $username
     *
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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
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
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return boolean
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set passwordOri
     *
     * @param string $passwordOri
     *
     * @return User
     */
    public function setPasswordOri($passwordOri)
    {
        $this->password_ori = $passwordOri;

        return $this;
    }

    /**
     * Get passwordOri
     *
     * @return string
     */
    public function getPasswordOri()
    {
        return $this->password_ori;
    }

    /**
     * Set is_active
     *
     * @param boolean $is_active
     *
     * @return User
     */
    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * Get is_active
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return User
     */
    public function setCreateAt($createAt)
    {
        $this->create_at = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->create_at;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return User
     */
    public function setUpdateAt($updateAt)
    {
        $this->update_at = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->update_at;
    }

    /**
     * Set rol
     *
     * @param \Chec\UserBundle\Entity\Rol $rol
     *
     * @return User
     */
    public function setRol(\Chec\UserBundle\Entity\Rol $rol = null)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return \Chec\UserBundle\Entity\Rol
     */
    public function getRol()
    {
        return $this->rol;
    }


    
    public function getRoles(){
        $roles[] = 'ROLE_ADMIN';
        return $roles;
    }

    public function getSalt(){
        return null;
    }

    public function eraseCredentials(){
        
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->is_active
        ));
    }
    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->is_active
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
        return $this->is_active;
    }

    /**
     * Add asistencia
     *
     * @param \Chec\RegBundle\Entity\Asistencia $asistencia
     * @return User
     */
    public function addAsistencium(\Chec\RegBundle\Entity\Asistencia $asistencia)
    {
        $this->asistencia[] = $asistencia;

        return $this;
    }

    /**
     * Remove asistencia
     *
     * @param \Chec\RegBundle\Entity\Asistencia $asistencia
     */
    public function removeAsistencium(\Chec\RegBundle\Entity\Asistencia $asistencia)
    {
        $this->asistencia->removeElement($asistencia);
    }

    /**
     * Get asistencia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAsistencia()
    {
        return $this->asistencia;
    }

    /**
     * Add asistencia_create_user
     *
     * @param \Chec\RegBundle\Entity\Asistencia $asistenciaCreateUser
     * @return User
     */
    public function addAsistenciaCreateUser(\Chec\RegBundle\Entity\Asistencia $asistenciaCreateUser)
    {
        $this->asistencia_create_user[] = $asistenciaCreateUser;

        return $this;
    }

    /**
     * Remove asistencia_create_user
     *
     * @param \Chec\RegBundle\Entity\Asistencia $asistenciaCreateUser
     */
    public function removeAsistenciaCreateUser(\Chec\RegBundle\Entity\Asistencia $asistenciaCreateUser)
    {
        $this->asistencia_create_user->removeElement($asistenciaCreateUser);
    }

    /**
     * Get asistencia_create_user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAsistenciaCreateUser()
    {
        return $this->asistencia_create_user;
    }

    /**
     * Add asistencia_update_user
     *
     * @param \Chec\RegBundle\Entity\Asistencia $asistenciaUpdateUser
     * @return User
     */
    public function addAsistenciaUpdateUser(\Chec\RegBundle\Entity\Asistencia $asistenciaUpdateUser)
    {
        $this->asistencia_update_user[] = $asistenciaUpdateUser;

        return $this;
    }

    /**
     * Remove asistencia_update_user
     *
     * @param \Chec\RegBundle\Entity\Asistencia $asistenciaUpdateUser
     */
    public function removeAsistenciaUpdateUser(\Chec\RegBundle\Entity\Asistencia $asistenciaUpdateUser)
    {
        $this->asistencia_update_user->removeElement($asistenciaUpdateUser);
    }

    /**
     * Get asistencia_update_user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAsistenciaUpdateUser()
    {
        return $this->asistencia_update_user;
    }

    
}

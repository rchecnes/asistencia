<?php

namespace Chec\RegBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asistencia
 *
 * @ORM\Table(name="asistencia")
 * @ORM\Entity(repositoryClass="Chec\RegBundle\Repository\AsistenciaRepository")
 */
class Asistencia
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
     * @ORM\Column(name="user", type="string", length=255)
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ingreso", type="time", nullable=true)
     */
    private $ingreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ini_almuerzo", type="time", nullable=true)
     */
    private $ini_almuerzo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin_almuerzo", type="time", nullable=true)
     */
    private $fin_almuerzo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="salida", type="time", nullable=true)
     */
    private $salida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetimetz")
     */
    private $create_at;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetimetz")
     */
    private $update_at;

    /**
     * @var string
     *
     * @ORM\Column(name="create_user", type="string", length=255)
     */
    private $create_user;

    /**
     * @var string
     *
     * @ORM\Column(name="update_user", type="string", length=255)
     */
    private $update_user;

    

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
     * Set user
     *
     * @param string $user
     *
     * @return Asistencia
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set ingreso
     *
     * @param \DateTime $ingreso
     *
     * @return Asistencia
     */
    public function setIngreso($ingreso)
    {
        $this->ingreso = $ingreso;

        return $this;
    }

    /**
     * Get ingreso
     *
     * @return \DateTime
     */
    public function getIngreso()
    {
        return $this->ingreso;
    }

    /**
     * Set iniAlmuerzo
     *
     * @param \DateTime $iniAlmuerzo
     *
     * @return Asistencia
     */
    public function setIniAlmuerzo($iniAlmuerzo)
    {
        $this->ini_almuerzo = $iniAlmuerzo;

        return $this;
    }

    /**
     * Get iniAlmuerzo
     *
     * @return \DateTime
     */
    public function getIniAlmuerzo()
    {
        return $this->ini_almuerzo;
    }

    /**
     * Set finAlmuerzo
     *
     * @param \DateTime $finAlmuerzo
     *
     * @return Asistencia
     */
    public function setFinAlmuerzo($finAlmuerzo)
    {
        $this->fin_almuerzo = $finAlmuerzo;

        return $this;
    }

    /**
     * Get finAlmuerzo
     *
     * @return \DateTime
     */
    public function getFinAlmuerzo()
    {
        return $this->fin_almuerzo;
    }

    /**
     * Set salida
     *
     * @param \DateTime $salida
     *
     * @return Asistencia
     */
    public function setSalida($salida)
    {
        $this->salida = $salida;

        return $this;
    }

    /**
     * Get salida
     *
     * @return \DateTime
     */
    public function getSalida()
    {
        return $this->salida;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Asistencia
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
     * @return Asistencia
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
     * Set createUser
     *
     * @param string $createUser
     *
     * @return Asistencia
     */
    public function setCreateUser($createUser)
    {
        $this->create_user = $createUser;

        return $this;
    }

    /**
     * Get createUser
     *
     * @return string
     */
    public function getCreateUser()
    {
        return $this->create_user;
    }

    /**
     * Set updateUser
     *
     * @param string $updateUser
     *
     * @return Asistencia
     */
    public function setUpdateUser($updateUser)
    {
        $this->update_user = $updateUser;

        return $this;
    }

    /**
     * Get updateUser
     *
     * @return string
     */
    public function getUpdateUser()
    {
        return $this->update_user;
    }
}

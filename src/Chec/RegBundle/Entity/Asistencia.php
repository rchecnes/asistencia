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
     * @ORM\Column(name="ingreso", type="datetimetz")
     */
    private $ingreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ini_almuerzo", type="datetimetz")
     */
    private $iniAlmuerzo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="salida", type="datetimetz")
     */
    private $salida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetimetz")
     */
    private $createAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ended_at", type="datetimetz")
     */
    private $endedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="update_user", type="string", length=255)
     */
    private $updateUser;

    /**
     * @var string
     *
     * @ORM\Column(name="create_user", type="string", length=255)
     */
    private $createUser;


    /**
     * Get id
     *
     * @return int
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
        $this->iniAlmuerzo = $iniAlmuerzo;

        return $this;
    }

    /**
     * Get iniAlmuerzo
     *
     * @return \DateTime
     */
    public function getIniAlmuerzo()
    {
        return $this->iniAlmuerzo;
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
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set endedAt
     *
     * @param \DateTime $endedAt
     *
     * @return Asistencia
     */
    public function setEndedAt($endedAt)
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    /**
     * Get endedAt
     *
     * @return \DateTime
     */
    public function getEndedAt()
    {
        return $this->endedAt;
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
        $this->updateUser = $updateUser;

        return $this;
    }

    /**
     * Get updateUser
     *
     * @return string
     */
    public function getUpdateUser()
    {
        return $this->updateUser;
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
        $this->createUser = $createUser;

        return $this;
    }

    /**
     * Get createUser
     *
     * @return string
     */
    public function getCreateUser()
    {
        return $this->createUser;
    }
}


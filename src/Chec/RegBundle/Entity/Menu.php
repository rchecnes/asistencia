<?php

namespace Chec\RegBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="Chec\RegBundle\Repository\MenuRepository")
 */
class Menu
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
     * @var int
     *
     * @ORM\Column(name="padre", type="integer", options = {"comment" = "Padre del sub menu", "default"=0})
     */
    private $padre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tiene_hijo", type="boolean", options = {"comment" = "Si tiene hijo", "default"=0})
     */
    private $tiene_hijo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=60,)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="enlace", type="string", length=255)
     */
    private $enlace;

    /**
     * @var string
     *
     * @ORM\Column(name="css_icono", type="string", length=60, nullable=true)
     */
    private $css_icono;

    /**
     * @var string
     *
     * @ORM\Column(name="nivel", type="string", length=60, nullable=true, options = {"comment" = "Nivel", "default"=0})
     */
    private $nivel;

    /**
     * @var bool
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;


    

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
     * Set padre
     *
     * @param integer $padre
     *
     * @return Menu
     */
    public function setPadre($padre)
    {
        $this->padre = $padre;

        return $this;
    }

    /**
     * Get padre
     *
     * @return integer
     */
    public function getPadre()
    {
        return $this->padre;
    }

    /**
     * Set tieneHijo
     *
     * @param boolean $tieneHijo
     *
     * @return Menu
     */
    public function setTieneHijo($tieneHijo)
    {
        $this->tiene_hijo = $tieneHijo;

        return $this;
    }

    /**
     * Get tieneHijo
     *
     * @return boolean
     */
    public function getTieneHijo()
    {
        return $this->tiene_hijo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Menu
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set enlace
     *
     * @param string $enlace
     *
     * @return Menu
     */
    public function setEnlace($enlace)
    {
        $this->enlace = $enlace;

        return $this;
    }

    /**
     * Get enlace
     *
     * @return string
     */
    public function getEnlace()
    {
        return $this->enlace;
    }

    /**
     * Set cssIcono
     *
     * @param string $cssIcono
     *
     * @return Menu
     */
    public function setCssIcono($cssIcono)
    {
        $this->css_icono = $cssIcono;

        return $this;
    }

    /**
     * Get cssIcono
     *
     * @return string
     */
    public function getCssIcono()
    {
        return $this->css_icono;
    }

    /**
     * Set nivel
     *
     * @param string $nivel
     *
     * @return Menu
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return string
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Menu
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }
}

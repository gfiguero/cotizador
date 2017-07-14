<?php

namespace Kore\AdminBundle\Entity;

/**
 * Encuestador
 */
class Encuestador
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $rut;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $apellido;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $celular;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \DateTime
     */
    private $deleted_at;

    public function __toString()
    {
        return (string) $this->nombre . ' ' . (string) $this->apellido;
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
     * Set rut
     *
     * @param string $rut
     *
     * @return Encuestador
     */
    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

    /**
     * Get rut
     *
     * @return string
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Encuestador
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Encuestador
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Encuestador
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
     * Set celular
     *
     * @param string $celular
     *
     * @return Encuestador
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $created_at
     *
     * @return Encuestador
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updated_at
     *
     * @return Encuestador
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set deleted_at
     *
     * @param \DateTime $deleted_at
     *
     * @return Encuestador
     */
    public function setDeletedAt($deleted_at)
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }

    /**
     * Get deleted_at
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deleted_at;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $rutas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rutas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ruta
     *
     * @param \Kore\AdminBundle\Entity\Ruta $ruta
     *
     * @return Encuestador
     */
    public function addRuta(\Kore\AdminBundle\Entity\Ruta $ruta)
    {
        $this->rutas[] = $ruta;

        return $this;
    }

    /**
     * Remove ruta
     *
     * @param \Kore\AdminBundle\Entity\Ruta $ruta
     */
    public function removeRuta(\Kore\AdminBundle\Entity\Ruta $ruta)
    {
        $this->rutas->removeElement($ruta);
    }

    /**
     * Get rutas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRutas()
    {
        return $this->rutas;
    }

}

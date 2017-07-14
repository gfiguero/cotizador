<?php

namespace Kore\AdminBundle\Entity;

/**
 * RutaEstado
 */
class RutaEstado
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @var string
     */
    private $descripcion;

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
        return (string) $this->nombre;
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return RutaEstado
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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return RutaEstado
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return RutaEstado
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $created_at
     *
     * @return RutaEstado
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
     * @return RutaEstado
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
     * @return RutaEstado
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
     * @return RutaEstado
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

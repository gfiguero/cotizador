<?php

namespace Kore\AdminBundle\Entity;

/**
 * Ruta
 */
class Ruta
{
    /**
     * @var integer
     */
    private $id;

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
        return (string) $this->id;
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
     * Set created_at
     *
     * @param \DateTime $created_at
     *
     * @return Ruta
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
     * @return Ruta
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
     * @return Ruta
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
     * @var \Kore\AdminBundle\Entity\RutaEstado
     */
    private $estado;


    /**
     * Set estado
     *
     * @param \Kore\AdminBundle\Entity\RutaEstado $estado
     *
     * @return Ruta
     */
    public function setEstado(\Kore\AdminBundle\Entity\RutaEstado $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \Kore\AdminBundle\Entity\RutaEstado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $solicitudes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->solicitudes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add solicitude
     *
     * @param \Kore\AdminBundle\Entity\Solicitud $solicitude
     *
     * @return Ruta
     */
    public function addSolicitude(\Kore\AdminBundle\Entity\Solicitud $solicitude)
    {
        $solicitude->setRuta($this);

        $this->solicitudes[] = $solicitude;

        return $this;
    }

    /**
     * Remove solicitude
     *
     * @param \Kore\AdminBundle\Entity\Solicitud $solicitude
     */
    public function removeSolicitude(\Kore\AdminBundle\Entity\Solicitud $solicitude)
    {
        $solicitude->setRuta(null);

        $this->solicitudes->removeElement($solicitude);
    }

    /**
     * Get solicitudes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSolicitudes()
    {
        return $this->solicitudes;
    }
    /**
     * @var \Kore\AdminBundle\Entity\Encuestador
     */
    private $encuestador;


    /**
     * Set encuestador
     *
     * @param \Kore\AdminBundle\Entity\Encuestador $encuestador
     *
     * @return Ruta
     */
    public function setEncuestador(\Kore\AdminBundle\Entity\Encuestador $encuestador = null)
    {
        $this->encuestador = $encuestador;

        return $this;
    }

    /**
     * Get encuestador
     *
     * @return \Kore\AdminBundle\Entity\Encuestador
     */
    public function getEncuestador()
    {
        return $this->encuestador;
    }

}

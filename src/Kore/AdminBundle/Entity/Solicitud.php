<?php

namespace Kore\AdminBundle\Entity;

/**
 * Solicitud
 */
class Solicitud
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $folio;

    /**
     * @var string
     */
    private $nota;

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

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $acciones;

    /**
     * @var \Kore\AdminBundle\Entity\SolicitudEstado
     */
    private $estado;

    /**
     * @var \Kore\AdminBundle\Entity\Ruta
     */
    private $ruta;

    /**
     * @var \Kore\AdminBundle\Entity\Persona
     */
    private $persona;

    /**
     * @var \Kore\AdminBundle\Entity\SolicitudTipo
     */
    private $tipo;

    /**
     * @var \Kore\AdminBundle\Entity\Domicilio
     */
    private $domicilio;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->acciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->domicilio;
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
     * Set folio
     *
     * @param string $folio
     *
     * @return Solicitud
     */
    public function setFolio($folio)
    {
        $this->folio = $folio;

        return $this;
    }

    /**
     * Get folio
     *
     * @return string
     */
    public function getFolio()
    {
        return $this->folio;
    }

    /**
     * Set nota
     *
     * @param string $nota
     *
     * @return Solicitud
     */
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get nota
     *
     * @return string
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $created_at
     *
     * @return Solicitud
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
     * @return Solicitud
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
     * @return Solicitud
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
     * Add accione
     *
     * @param \Kore\AdminBundle\Entity\SolicitudAccion $accione
     *
     * @return Solicitud
     */
    public function addAccione(\Kore\AdminBundle\Entity\SolicitudAccion $accione)
    {
        $this->acciones[] = $accione;

        return $this;
    }

    /**
     * Remove accione
     *
     * @param \Kore\AdminBundle\Entity\SolicitudAccion $accione
     */
    public function removeAccione(\Kore\AdminBundle\Entity\SolicitudAccion $accione)
    {
        $this->acciones->removeElement($accione);
    }

    /**
     * Get acciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcciones()
    {
        return $this->acciones;
    }

    /**
     * Set estado
     *
     * @param \Kore\AdminBundle\Entity\SolicitudEstado $estado
     *
     * @return Solicitud
     */
    public function setEstado(\Kore\AdminBundle\Entity\SolicitudEstado $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \Kore\AdminBundle\Entity\SolicitudEstado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set ruta
     *
     * @param \Kore\AdminBundle\Entity\Ruta $ruta
     *
     * @return Solicitud
     */
    public function setRuta(\Kore\AdminBundle\Entity\Ruta $ruta = null)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get ruta
     *
     * @return \Kore\AdminBundle\Entity\Ruta
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set persona
     *
     * @param \Kore\AdminBundle\Entity\Persona $persona
     *
     * @return Solicitud
     */
    public function setPersona(\Kore\AdminBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \Kore\AdminBundle\Entity\Persona
     */
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * Set tipo
     *
     * @param \Kore\AdminBundle\Entity\SolicitudTipo $tipo
     *
     * @return Solicitud
     */
    public function setTipo(\Kore\AdminBundle\Entity\SolicitudTipo $tipo = null)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Kore\AdminBundle\Entity\SolicitudTipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    public function getDireccion()
    {
        return $this->getDomicilio()->getDireccion();
    }

    /**
     * Set domicilio
     *
     * @param \Kore\AdminBundle\Entity\Domicilio $domicilio
     *
     * @return Solicitud
     */
    public function setDomicilio(\Kore\AdminBundle\Entity\Domicilio $domicilio = null)
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * Get domicilio
     *
     * @return \Kore\AdminBundle\Entity\Domicilio
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

}

<?php

namespace Kore\AdminBundle\Entity;

/**
 * Persona
 */
class Persona
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
    private $primernombre;

    /**
     * @var string
     */
    private $segundonombre;

    /**
     * @var string
     */
    private $primerapellido;

    /**
     * @var string
     */
    private $segundoapellido;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $celular;

    /**
     * @var string
     */
    private $telefono;

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
        return (string) $this->primernombre . ' ' . $this->segundonombre . ' ' . $this->primerapellido . ' ' . $this->segundoapellido;
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
     * @return Persona
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
     * Set primernombre
     *
     * @param string $primernombre
     *
     * @return Persona
     */
    public function setPrimernombre($primernombre)
    {
        $this->primernombre = $primernombre;

        return $this;
    }

    /**
     * Get primernombre
     *
     * @return string
     */
    public function getPrimernombre()
    {
        return $this->primernombre;
    }

    /**
     * Set segundonombre
     *
     * @param string $segundonombre
     *
     * @return Persona
     */
    public function setSegundonombre($segundonombre)
    {
        $this->segundonombre = $segundonombre;

        return $this;
    }

    /**
     * Get segundonombre
     *
     * @return string
     */
    public function getSegundonombre()
    {
        return $this->segundonombre;
    }

    /**
     * Set primerapellido
     *
     * @param string $primerapellido
     *
     * @return Persona
     */
    public function setPrimerapellido($primerapellido)
    {
        $this->primerapellido = $primerapellido;

        return $this;
    }

    /**
     * Get primerapellido
     *
     * @return string
     */
    public function getPrimerapellido()
    {
        return $this->primerapellido;
    }

    /**
     * Set segundoapellido
     *
     * @param string $segundoapellido
     *
     * @return Persona
     */
    public function setSegundoapellido($segundoapellido)
    {
        $this->segundoapellido = $segundoapellido;

        return $this;
    }

    /**
     * Get segundoapellido
     *
     * @return string
     */
    public function getSegundoapellido()
    {
        return $this->segundoapellido;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Persona
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
     * @return Persona
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
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Persona
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $created_at
     *
     * @return Persona
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
     * @return Persona
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
     * @return Persona
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
    private $acciones;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->acciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add accione
     *
     * @param \Kore\AdminBundle\Entity\PersonaAccion $accione
     *
     * @return Persona
     */
    public function addAccione(\Kore\AdminBundle\Entity\PersonaAccion $accione)
    {
        $this->acciones[] = $accione;

        return $this;
    }

    /**
     * Remove accione
     *
     * @param \Kore\AdminBundle\Entity\PersonaAccion $accione
     */
    public function removeAccione(\Kore\AdminBundle\Entity\PersonaAccion $accione)
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $domicilios;


    /**
     * Add domicilio
     *
     * @param \Kore\AdminBundle\Entity\Domicilio $domicilio
     *
     * @return Persona
     */
    public function addDomicilio(\Kore\AdminBundle\Entity\Domicilio $domicilio)
    {
        $this->domicilios[] = $domicilio;

        return $this;
    }

    /**
     * Remove domicilio
     *
     * @param \Kore\AdminBundle\Entity\Domicilio $domicilio
     */
    public function removeDomicilio(\Kore\AdminBundle\Entity\Domicilio $domicilio)
    {
        $this->domicilios->removeElement($domicilio);
    }

    /**
     * Get domicilios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDomicilios()
    {
        return $this->domicilios;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $solicitudes;


    /**
     * Add solicitude
     *
     * @param \Kore\AdminBundle\Entity\Solicitud $solicitude
     *
     * @return Persona
     */
    public function addSolicitude(\Kore\AdminBundle\Entity\Solicitud $solicitude)
    {
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

}

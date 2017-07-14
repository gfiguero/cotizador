<?php

namespace Kore\AdminBundle\Entity;

/**
 * PersonaAccion
 */
class PersonaAccion
{
    /**
     * @var integer
     */
    private $id;

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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return PersonaAccion
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
     * @return PersonaAccion
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
     * @return PersonaAccion
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
     * @return PersonaAccion
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
     * @var \Kore\AdminBundle\Entity\Persona
     */
    private $persona;


    /**
     * Set persona
     *
     * @param \Kore\AdminBundle\Entity\Persona $persona
     *
     * @return PersonaAccion
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

}

<?php

namespace Kore\AdminBundle\Entity;

/**
 * Issuer
 */
class Issuer
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $rut;

    /**
     * @var string
     */
    private $address_street;

    /**
     * @var string
     */
    private $address_number;

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
     * @var \Kore\AdminBundle\Entity\User
     */
    private $user;

    public function __toString()
    {
        return (string) $this->name;
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
     * Set name
     *
     * @param string $name
     *
     * @return Issuer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set rut
     *
     * @param string $rut
     *
     * @return Issuer
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
     * Set addressStreet
     *
     * @param string $addressStreet
     *
     * @return Issuer
     */
    public function setAddressStreet($addressStreet)
    {
        $this->address_street = $addressStreet;

        return $this;
    }

    /**
     * Get addressStreet
     *
     * @return string
     */
    public function getAddressStreet()
    {
        return $this->address_street;
    }

    /**
     * Set addressNumber
     *
     * @param string $addressNumber
     *
     * @return Issuer
     */
    public function setAddressNumber($addressNumber)
    {
        $this->address_number = $addressNumber;

        return $this;
    }

    /**
     * Get addressNumber
     *
     * @return string
     */
    public function getAddressNumber()
    {
        return $this->address_number;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Issuer
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Issuer
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return Issuer
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deleted_at = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deleted_at;
    }

    /**
     * Set user
     *
     * @param \Kore\AdminBundle\Entity\User $user
     *
     * @return Issuer
     */
    public function setUser(\Kore\AdminBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Kore\AdminBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var \Kore\AdminBundle\Entity\Group
     */
    private $group;


    /**
     * Set group
     *
     * @param \Kore\AdminBundle\Entity\Group $group
     *
     * @return Issuer
     */
    public function setGroup(\Kore\AdminBundle\Entity\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Kore\AdminBundle\Entity\Group
     */
    public function getGroup()
    {
        return $this->group;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $budgets;

    /**
     * @var \Kore\AdminBundle\Entity\Commune
     */
    private $commune;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->budgets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add budget
     *
     * @param \Kore\AdminBundle\Entity\Budget $budget
     *
     * @return Issuer
     */
    public function addBudget(\Kore\AdminBundle\Entity\Budget $budget)
    {
        $this->budgets[] = $budget;

        return $this;
    }

    /**
     * Remove budget
     *
     * @param \Kore\AdminBundle\Entity\Budget $budget
     */
    public function removeBudget(\Kore\AdminBundle\Entity\Budget $budget)
    {
        $this->budgets->removeElement($budget);
    }

    /**
     * Get budgets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBudgets()
    {
        return $this->budgets;
    }

    /**
     * Set commune
     *
     * @param \Kore\AdminBundle\Entity\Commune $commune
     *
     * @return Issuer
     */
    public function setCommune(\Kore\AdminBundle\Entity\Commune $commune = null)
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * Get commune
     *
     * @return \Kore\AdminBundle\Entity\Commune
     */
    public function getCommune()
    {
        return $this->commune;
    }
}

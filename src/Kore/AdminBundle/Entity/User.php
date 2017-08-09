<?php

namespace Kore\AdminBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    private $budget_note;

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
    private $providers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sellers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $clients;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $budgets;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $products;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $notes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->providers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sellers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->budgets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->notes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set budgetNote
     *
     * @param string $budgetNote
     *
     * @return User
     */
    public function setBudgetNote($budgetNote)
    {
        $this->budget_note = $budgetNote;

        return $this;
    }

    /**
     * Get budgetNote
     *
     * @return string
     */
    public function getBudgetNote()
    {
        return $this->budget_note;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * Add provider
     *
     * @param \Kore\AdminBundle\Entity\Provider $provider
     *
     * @return User
     */
    public function addProvider(\Kore\AdminBundle\Entity\Provider $provider)
    {
        $this->providers[] = $provider;

        return $this;
    }

    /**
     * Remove provider
     *
     * @param \Kore\AdminBundle\Entity\Provider $provider
     */
    public function removeProvider(\Kore\AdminBundle\Entity\Provider $provider)
    {
        $this->providers->removeElement($provider);
    }

    /**
     * Get providers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * Add seller
     *
     * @param \Kore\AdminBundle\Entity\Seller $seller
     *
     * @return User
     */
    public function addSeller(\Kore\AdminBundle\Entity\Seller $seller)
    {
        $this->sellers[] = $seller;

        return $this;
    }

    /**
     * Remove seller
     *
     * @param \Kore\AdminBundle\Entity\Seller $seller
     */
    public function removeSeller(\Kore\AdminBundle\Entity\Seller $seller)
    {
        $this->sellers->removeElement($seller);
    }

    /**
     * Get sellers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSellers()
    {
        return $this->sellers;
    }

    /**
     * Add client
     *
     * @param \Kore\AdminBundle\Entity\Client $client
     *
     * @return User
     */
    public function addClient(\Kore\AdminBundle\Entity\Client $client)
    {
        $this->clients[] = $client;

        return $this;
    }

    /**
     * Remove client
     *
     * @param \Kore\AdminBundle\Entity\Client $client
     */
    public function removeClient(\Kore\AdminBundle\Entity\Client $client)
    {
        $this->clients->removeElement($client);
    }

    /**
     * Get clients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Add budget
     *
     * @param \Kore\AdminBundle\Entity\Budget $budget
     *
     * @return User
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
     * Add product
     *
     * @param \Kore\AdminBundle\Entity\Product $product
     *
     * @return User
     */
    public function addProduct(\Kore\AdminBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \Kore\AdminBundle\Entity\Product $product
     */
    public function removeProduct(\Kore\AdminBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Add note
     *
     * @param \Kore\AdminBundle\Entity\Note $note
     *
     * @return User
     */
    public function addNote(\Kore\AdminBundle\Entity\Note $note)
    {
        $this->notes[] = $note;

        return $this;
    }

    /**
     * Remove note
     *
     * @param \Kore\AdminBundle\Entity\Note $note
     */
    public function removeNote(\Kore\AdminBundle\Entity\Note $note)
    {
        $this->notes->removeElement($note);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotes()
    {
        return $this->notes;
    }
}


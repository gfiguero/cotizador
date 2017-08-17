<?php

namespace Kore\AdminBundle\Entity;

/**
 * Budget
 */
class Budget
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Budget
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
     * @return Budget
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
     * @return Budget
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $items;

    /**
     * @var \Kore\AdminBundle\Entity\Client
     */
    private $client;

    /**
     * @var \Kore\AdminBundle\Entity\Seller
     */
    private $seller;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add item
     *
     * @param \Kore\AdminBundle\Entity\Item $item
     *
     * @return Budget
     */
    public function addItem(\Kore\AdminBundle\Entity\Item $item)
    {
        $item->setBudget($this);

        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \Kore\AdminBundle\Entity\Item $item
     */
    public function removeItem(\Kore\AdminBundle\Entity\Item $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set client
     *
     * @param \Kore\AdminBundle\Entity\Client $client
     *
     * @return Budget
     */
    public function setClient(\Kore\AdminBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Kore\AdminBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set seller
     *
     * @param \Kore\AdminBundle\Entity\Seller $seller
     *
     * @return Budget
     */
    public function setSeller(\Kore\AdminBundle\Entity\Seller $seller = null)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * Get seller
     *
     * @return \Kore\AdminBundle\Entity\Seller
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * Get totalPrice
     *
     * @return integer
     */
    public function getTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->items as $item) {
            $totalPrice += $item->getTotalPrice();
        }
        return $totalPrice;
    }

    /**
     * Get totalNetPrice
     *
     * @return integer
     */
    public function getTotalNetPrice()
    {
        $totalNetPrice = 0;
        foreach ($this->items as $item) {
            $totalNetPrice += $item->getTotalNetPrice();
        }
        return $totalNetPrice;
    }

    /**
     * Get totalDiscountPrice
     *
     * @return integer
     */
    public function getTotalDiscountPrice()
    {
        $totalDiscountPrice = 0;
        foreach ($this->items as $item) {
            $totalDiscountPrice += $item->getTotalDiscountPrice();
        }
        return $totalDiscountPrice;
    }

    /**
     * Get totalIva
     */
    public function getTotalIva()
    {
        return 0.19 * $this->getTotalNetPrice();
    }

    /**
     * Get total
     */
    public function getTotal()
    {
        return 1.19 * $this->getTotalNetPrice();
    }

    public function setReferencePrices()
    {
        foreach ($this->items as $item) {
            $item->setReferencePrice();
        }
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $notes;


    /**
     * Add note
     *
     * @param \Kore\AdminBundle\Entity\Note $note
     *
     * @return Budget
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
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $note;


    /**
     * Set code
     *
     * @param string $code
     *
     * @return Budget
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Budget
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }
    /**
     * @var \Kore\AdminBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \Kore\AdminBundle\Entity\User $user
     *
     * @return Budget
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
     * @return Budget
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
     * @var string
     */
    private $name;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Budget
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
     * @var \DateTime
     */
    private $adjudicated_at;

    /**
     * @var \DateTime
     */
    private $expired_at;

    /**
     * @var \Kore\AdminBundle\Entity\Issuer
     */
    private $issuer;


    /**
     * Set adjudicatedAt
     *
     * @param \DateTime $adjudicatedAt
     *
     * @return Budget
     */
    public function setAdjudicatedAt($adjudicatedAt)
    {
        $this->adjudicated_at = $adjudicatedAt;

        return $this;
    }

    /**
     * Get adjudicatedAt
     *
     * @return \DateTime
     */
    public function getAdjudicatedAt()
    {
        return $this->adjudicated_at;
    }

    /**
     * Set expiredAt
     *
     * @param \DateTime $expiredAt
     *
     * @return Budget
     */
    public function setExpiredAt($expiredAt)
    {
        $this->expired_at = $expiredAt;

        return $this;
    }

    /**
     * Get expiredAt
     *
     * @return \DateTime
     */
    public function getExpiredAt()
    {
        return $this->expired_at;
    }

    /**
     * Set issuer
     *
     * @param \Kore\AdminBundle\Entity\Issuer $issuer
     *
     * @return Budget
     */
    public function setIssuer(\Kore\AdminBundle\Entity\Issuer $issuer = null)
    {
        $this->issuer = $issuer;

        return $this;
    }

    /**
     * Get issuer
     *
     * @return \Kore\AdminBundle\Entity\Issuer
     */
    public function getIssuer()
    {
        return $this->issuer;
    }
}

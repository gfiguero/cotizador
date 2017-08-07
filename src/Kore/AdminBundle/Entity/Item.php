<?php

namespace Kore\AdminBundle\Entity;

/**
 * Item
 */
class Item
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var integer
     */
    private $discount;

    /**
     * @var integer
     */
    private $price;

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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Item
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set discount
     *
     * @param integer $discount
     *
     * @return Item
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return integer
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Item
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
     * @return Item
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
     * @return Item
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
     * @var \Kore\AdminBundle\Entity\Budget
     */
    private $budget;

    /**
     * @var \Kore\AdminBundle\Entity\Product
     */
    private $product;


    /**
     * Set budget
     *
     * @param \Kore\AdminBundle\Entity\Budget $budget
     *
     * @return Item
     */
    public function setBudget(\Kore\AdminBundle\Entity\Budget $budget = null)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return \Kore\AdminBundle\Entity\Budget
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set product
     *
     * @param \Kore\AdminBundle\Entity\Product $product
     *
     * @return Item
     */
    public function setProduct(\Kore\AdminBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Kore\AdminBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Item
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get totalPrice
     *
     * @return integer
     */
    public function getTotalPrice()
    {
        return $this->getQuantity() * $this->getPrice();
    }

    /**
     * Get discountPrice
     *
     * @return integer
     */
    public function getDiscountPrice()
    {
        return round( $this->getPrice() * ($this->getDiscount() / 100));
    }

    /**
     * Get totalDiscountPrice
     *
     * @return integer
     */
    public function getTotalDiscountPrice()
    {
        return $this->getQuantity() * $this->getDiscountPrice();
    }

    /**
     * Get netPrice
     *
     * @return integer
     */
    public function getNetPrice()
    {
        return $this->getPrice() - $this->getDiscountPrice();
    }

    /**
     * Get totalNetPrice
     *
     * @return integer
     */
    public function getTotalNetPrice()
    {
        return $this->getQuantity() * $this->getNetPrice();
    }

    /**
     * Get totalIva
     *
     * @return integer
     */
    public function getTotalIva()
    {
        return round( 0.19 * $this->getTotalNetPrice() );
    }

    /**
     * Get total
     *
     * @return integer
     */
    public function getTotal()
    {
        return round( 1.19 * $this->getTotalNetPrice() );
    }

    public function setReferencePrice()
    {
        $product = $this->getProduct();

        if($product) {
            $this->setPrice( $product->getPrice() );
        }

        return $this;
    }
}

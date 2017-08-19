<?php

namespace Kore\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Product
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Product
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="image")
     * @var File
     */
    private $imagefile;

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
     * Set image
     *
     * @param string $image
     *
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        if ($this->image) return $this->image; else return 'default';
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setImagefile(File $image = null)
    {
        $this->imagefile = $image;

        if ($image) {
            $this->updated_at = new \DateTime();
        }
        
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImagefile()
    {
        return $this->imagefile;
    }

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $features;

    /**
     * @var integer
     */
    private $cost;

    /**
     * @var integer
     */
    private $price;

    /**
     * @var string
     */
    private $cm_code;

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
    private $items;

    /**
     * @var \Kore\AdminBundle\Entity\Provider
     */
    private $provider;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set features
     *
     * @param string $features
     *
     * @return Product
     */
    public function setFeatures($features)
    {
        $this->features = $features;

        return $this;
    }

    /**
     * Get features
     *
     * @return string
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * Set cost
     *
     * @param integer $cost
     *
     * @return Product
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return integer
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Product
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
     * Get netPrice
     *
     * @return integer
     */
    public function getNetPrice()
    {
        return round($this->getPrice() / 1.19, 0);
    }

    /**
     * Get iva
     *
     * @return integer
     */
    public function getIva()
    {
        return round($this->getNetPrice() * 0.19, 0);
    }

    /**
     * Get margin
     *
     * @return float
     */
    public function getMargin()
    {
        if ($this->getCost() and $this->getNetPrice()) {
            return (float) ( 1 - ( $this->getCost() / $this->getNetPrice() ));
        }
        return null;
    }

    /**
     * Set cmCode
     *
     * @param string $cmCode
     *
     * @return Product
     */
    public function setCmCode($cmCode)
    {
        $this->cm_code = $cmCode;

        return $this;
    }

    /**
     * Get cmCode
     *
     * @return string
     */
    public function getCmCode()
    {
        return $this->cm_code;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * Add item
     *
     * @param \Kore\AdminBundle\Entity\Item $item
     *
     * @return Product
     */
    public function addItem(\Kore\AdminBundle\Entity\Item $item)
    {
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
     * Set provider
     *
     * @param \Kore\AdminBundle\Entity\Provider $provider
     *
     * @return Product
     */
    public function setProvider(\Kore\AdminBundle\Entity\Provider $provider = null)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return \Kore\AdminBundle\Entity\Provider
     */
    public function getProvider()
    {
        return $this->provider;
    }
    /**
     * @var integer
     */
    private $height;

    /**
     * @var integer
     */
    private $width;

    /**
     * @var integer
     */
    private $length;

    /**
     * @var integer
     */
    private $weight;


    /**
     * Set height
     *
     * @param integer $height
     *
     * @return Product
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set width
     *
     * @param integer $width
     *
     * @return Product
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set length
     *
     * @param integer $length
     *
     * @return Product
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return integer
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return Product
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Get Size
     *
     * @return float
     */
    public function getSize()
    {
        return round(($this->height * $this->length * $this->width / 1000000), 3);
    }

    /**
     * Get density
     *
     * @return float
     */
    public function getDensity()
    {
        if($this->getSize())
        {
            return round(( $this->getWeight() / $this->getSize()), 3);
        }
        return null;
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
     * @return Product
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
     * @return Product
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
    private $upc;

    /**
     * @var string
     */
    private $brand;

    /**
     * @var string
     */
    private $origin;

    /**
     * @var string
     */
    private $resistance;

    /**
     * @var string
     */
    private $warranty;

    /**
     * @var string
     */
    private $certification;

    /**
     * @var string
     */
    private $consumer_name;

    /**
     * @var string
     */
    private $consumer_age;

    /**
     * @var string
     */
    private $consumer_capacity;

    /**
     * @var string
     */
    private $structure_main;

    /**
     * @var string
     */
    private $structure_side;

    /**
     * @var string
     */
    private $structure_instalation;

    /**
     * @var string
     */
    private $structure_assembly;

    /**
     * @var string
     */
    private $structure_protection;

    /**
     * @var string
     */
    private $structure_termination;

    /**
     * @var string
     */
    private $structure_color;

    /**
     * @var string
     */
    private $structure_size;


    /**
     * Set upc
     *
     * @param string $upc
     *
     * @return Product
     */
    public function setUpc($upc)
    {
        $this->upc = $upc;

        return $this;
    }

    /**
     * Get upc
     *
     * @return string
     */
    public function getUpc()
    {
        return $this->upc;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return Product
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set origin
     *
     * @param string $origin
     *
     * @return Product
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set resistance
     *
     * @param string $resistance
     *
     * @return Product
     */
    public function setResistance($resistance)
    {
        $this->resistance = $resistance;

        return $this;
    }

    /**
     * Get resistance
     *
     * @return string
     */
    public function getResistance()
    {
        return $this->resistance;
    }

    /**
     * Set warranty
     *
     * @param string $warranty
     *
     * @return Product
     */
    public function setWarranty($warranty)
    {
        $this->warranty = $warranty;

        return $this;
    }

    /**
     * Get warranty
     *
     * @return string
     */
    public function getWarranty()
    {
        return $this->warranty;
    }

    /**
     * Set certification
     *
     * @param string $certification
     *
     * @return Product
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;

        return $this;
    }

    /**
     * Get certification
     *
     * @return string
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * Set consumerName
     *
     * @param string $consumerName
     *
     * @return Product
     */
    public function setConsumerName($consumerName)
    {
        $this->consumer_name = $consumerName;

        return $this;
    }

    /**
     * Get consumerName
     *
     * @return string
     */
    public function getConsumerName()
    {
        return $this->consumer_name;
    }

    /**
     * Set consumerAge
     *
     * @param string $consumerAge
     *
     * @return Product
     */
    public function setConsumerAge($consumerAge)
    {
        $this->consumer_age = $consumerAge;

        return $this;
    }

    /**
     * Get consumerAge
     *
     * @return string
     */
    public function getConsumerAge()
    {
        return $this->consumer_age;
    }

    /**
     * Set consumerCapacity
     *
     * @param string $consumerCapacity
     *
     * @return Product
     */
    public function setConsumerCapacity($consumerCapacity)
    {
        $this->consumer_capacity = $consumerCapacity;

        return $this;
    }

    /**
     * Get consumerCapacity
     *
     * @return string
     */
    public function getConsumerCapacity()
    {
        return $this->consumer_capacity;
    }

    /**
     * Set structureMain
     *
     * @param string $structureMain
     *
     * @return Product
     */
    public function setStructureMain($structureMain)
    {
        $this->structure_main = $structureMain;

        return $this;
    }

    /**
     * Get structureMain
     *
     * @return string
     */
    public function getStructureMain()
    {
        return $this->structure_main;
    }

    /**
     * Set structureSide
     *
     * @param string $structureSide
     *
     * @return Product
     */
    public function setStructureSide($structureSide)
    {
        $this->structure_side = $structureSide;

        return $this;
    }

    /**
     * Get structureSide
     *
     * @return string
     */
    public function getStructureSide()
    {
        return $this->structure_side;
    }

    /**
     * Set structureInstalation
     *
     * @param string $structureInstalation
     *
     * @return Product
     */
    public function setStructureInstalation($structureInstalation)
    {
        $this->structure_instalation = $structureInstalation;

        return $this;
    }

    /**
     * Get structureInstalation
     *
     * @return string
     */
    public function getStructureInstalation()
    {
        return $this->structure_instalation;
    }

    /**
     * Set structureAssembly
     *
     * @param string $structureAssembly
     *
     * @return Product
     */
    public function setStructureAssembly($structureAssembly)
    {
        $this->structure_assembly = $structureAssembly;

        return $this;
    }

    /**
     * Get structureAssembly
     *
     * @return string
     */
    public function getStructureAssembly()
    {
        return $this->structure_assembly;
    }

    /**
     * Set structureProtection
     *
     * @param string $structureProtection
     *
     * @return Product
     */
    public function setStructureProtection($structureProtection)
    {
        $this->structure_protection = $structureProtection;

        return $this;
    }

    /**
     * Get structureProtection
     *
     * @return string
     */
    public function getStructureProtection()
    {
        return $this->structure_protection;
    }

    /**
     * Set structureTermination
     *
     * @param string $structureTermination
     *
     * @return Product
     */
    public function setStructureTermination($structureTermination)
    {
        $this->structure_termination = $structureTermination;

        return $this;
    }

    /**
     * Get structureTermination
     *
     * @return string
     */
    public function getStructureTermination()
    {
        return $this->structure_termination;
    }

    /**
     * Set structureColor
     *
     * @param string $structureColor
     *
     * @return Product
     */
    public function setStructureColor($structureColor)
    {
        $this->structure_color = $structureColor;

        return $this;
    }

    /**
     * Get structureColor
     *
     * @return string
     */
    public function getStructureColor()
    {
        return $this->structure_color;
    }

    /**
     * Set structureSize
     *
     * @param string $structureSize
     *
     * @return Product
     */
    public function setStructureSize($structureSize)
    {
        $this->structure_size = $structureSize;

        return $this;
    }

    /**
     * Get structureSize
     *
     * @return string
     */
    public function getStructureSize()
    {
        return $this->structure_size;
    }
    /**
     * @var string
     */
    private $short;


    /**
     * Set short
     *
     * @param string $short
     *
     * @return Product
     */
    public function setShort($short)
    {
        $this->short = $short;

        return $this;
    }

    /**
     * Get short
     *
     * @return string
     */
    public function getShort()
    {
        return $this->short;
    }
    /**
     * @var \Kore\AdminBundle\Entity\Account
     */
    private $account;


    /**
     * Set account
     *
     * @param \Kore\AdminBundle\Entity\Account $account
     *
     * @return Product
     */
    public function setAccount(\Kore\AdminBundle\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \Kore\AdminBundle\Entity\Account
     */
    public function getAccount()
    {
        return $this->account;
    }
    /**
     * @var integer
     */
    private $thickness;


    /**
     * Set thickness
     *
     * @param integer $thickness
     *
     * @return Product
     */
    public function setThickness($thickness)
    {
        $this->thickness = $thickness;

        return $this;
    }

    /**
     * Get thickness
     *
     * @return integer
     */
    public function getThickness()
    {
        return $this->thickness;
    }
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $consumer_traffic;

    /**
     * @var string
     */
    private $structure_anchorage;


    /**
     * Set code
     *
     * @param string $code
     *
     * @return Product
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
     * Set consumerTraffic
     *
     * @param string $consumerTraffic
     *
     * @return Product
     */
    public function setConsumerTraffic($consumerTraffic)
    {
        $this->consumer_traffic = $consumerTraffic;

        return $this;
    }

    /**
     * Get consumerTraffic
     *
     * @return string
     */
    public function getConsumerTraffic()
    {
        return $this->consumer_traffic;
    }

    /**
     * Set structureAnchorage
     *
     * @param string $structureAnchorage
     *
     * @return Product
     */
    public function setStructureAnchorage($structureAnchorage)
    {
        $this->structure_anchorage = $structureAnchorage;

        return $this;
    }

    /**
     * Get structureAnchorage
     *
     * @return string
     */
    public function getStructureAnchorage()
    {
        return $this->structure_anchorage;
    }
}

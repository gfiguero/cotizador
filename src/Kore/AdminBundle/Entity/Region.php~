<?php

namespace Kore\AdminBundle\Entity;

/**
 * Region
 */
class Region
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $provinces;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->provinces = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Region
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
     * Add province
     *
     * @param \Kore\AdminBundle\Entity\Province $province
     *
     * @return Region
     */
    public function addProvince(\Kore\AdminBundle\Entity\Province $province)
    {
        $this->provinces[] = $province;

        return $this;
    }

    /**
     * Remove province
     *
     * @param \Kore\AdminBundle\Entity\Province $province
     */
    public function removeProvince(\Kore\AdminBundle\Entity\Province $province)
    {
        $this->provinces->removeElement($province);
    }

    /**
     * Get provinces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProvinces()
    {
        return $this->provinces;
    }
    /**
     * @var string
     */
    private $iso;


    /**
     * Set iso
     *
     * @param string $iso
     *
     * @return Region
     */
    public function setIso($iso)
    {
        $this->iso = $iso;

        return $this;
    }

    /**
     * Get iso
     *
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }
}

<?php

namespace Kore\AdminBundle\Entity;

/**
 * Commune
 */
class Commune
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
     * @var \Kore\AdminBundle\Entity\Province
     */
    private $province;

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
     * @return Commune
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
     * Set province
     *
     * @param \Kore\AdminBundle\Entity\Province $province
     *
     * @return Commune
     */
    public function setProvince(\Kore\AdminBundle\Entity\Province $province = null)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return \Kore\AdminBundle\Entity\Province
     */
    public function getProvince()
    {
        return $this->province;
    }
}

<?php

namespace Ksp\ScienceBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ksp\ScienceBundle\Entity;

/**
 * Tech
 *
 */
class Tech
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $kspkey;

    /**
     * @var ArrayCollection[]Science
     */
    private $techs;

    public function __construct()
    {
        $this->techs = new ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Tech
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
     * Set kspkey
     *
     * @param string $kspkey
     * @return Tech
     */
    public function setKspkey($kspkey)
    {
        $this->kspkey = $kspkey;

        return $this;
    }

    /**
     * Get kspkey
     *
     * @return string 
     */
    public function getKspkey()
    {
        return $this->kspkey;
    }

    /**
     * Add techs
     *
     * @param Science $techs
     * @return Tech
     */
    public function addTech(Science $techs)
    {
        $this->techs[] = $techs;

        return $this;
    }

    /**
     * Remove techs
     *
     * @param Science $techs
     */
    public function removeTech(Science $techs)
    {
        $this->techs->removeElement($techs);
    }

    /**
     * Get techs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTechs()
    {
        return $this->techs;
    }
}

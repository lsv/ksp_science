<?php

namespace Ksp\ScienceBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Biome
 *
 * @ORM\Table(name="biome")
 * @ORM\Entity(repositoryClass="Ksp\ScienceBundle\Entity\Repository\Biome")
 */
class Biome
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="kspkey", type="string", length=255)
     */
    private $kspkey;

    /**
     * @var Planet
     *
     * @ORM\ManyToOne(targetEntity="Planet", inversedBy="biomes")
     */
    private $planet;

    /**
     * @var ArrayCollection[]Science
     *
     */
    private $sciences;

    public function __construct()
    {
        $this->sciences = new ArrayCollection();
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
     * @return Biome
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
     * @return Biome
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
     * Set planet
     *
     * @param \Ksp\ScienceBundle\Entity\Planet $planet
     * @return Biome
     */
    public function setPlanet(\Ksp\ScienceBundle\Entity\Planet $planet = null)
    {
        $this->planet = $planet;

        return $this;
    }

    /**
     * Get planet
     *
     * @return \Ksp\ScienceBundle\Entity\Planet 
     */
    public function getPlanet()
    {
        return $this->planet;
    }

    /**
     * Add sciences
     *
     * @param \Ksp\ScienceBundle\Entity\Science $sciences
     * @return Biome
     */
    public function addScience(\Ksp\ScienceBundle\Entity\Science $sciences)
    {
        $this->sciences[] = $sciences;

        return $this;
    }

    /**
     * Remove sciences
     *
     * @param \Ksp\ScienceBundle\Entity\Science $sciences
     */
    public function removeScience(\Ksp\ScienceBundle\Entity\Science $sciences)
    {
        $this->sciences->removeElement($sciences);
    }

    /**
     * Get sciences
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSciences()
    {
        return $this->sciences;
    }
}

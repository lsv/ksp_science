<?php

namespace Ksp\ScienceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Science
 *
 * @ORM\Table(name="science")
 * @ORM\Entity(repositoryClass="Ksp\ScienceBundle\Entity\Repository\Science")
 */
class Science
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
     * @var Biome
     *
     * @ORM\ManyToOne(targetEntity="Biome", inversedBy="sciences")
     */
    private $biome;

    /**
     * @var Tech
     *
     * @ORM\ManyToOne(targetEntity="Tech", inversedBy="techs")
     */
    private $tech;


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
     * Set biome
     *
     * @param \Ksp\ScienceBundle\Entity\Biome $biome
     * @return Science
     */
    public function setBiome(\Ksp\ScienceBundle\Entity\Biome $biome = null)
    {
        $this->biome = $biome;

        return $this;
    }

    /**
     * Get biome
     *
     * @return \Ksp\ScienceBundle\Entity\Biome 
     */
    public function getBiome()
    {
        return $this->biome;
    }

    /**
     * Set tech
     *
     * @param \Ksp\ScienceBundle\Entity\Tech $tech
     * @return Science
     */
    public function setTech(\Ksp\ScienceBundle\Entity\Tech $tech = null)
    {
        $this->tech = $tech;

        return $this;
    }

    /**
     * Get tech
     *
     * @return \Ksp\ScienceBundle\Entity\Tech 
     */
    public function getTech()
    {
        return $this->tech;
    }
}

<?php

namespace Ksp\ScienceBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tech
 *
 * @ORM\Table(name="tech")
 * @ORM\Entity(repositoryClass="Ksp\ScienceBundle\Entity\Repository\Tech")
 */
class Tech
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
     * @var ArrayCollection[]Science
     *
     * @ORM\OneToMany(targetEntity="Science", mappedBy="tech")
     */
    private $techs;

    public function __construct()
    {
        $this->techs = new ArrayCollection();
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
     * @param \Ksp\ScienceBundle\Entity\Science $techs
     * @return Tech
     */
    public function addTech(\Ksp\ScienceBundle\Entity\Science $techs)
    {
        $this->techs[] = $techs;

        return $this;
    }

    /**
     * Remove techs
     *
     * @param \Ksp\ScienceBundle\Entity\Science $techs
     */
    public function removeTech(\Ksp\ScienceBundle\Entity\Science $techs)
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

<?php

namespace Ksp\ScienceBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Planet
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="planet")
 * @ORM\Entity(repositoryClass="Ksp\ScienceBundle\Entity\Repository\Planet")
 */
class Planet
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
     * @ORM\Column(type="string", length=255)
     */
    private $kspkey;

    /**
     * @var ArrayCollection[]Planet
     *
     * @ORM\OneToMany(targetEntity="Biome", mappedBy="planet")
     */
    private $biomes;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(type="integer", nullable=true)
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Planet", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Planet", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @Gedmo\SortableGroup
     * @ORM\Column(type="string", length=128)
     */
    private $sortgroup;

    public function __construct()
    {
        $this->biomes = new ArrayCollection();
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
     * @return Planet
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
     * Set lft
     *
     * @param integer $lft
     * @return Planet
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer 
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Planet
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer 
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return Planet
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer 
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return Planet
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return integer 
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Add biomes
     *
     * @param \Ksp\ScienceBundle\Entity\Biome $biomes
     * @return Planet
     */
    public function addBiome(\Ksp\ScienceBundle\Entity\Biome $biomes)
    {
        $this->biomes[] = $biomes;

        return $this;
    }

    /**
     * Remove biomes
     *
     * @param \Ksp\ScienceBundle\Entity\Biome $biomes
     */
    public function removeBiome(\Ksp\ScienceBundle\Entity\Biome $biomes)
    {
        $this->biomes->removeElement($biomes);
    }

    /**
     * Get biomes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBiomes()
    {
        return $this->biomes;
    }

    /**
     * Set parent
     *
     * @param \Ksp\ScienceBundle\Entity\Planet $parent
     * @return Planet
     */
    public function setParent(\Ksp\ScienceBundle\Entity\Planet $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Ksp\ScienceBundle\Entity\Planet 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \Ksp\ScienceBundle\Entity\Planet $children
     * @return Planet
     */
    public function addChild(\Ksp\ScienceBundle\Entity\Planet $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Ksp\ScienceBundle\Entity\Planet $children
     */
    public function removeChild(\Ksp\ScienceBundle\Entity\Planet $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set kspkey
     *
     * @param string $kspkey
     * @return Planet
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
     * Set position
     *
     * @param integer $position
     * @return Planet
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set sortgroup
     *
     * @param string $sortgroup
     * @return Planet
     */
    public function setSortgroup($sortgroup)
    {
        $this->sortgroup = $sortgroup;

        return $this;
    }

    /**
     * Get sortgroup
     *
     * @return string 
     */
    public function getSortgroup()
    {
        return $this->sortgroup;
    }
}

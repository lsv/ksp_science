<?php

namespace Ksp\ScienceBundle\Document;

use Doctrine\ORM\Mapping as ORM;
use Ksp\ScienceBundle\Entity;

/**
 * Science
 *
 */
class Science
{
    /**
     * @var Entity\Biome
     */
    private $biome;

    /**
     * @var Tech
     */
    private $tech;


    /**
     * Set biome
     *
     * @param Entity\Biome $biome
     * @return Science
     */
    public function setBiome(Entity\Biome $biome = null)
    {
        $this->biome = $biome;

        return $this;
    }

    /**
     * Get biome
     *
     * @return Entity\Biome
     */
    public function getBiome()
    {
        return $this->biome;
    }

    /**
     * Set tech
     *
     * @param Tech $tech
     * @return Science
     */
    public function setTech(Tech $tech = null)
    {
        $this->tech = $tech;

        return $this;
    }

    /**
     * Get tech
     *
     * @return Tech
     */
    public function getTech()
    {
        return $this->tech;
    }
}

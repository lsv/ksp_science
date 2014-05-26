<?php
namespace Ksp\ScienceBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Ksp\ScienceBundle\DataFixtures\Fixture;
use Ksp\ScienceBundle\Entity;
use Ksp\ScienceBundle\FileParser\Parser;

class Biomes extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $biomesUsed = array();
        $lines = explode("\n", $this->getBiomes());
        foreach($lines as $line) {
            $biomeandplanet = Parser::parseBiomeAndPlanet($line);
            if ($biomeandplanet === false) {
                continue;
            }

            $planet = $biomeandplanet['planet'];
            $biome = $biomeandplanet['biome'];

            if (in_array(strtolower($planet) . '-' . strtolower($biome), $biomesUsed)) {
                continue;
            }

            $biomesUsed[] = strtolower($planet) . '-' . strtolower($biome);

            $obj = new Entity\Biome();
            $obj
                ->setName($this->getBiomeName(strtolower($biome)))
                ->setKspkey(strtolower($biome))
                ->setPlanet($this->getReference('planet-' . strtolower($planet)))
            ;

            $manager->persist($obj);

        }

        $manager->flush();

    }

    public function getOrder()
    {
        return 2;
    }

} 
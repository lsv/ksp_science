<?php
namespace Ksp\ScienceBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Ksp\ScienceBundle\DataFixtures\Fixture;

class Biomes extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $lines = explode("\n", $this->getBiomes());
        foreach($lines as $line) {

        }
    }

    public function getOrder()
    {
        return 2;
    }

} 
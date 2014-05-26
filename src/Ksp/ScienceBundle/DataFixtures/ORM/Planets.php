<?php
namespace Ksp\ScienceBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Ksp\ScienceBundle\DataFixtures\Fixture;
use Ksp\ScienceBundle\Entity\Planet;

class Planets extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $this->parseArray($manager, $this->getPlanets());
        $manager->flush();
    }

    private function parseArray(ObjectManager $manager, array $planets, Planet $parent = null)
    {
        foreach($planets as $sort => $planet) {
            if (! array_key_exists('key', $planet)) {
                $key = $planet['name'];
            } else {
                $key = $planet['key'];
            }

            $entity = new Planet;
            $entity
                ->setName($planet['name'])
                ->setKspkey(strtolower($key))
                ->setPosition($sort)
                ->setSortgroup(($parent === null ? 'root' : strtolower($parent->getName())))
            ;

            if ($parent !== null) {
                $entity->setParent($parent);
            }

            $this->setReference('planet-' . strtolower($key), $entity);
            $manager->persist($entity);

            if (array_key_exists('children', $planet) && is_array($planet['children'])) {
                $this->parseArray($manager, $planet['children'], $entity);
            }

        }
    }

    public function getOrder()
    {
        return 1;
    }

} 
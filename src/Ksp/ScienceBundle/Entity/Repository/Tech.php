<?php

namespace Ksp\ScienceBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TechRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Tech extends EntityRepository
{

    private $values = array(
        array('name' => 'Crew Report', 'key' => 'crewReport'),
        array('name' => 'EVA Report', 'key' => 'evaReport'),
        array('name' => 'Mystery Goo', 'key' => 'mysteryGoo'),
        array('name' => 'Surface sample', 'key' => 'surfaceSample'),
        array('name' => 'Materials Bay', 'key' => 'mobileMaterialsLab'),
        array('name' => 'Temperature Scan', 'key' => 'temperatureScan'),
        array('name' => 'Barometer Scan', 'key' => 'barometerScan'),
        array('name' => 'Seismic Scan', 'key' => 'seismicScan'),
        array('name' => 'Gravity Scan', 'key' => 'gravityScan'),
        array('name' => 'Atmosphere Analysis', 'key' => 'atmosphereAnalysis'),
        array('name' => 'Recovery of a vessel', 'key' => 'recovery'),
    );

}

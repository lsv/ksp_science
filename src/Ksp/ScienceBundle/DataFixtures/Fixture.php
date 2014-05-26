<?php
namespace Ksp\ScienceBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

abstract class Fixture extends AbstractFixture implements OrderedFixtureInterface
{

    abstract public function load(ObjectManager $manager);
    abstract public function getOrder();

    protected function getPlanets()
    {
        return array(
            array('name' => 'Sun', 'children' => array(
                array('name' => 'Moho'),
                array('name' => 'Eve', 'children' => array(
                    array('name' => 'Gilly'),
                )),
                array('name' => 'Kerbin', 'children' => array(
                    array('name' => 'Mün', 'key' => 'Mun'),
                    array('name' => 'Minmus'),
                )),
                array('name' => 'Duna', 'children' => array(
                    array('name' => 'Ike'),
                )),
                array('name' => 'Dres'),
                array('name' => 'Jool', 'children' => array(
                    array('name' => 'Laythe'),
                    array('name' => 'Vall'),
                    array('name' => 'Tylo'),
                    array('name' => 'Bop'),
                    array('name' => 'Pol'),
                )),
                array('name' => 'Eeloo'),
            )),
        );
    }

    /**
     * @param $biome
     * @throws \Exception
     * @return string
     */
    protected function getBiomeName($biome)
    {
        $names = array(
            'srflandedlaunchpad' => 'Surface (Launchpad)',
            'srflandedrunway' => 'Surface (Runway)',
            'srflandedksc' => 'Surface (KSC)',
            'flyinglowgrasslands' => 'Flying low (Grasslands)',
            'flyinglowhighlands' => 'Flying low (Highlands)',
            'flyinglowmountains' => 'Flying low (Mountains)',
            'flyinglowdeserts' => 'Flying low (Deserts)',
            'flyinglowbadlands' => 'Flying low (Badlands)',
            'flyinglowtundra' => 'Flying low (Tundra)',
            'flyinglowicecaps' => 'Flying low (IceCaps)',
            'flyinglowshores' => 'Flying low (Shores)',
            'flyinglowwater' => 'Flying low (Water)',
            'inspacelow' => 'In low space',
            'inspace' => 'In space',
            'srflanded' => 'Surface',
            'srf' => 'Surface',
            'inspacehigh' => 'In high space',
            'flyinglow' => 'Flying low',
            'flyinghigh' => 'flying high',
            'srflandeddeserts' => 'Surface (Deserts)',
            'srfsplashedwater' => 'Splashed (Water)',
            'srfsplashedshores' => 'Splashed (Shores)',
            'srflandedshores' => 'Landed (Shores)',
            'srflandedgrasslands' => 'Landed (Grasslands)',
            'srflandedhighlands' => 'Landed (Highlands)',
            'srflandedmountains' => 'Landed (Mountains)',
            'srflandedtundra' => 'Landed (Tundra)',
            'srflandedicecaps' => 'Landed (IceCaps)',
            'srflandedbadlands' => 'Landed (Badlands)',
            'srflandedwater' => 'Landed (Water)',
            'srflandedmidlands' => 'Landed (Midlands)',
            'srflandednorthernbasin' => 'Landed (Northern Basin)',
            'srflandedeastcrater' => 'Landed (East Crater)',
            'srflandednorthwestcrater' => 'Landed (Northwest Crater)',
            'srflandedsouthwestcrater' => 'Landed (Southwest Crater)',
            'srflandedfarsidecrater' => 'Landed (Farside Crater)',
            'srflandedcanyons' => 'Landed (Canyons)',
            'srflandedpolarcrater' => 'Landed (Polar Crater)',
            'srflandedpoles' => 'Landed (Poles)',
            'srflandedpolarlowlands' => 'Landed (Polar Lowlands)',
            'srflandedhighlandcraters' => 'Landed (Highland Crater)',
            'srflandedmidlandcraters' => 'Landed (Midland Crater)',
            'srflandedeastfarsidecrater' => 'Landed (East Farside Crater)',
            'srflandedtwincraters' => 'Landed (Twin Crater)',
            'srfsplashed' => 'Surface (Splashed)',
            'srfbadlands' => 'Surface (Badlands)',
            'inspacegrasslands' => 'In space (Grasslands)',
            'inspacehighlands' => 'In space (Highlands)',
            'inspacemountains' => 'In space (Mountains)',
            'inspacedeserts' => 'In space (Deserts)',
            'inspacebadlands' => 'In space (Badlands)',
            'inspaceicecaps' => 'In space (Ice Caps)',
            'inspaceshores' => 'In space (Shores)',
            'inspacewater' => 'In space (Water)',
        );

        if (array_key_exists($biome, $names)) {
            return $names[$biome];
        }

        throw new \Exception('Biome (' . $biome . ') was not found');

    }

    protected function getBiomes()
    {
        return <<<'EOF'
KerbinSrfLandedLaunchpad
KerbinSrfLandedRunway
KerbinSrfLandedKSC
KerbinFlyingLowGrasslands
KerbinFlyingLowGrasslands
KerbinFlyingLowHighlands
KerbinFlyingLowMountains
KerbinFlyingLowDeserts
KerbinFlyingLowBadlands
KerbinFlyingLowTundra
KerbinFlyingLowIceCaps
KerbinFlyingLowShores
KeringFlyingLowWater
KerbinInSpaceLow
KerbinInSpaceLow
KerbinInSpace
KerbinInSpace
MunInSpace
MunInSpace
MinmusInSpace
MinmusInSpace
GillyInSpace
MohoInSpace
EveInSpace
DunaInSpace
IkeInSpace
IkeInSpace
DresInSpace
DresInSpace
JoolInSpace
JoolInSpace
LaytheInSpace
LaytheInSpace
VallInSpace
VallInSpace
TyloInSpace
TyloInSpace
BopInSpace
BopInSpace
PolInSpace
PolInSpace
EelooInSpace
EelooInSpace
MohoSrfLanded
EveSrfLanded
EveSrfLanded
GillySrfLanded
KerbinSrf
SunInSpaceHigh
KerbinFlyingLow
KerbinFlyingHigh
MunSrfLanded
MunSrfLanded
MunSrfLanded
MunFlyingLow
MunFlyingHigh
MinmusSrfLanded
DunaSrfLanded
DunaSrfLanded
IkeSrfLanded
IkeSrfLanded
DresSrfLanded
JoolSrfLanded
LaytheSrfLanded
LaytheSrfLanded
VallSrfLanded
TyloSrfLanded
BopSrfLanded
PolSrfLanded
EeelooSrfLanded
KerbinSrfLandedLaunchPad
KerbinSrfLandedRunway
KerbinSrfLandedDeserts
KerbinSrfSplashedWater
KerbinSrfSplashedShores
KerbinSrfLandedShores
KerbinSrfLandedKSC
KerbinFlyingLow
KerbinFlyingHigh
KerbinInSpaceLow
MohoInSpace
EveInSpace
EveInSpace
DunaInSpace
Mun
InSpace
BopInSpace
PolInSpace
EeLooInSpace
EeLooInSpace
KerbinSrfLandedGrasslands
KerbinSrfLandedHighlands
KerbinSrfLandedMountains
KerbinSrfLandedDeserts
KerbinSrfLandedTundra
KerbinSrfLandedIceCaps
KerbinSrfLandedShores
KerbinSrfLandedBadlands
KerbinSrfLandedWater
KerbinSrfSplashedWater
KerbinSrfSplashedShores
KerbinSrfLandedLaunchPad
KerbinSrfLandedRunway
KerbinSrfLandedKSC
MunSrfLanded
MunSrfLandedMidlands
MunSrfLandedMidlands
MunSrfLandedNorthernBasin
MunSrfLandedNorthernBasin
MunSrfLandedEastCrater
MunSrfLandedEastCrater
MunSrfLandedNorthwestCrater
MunSrfLandedNorthWestCrater
MunSrfLandedSouthwestCrater
MunSrfLandedSouthWestCrater
MunSrfLandedFarsideCrater
MunSrfLandedFarsideCrater
MunSrfLandedCanyons
MunSrfLandedPolarCrater
MunSrfLandedPolarCrater
MunSrfLandedPoles
MunSrfLandedPolarLowlands
MunSrfLandedHighlands
MunSrfLandedHighlands
MunSrfLandedHighlandCraters
MunSrfLandedHighlandCraters
MunSrfLandedHighlandCraters
MunSrfLandedHighlandCraters
MunSrfLandedMidlandCraters
MunSrfLandedMidlandCraters
MunSrfLandedMidlandCraters
MunSrfLandedMidlandCraters
MunSrfLandedMidlandCraters
MunSrfLandedEastFarsideCrater
MunSrfLandedEastFarsideCrater
MunSrfLandedTwinCraters
MunSrfLandedTwinCraters
MunSrfLandedTwinCraters
MinmusSrfLanded
MinmusSrfLanded
EveSrfLanded
DunaSrfLanded
DunaSrfLanded
DunaSrfLanded
MohoSrfLanded
GillySrfLanded
GillySrfLanded
IkeSrfLanded
IkeSrfLanded
DresSrfLanded
DresSrfLanded
LaytheSrfLanded
VallSrfLanded
VallSrfLanded
TyloSrfLanded
TyloSrfLanded
BopSrfLanded
BopSrfLanded
PolSrfLanded
PolSrfLanded
PolSrfLanded
EelooSrfLanded
EelooSrfLanded
EelooSrfLanded
SunFlyingLow
MohoSrfLanded
MohoSrfLanded
KerbinSrfLanded
KerbinSrfLandedDeserts
KerbinSrfLandedIceCaps
KerbinSrfLandedShores
KerbinSrfLandedWater
KerbinSrfLandedWater
KerbinSrfLandedBadlands
KerbinFlyingLow
KerbinFlyingHigh
KerbinInSpaceLow
MunSrfLanded
MunSrfLanded
MinmusSrfLanded
InSpace
EveSrfLanded
EveSrfLanded
EveFlyingHigh
EveFlyingLow
GillySrfLanded
GillySrfLanded
DunaSrfLanded
DunaSrfLanded
IkeSrfLanded
IkeSrfLanded
DresSrfLanded
DresSrfLanded
JoolInSpace
JoolFlyingHigh
JoolFlyingLow
JoolSrfLanded
LaytheFlyingHigh
LaytheFlyingLow
LaytheSrfLanded
LaytheSrfSplashed
VallSrfLanded
VallSrfLanded
TyloSrfLanded
BopSrfLanded
BopSrfLanded
PolSrfLanded
EelooSrfLanded
KerbinSrfLanded
KerbinSrfLandedDeserts
KerbinSrfLandedIceCaps
KerbinSrfLandedShores
KerbinSrfLandedWater
KerbinSrfLandedTundra
KerbinSrfLandedGrasslands
KerbinSrfBadlands
MohoSrfLanded
EveSrfLanded
MohoFlyingLow
MohoSrfLanded
EveFlyingLow
EveSrfLanded
GillyFlyingLow
GillySrfLanded
MunFlyingLow
MunSrfLanded
MunSrfLanded
DunaFlyingLow
DunaSrfLanded
IkeFlyingLow
IkeSrfLanded
JoolFlyingLow
JoolFlyingHigh
JoolSrfLanded
LaytheFlyingLow
LaytheSrfLanded
VallFlyingLow
VallSrfLanded
VallSrfLanded
TyloFlyingLow
TyloSrfLanded
BopFlyingLow
BopSrfLanded
PolFlyingLow
PolSrfLanded
EelooSrfLanded
EelooFlyingLow
MohoSrfLanded
MohoSrfLanded
EveSrfLanded
EveSrfLanded
GillySrfLanded
GillySrfLanded
MunSrfLanded
MunSrfLanded
MinmusSrfLanded
MinmusSrfLanded
DunaSrfLanded
DunaSrfLanded
DresSrfLanded
DresSrfLanded
DresSrfLanded
JoolSrfLanded
JoolSrfLanded
LaytheSrfLanded
LaytheSrfLanded
VallSrfLanded
VallSrfLanded
TyloSrfLanded
TyloSrfLanded
BopSrfLanded
BopSrfLanded
PolSrfLanded
PolSrfLanded
EelooSrfLanded
EelooSrfLanded
MohoInSpace
MohoSrfLanded
EveInSpace
EveSrfLanded
GillyInSpace
GillySrfLanded
KerbinInSpace
KerbinSrfLanded
KerbinSrfLanded
KerbinInSpaceGrassLands
KerbinInSpaceHighlands
KerbinInSpaceMountains
KerbinInSpaceDeserts
KerbinInSpaceBadlands
KerbinInSpaceIceCaps
KerbinInSpaceShores
KerbinInSpaceWater
KerbinSrfSplashedWater
MunInSpace
MunSrfLanded
MunSrfLanded
MinmusInSpace
MinmusSrfLanded
MinmusSrfLanded
DunaInSpace
DunaSrfLanded
DunaSrfLanded
DresInSpace
DresSrfLanded
JoolInSpace
JoolInSpace
JoolSrfLanded
LaytheInSpace
LaytheSrfLanded
LaytheSrfSplashed
VallInSpace
VallSrfLanded
TyloInSpace
TyloSrfLanded
BopInSpace
BopSrfLanded
PolInSpace
PolSrfLanded
EelooInSpace
EelooSrfLanded
MohoSrf
EveSrf
GillySrf
KerbinFlyingHigh
KerbinSrfLanded
KerbinSrfLandedDeserts
KerbinSrfLandedIceCaps
MunSrf
MinmusSrf
DunaSrf
DunaSrf
IkeSrf
DresSrf
JoolFlyingHigh
JoolFlyingLow
JoolSrfLanded
LaytheSrfLanded
LaytheSrfLanded
VallSrfLanded
TyloSrfLanded
BopSrfLanded
BopSrfLanded
PolSrfLanded
EelooSrfLanded
EOF;

    }
} 
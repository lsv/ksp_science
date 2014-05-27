<?php

namespace Ksp\ScienceBundle\Controller;

use Ksp\ScienceBundle\FileParser\Parser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    
    /**
     * @Route("/", name="default_index")
     * @Method("GET|POST")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $sciences = array();
        if ($request->isMethod('POST')) {
            $parser = new Parser($request->files->get('persistent'));
            try {
                $parser->validatePersistentFile();
            } catch (\Exception $e) {
                throw $e;
            }
            
            $sciences = $parser->parsePersistentFile();
        }
        
        return array(
            'sciences' => $sciences,
            'biomes' => $this->getBiomes(),
            'techs' => $this->getTechs()
        );
    }
    
    private function getBiomes()
    {
        $file = __DIR__ . '/../biomes.json';
        return $this->parsePlanets(json_decode(file_get_contents($file), true));
    }
    
    private function parsePlanets(array $planets)
    {
        $tech = array(
            'crewReport' => array('name' => 'crewReport', 'avail' => 1),
            'evaReport' => array('name' => 'evaReport', 'avail' => 1),
            'mysteryGoo' => array('name' => 'mysteryGoo', 'avail' => 1),
            'mobileMaterialsLab' => array('name' => 'mobileMaterialsLab', 'avail' => 1)
        );
        
        $specialTechs = array('temperatureScan', 'barometerScan', 'XX1', 'XX2', 'XX3', 'surfaceSample');
        
        foreach($planets as $planet => &$places) {
            foreach($places as $placename => &$biomes) {
                foreach($biomes as $key => $biome) {
                    $techs = str_split($biome['techs']);
                    
                    $newtech = $tech;
                    foreach($techs as $k => $value) {
                        if ($value == 1) {
                            $newtech[$specialTechs[$k]] = array('name' => $specialTechs[$k], 'avail' => 1);
                        } else {
                            $newtech[$specialTechs[$k]] = array('name' => $specialTechs[$k], 'avail' => 0);
                        }
                    }
                    
                    $biomes[$key]['realtechs'] = $newtech;
                }
            }
        }
        
        return $planets;
    }
    
    private function getTechs()
    {
        $file = __DIR__ . '/../techs.json';
        return json_decode(file_get_contents($file), true);
    }

}

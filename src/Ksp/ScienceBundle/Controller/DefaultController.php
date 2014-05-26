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
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/show", name="default_show")
     * @Method("POST")
     * @Template()
     */
    public function showAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $parser = new Parser($this->getDoctrine()->getManager()->getRepository('KspScienceBundle:Biome'));

            $sciences = $parser->parseScienceFile($request->files->get('science'));
            //$persistent = $parser->parsePersistentFile($request->files->get('persistent'));

            return array(
                'sciences' => $sciences
            );
        }

        return $this->redirect($this->generateUrl('default_index'));

    }

}

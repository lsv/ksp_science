<?php

namespace Ksp\ScienceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->getDoctrine()->getManager()->getRepository('KspScienceBundle:Science')->parseScienceFile($request->files->get('science'));
            $this->getDoctrine()->getManager()->getRepository('KspScienceBundle:Science')->parsePersistentFile($request->files->get('persistent'));
        }

        return array();
    }
}

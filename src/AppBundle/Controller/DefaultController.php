<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    ///   php bin/console config:dump-reference doctrine

    public function indexAction(Request $request)
    {

        ob_start();
        phpinfo();
        $phpinfo = ob_get_clean();
        $results = array();

        $results["relationsEntrantes"] = array();
        $results["relationsSortantes"] = array();

        // replace this example code with whatever you need
        return $this->render('body.html.twig', array(
            "results" => $results
        ));
    }
}

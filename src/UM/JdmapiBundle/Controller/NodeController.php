<?php

namespace UM\JdmapiBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use UM\JdmapiBundle\Entity\node;
use UM\JdmapiBundle\Entity\Node_type;
use UM\JdmapiBundle\Entity\Relation;
use UM\JdmapiBundle\Entity\Relation_type;

class NodeController extends Controller
{
    protected $defaultExcludeRelin = false;
    protected $defaultExcludeRelout = false;
    protected $batchService;

//    public function __construct()
//    {
//        parent::__contruct();
//        $this->batchService =
//
//    }

    public function indexAction()
    {
    	return $this->render('node/index.html.twig');
	}
	
	public function createAction(){
		$em = $this->getDoctrine()->getManager();

        $node = new node();
        $em->persist($node);
        $node->setType(1);
        $node->setName("chien");
        $node->setWeight(50);
        $node->setFormattedName("chientformated");

		$type_node = new Type_node();
		$em->persist($type_node);
		$type_node->setName("terme");


		 $relation = new Relation();
		 $em->persist($relation);
		 $relation->setNode1(1);
		 $relation->setNode2(2);
		 $relation->setTypeRelation(1);
		 $relation->setWeight(10);

		 $type_relation = new Relation_type();
		 $em->persist($type_relation);
		 $type_relation->setName("isa");
		
        
         $em->flush();
	}

	/*
	 * Requête JDMAPI portant sur un terme
	 * */
	public function getAction(Request $request, String $urlencodedterm, String $reldir, Int $returnresults,
                              String $reltypes, String $nodetypes = "all") {

	    /*
	     *  Test de présence du mot dans la base locale
	     */
        $em = $this->getDoctrine()->getManager();
        $excludeRelin = $this->defaultExcludeRelin;
        $excludeRelout = $this->defaultExcludeRelout;

        // Exclusion des relations entrantes ou sortantes
        if ((!empty($reldir))) {

            if (in_array($reldir, array("relout", "none"))) {
                $excludeRelout = true;
            }
            if (in_array($reldir, array("relin", "none"))) {
                $excludeRelin = true;
            }
        }

        $id = $em->getRepository("JdmapiBundle:Node")->existsLocally($urlencodedterm);

        $previousState = $this->get('jdmapi.batch')->setMaxResourcesState();

        // Le terme est présent dans la base locale : requête la base locale
        if (is_numeric($id) && $id > 0) {

            echo "<p>Le terme « $urlencodedterm » est trouvé localement. Requête LOCALE.</p>";

            $results = $em->getRepository("JdmapiBundle:Node")->get($id, $excludeRelout, $excludeRelin, $reltypes, $nodetypes);
        }
        // Le terme n'est pas présent dans la base locale : requête sur le site distant
        else {

            echo "<p>Le terme « $urlencodedterm » n'est pas trouvé localement. Requête DISTANTE.</p>";

            $results = $this->getRemote($request, $urlencodedterm, false, false);
        }

        $this->get('jdmapi.batch')->resetResourcesStateToPrevious($previousState);

        // Renvoi les données récupérées pour le noeud (mode fonctionnel applicatif)
        if (1 === $returnresults) {
            return new Response($results);
        }
        // Affiche un récupitalatif (mode debug)
        else {
            return $this->render('@Jdmapi/node/get.html.twig', array("results" => $results));
        }
   }

   /*
    * Requête JDMAPI portant sur un terme à récupérer sur rezo-dump
    * en utilisant le service Batch représenté par le BatchController
    * */
    public function getRemote(Request $request, String $urlencodedterm) {

        $response = $this->forward("JdmapiBundle:Batch:insertNodesAndRels", array(
            "request" => $request,
            "type" => "all",
            "urlencodedterm" => $urlencodedterm,
            "relDir" => "both",
            "relid" => 0,
            "returnresults" => true
        ));
        return $response;
    }

}
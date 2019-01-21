<?php

namespace UM\JdmapiBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use UM\JdmapiBundle\Entity\node;
use UM\JdmapiBundle\Entity\Node_type;
use UM\JdmapiBundle\Entity\Relation;
use UM\JdmapiBundle\Entity\Relation_type;

class NodeController extends Controller
{
    protected $defaultExcludeRelin = false;
    protected $defaultExcludeRelout = false;
    protected $batchService;
    protected $buffer = "";
    protected $session;
    protected $i  ;
    protected $j  ;
    protected $id ;


    public function cmpp($a,$b) {
      return ($a["id_type_rel"] - $b["id_type_rel"]);
    }

    public function sortFinal($results) {

      $incoming_nodes = [];
      $outgoing_nodes = [];

      foreach ($results as $key => $value) {
        if ($value["id_node_rel"] == $this->id) {
          array_push($incoming_nodes,$value);
        }
        else {
          array_push($outgoing_nodes,$value);
        }
       }

        usort($incoming_nodes,array($this,"cmpp"));
        usort($outgoing_nodes,array($this,"cmpp"));

        $incoming_nodesfinal = [];
        $outgoing_nodesfinal = [];
        $this->i = -1 ;
        $this->j = -1 ;


        foreach ($outgoing_nodes as $key => $value) {


          if ($value['id_type_rel'] != $this->i)
          {

            if( $this->i == -1) {}
            else {
              array_push($outgoing_nodesfinal, ${"arrayoftype" . $this->i});
            }

            // echo "<p>Le terme « $this->i est trouvé localement. Requête LOCALE.</p>";

            $this->i = $value['id_type_rel'] ;
            ${"arrayoftype".$this->i} = [] ;
            array_push(${"arrayoftype" . $this->i}, $value);

          } else {
            array_push(${"arrayoftype".$this->i}, $value);
          }


        }


        foreach ($incoming_nodes as $key => $value) {


          if ($value['id_type_rel'] != $this->j)
          {

                      if( $this->j == -1) {}
                      else {
                        array_push($incoming_nodesfinal, ${"arrayoftype" . $this->j});

                           }

            $this->j = $value['id_type_rel'] ;
            ${"arrayoftype".$this->j} = [] ;
            array_push(${"arrayoftype" . $this->j}, $value);

          } else {

            array_push(${"arrayoftype".$this->j}, $value);
          }

        }

        $results = array ($incoming_nodesfinal,$outgoing_nodesfinal ) ;
        $results = array(
               "relationsSortantes" => $incoming_nodesfinal,
               "relationsEntrantes" => $outgoing_nodesfinal);
        return $results ;

    }

    public function indexAction() {
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
                              String $reltypes = "all", String $nodetypes = "all") {

        $this->session = $request->getSession();
	    /*
	     *  Test de présence du mot dans la base locale
	     */
        $em = $this->getDoctrine()->getManager();
        $excludeRelin = $this->defaultExcludeRelin;
        $excludeRelout = $this->defaultExcludeRelout;

        // Exclusion des relations entrantes ou sortantes
        if ((!empty($reldir))) {

            if (in_array($reldir, array("relin", "none"))) {
                $excludeRelout = true;
            }
            if (in_array($reldir, array("relout", "none"))) {
                $excludeRelin = true;
            }
        }

        // Traitement des caractères accentués

        //var_dump(utf8_encode(rawurldecode($urlencodedterm)));

        $urlencodedterm = utf8_encode(rawurldecode($urlencodedterm));
        $id = $em->getRepository("JdmapiBundle:Node")->existsLocally($urlencodedterm);

        $previousState = $this->get('jdmapi.batch')->setMaxResourcesState();

        // Le terme est présent dans la base locale en tant que terme principal : requête la base locale
        if (is_numeric($id) && $id > 0) {

            echo "<p>Le terme « $urlencodedterm » est trouvé localement. Requête LOCALE.</p>";
            $this->session->getFlashBag()->add("notice", "Le terme « $urlencodedterm » est trouvé localement. Requête LOCALE.");

            $results = $em->getRepository("JdmapiBundle:Node")->get($id, $excludeRelout, $excludeRelin, $reltypes, $nodetypes);
            $results = $this->sortFinal($results) ;
        }
        // Le terme n'est pas présent dans la base locale : requête sur le site distant
        else {

          //  echo "<p>Le terme « $urlencodedterm » n'est pas trouvé localement. Requête DISTANTE.</p>";
          $this->session->getFlashBag()->add("notice", "Le terme « $urlencodedterm » n'est pas trouvé localement. Requête DISTANTE.");

            //$results = $this->getRemote($request, $urlencodedterm);
            $this->getRemote($urlencodedterm);
        }

        $this->get('jdmapi.batch')->resetResourcesStateToPrevious($previousState);

        // Renvoi les données récupérées pour le noeud (mode fonctionnel applicatif)
        if (1 === $returnresults) {
            return new Response($results);
        }
        // Affiche un récupitalatif (mode debug)
        else {
            // return $this->render('@Jdmapi/node/get.html.twig', array("results" => $results));
            return $this->render('body.html.twig', array("results" => $results));

        }
   }

    /*
     * Requête JDMAPI portant sur un terme à récupérer sur rezo-dump
    * */
    public function getRemote(String $urlencodedterm) {

        $em = $this->getDoctrine()->getManager();
        $resultsN = $em->getRepository("JdmapiBundle:Node")->getNodesFromTypes($urlencodedterm, "*");
        $nodes_from_types = $resultsN["nodes_from_types"];
        $mainId = $resultsN["mainId"];

        // Affichage d'un message si pas de définition pour le mot
        if (isset($resultsN["definitions"]["message"])) {
            $this->session->getFlashBag()->add("info", $resultsN["definitions"]["message"]);
            $definitions = array();

        // Une ou des définitions existent pour le mot.
        // On désérialise le tableau pour le renvoyer dans les resultats
        } else {
            $definitions = $resultsN["definitions"]["definitions"];
        }

        $resultsR = $em->getRepository("JdmapiBundle:Relation")->getRelsFromTypes($urlencodedterm, "*");

        $em->getRepository("JdmapiBundle:Node")->setConnectionChannelUtf8();

        // Insertion des noeuds dans la base de donnée
        //******************************************************

        // Pour chaque type de noeuds
        foreach ($nodes_from_types as $typeId => $nodes) {

            $this->buffer .= "<hr /><p>Nodes of type : <pre>$typeId</pre></p>";

            // e;3739399;'cabriole>83824';1;0;'cabriole>équitation'
            // /e;(\d+);'(.+?)';{$typeId};(\d+);('(.+?)')?\n?/

            // Pour chaque noeud de ce type
            foreach ($nodes as $index => $nodeData) {

                // Le noeud principal est déjà enregistré en tant que tel
                // on le passe.
                if ($nodeData[1] === $mainId) {

                    $mainData = array();
                    $mainData["id"] = $mainId;
                    $mainData["name"] = $nodeData[2];
                    $mainData["type"] = $typeId;
                    $mainData["weight"] = $nodeData[3];
                    $mainData["formatted_name"] = $nodeData[5] ?? "";
                    // Enregistrement de ces données après les itérations d'insertion de ses relations ci-dessous.
                    continue;
                }
                $returned = $em->getRepository("JdmapiBundle:Node")->insert($typeId, $nodeData);
            }
        }
        // Enregistrement du noeud principal en tant que tel
        $em->getRepository("JdmapiBundle:Node")->insertMain($mainData);



        // Insertion des relations entrantes pour ce noeud
        // ====================================================

        // For each relation type array entry
        foreach ($resultsR["incoming_rels_from_types"] as $type_id => $relations) {

            $this->buffer .="<hr /><p>Incoming relations of type : <pre>$type_id</pre></p>";

            foreach ($relations as $index => $relationData) {

                $id_relation = $relationData[1];
                $id_node1 = $relationData[2];
                $weight = $relationData[3] ?? null;

                $this->buffer .="<p>Relation ID = $id_relation<br />";
                $this->buffer .="Relation \$id_node1 = $id_node1<br />";
                $this->buffer .="Relation \$weight = $weight</p>";

                $relDataParam = array();
                $relDataParam["id"] = $id_relation;
                $relDataParam["id_node1"] = $id_node1;
                $relDataParam["id_node2"] = $mainId;
                $relDataParam["type_id"] = $type_id;
                $relDataParam["weight"] = $weight;

                $em->getRepository("JdmapiBundle:Relation")->insert($relDataParam);
            }
        }


        // Insertion des relations sortantes pour ce noeud
        // ====================================================

        // For each relation type array entry
        foreach ($resultsR["outgoing_rels_from_types"] as $type_id => $relations) {

            $this->buffer .="<hr /><p>Outgoing relations of type : <pre>$type_id</pre></p>";

            foreach ($relations as $index => $relationData) {

                // les relations entrantes : r;rid;node1;node2;type;w
                // r;9348721;44320;145246;0;-20

                $id_relation = $relationData[1];
                $id_node2 = $relationData[2];
                $weight = $relationData[3] ?? null;

                $this->buffer .="<p>Relation ID = $id_relation<br />";
                $this->buffer .="Relation \$id_node2 = $id_node2<br />";
                $this->buffer .="Relation \$weight = $weight</p>";

                $relDataParam = array();
                $relDataParam["id"] = $id_relation;
                $relDataParam["id_node1"] = $mainId;
                $relDataParam["id_node2"] = $id_node2;
                $relDataParam["type_id"] = $type_id;
                $relDataParam["weight"] = $weight;

                $em->getRepository("JdmapiBundle:Relation")->insert($relDataParam);
            }
        }
        // return array(
        //   //  "nodes" => $nodes_from_types,
        //     "relations" => array("incoming" => $resultsR["incoming_rels_from_types"],
        //                          "outgoing" => $resultsR["outgoing_rels_from_types"]  ));
          //  "mainId" => $mainId);
    }

}

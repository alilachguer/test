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
    protected $SortWeight = -1;

    
    public function hyphenize($string) {
      $dict = array(
          "I'm"      => "I am",
          "thier"    => "their",
          // Add your own replacements here
      );
      return strtolower(
          preg_replace(
            array( '#[\\s-]+#', '#[^A-Za-z0-9\. -]+#' ),
            array('-', ''),
            // the full cleanString() can be downloaded from http://www.unexpectedit.com/php/php-clean-string-of-utf8-chars-convert-to-similar-ascii-char
            $this->cleanString($string)
          )
      );
  }
  
  public function cleanString($text) {
      $utf8 = array(
          '/[áàâãªä]/u'   =>   'a',
          '/[ÁÀÂÃÄ]/u'    =>   'A',
          '/[ÍÌÎÏ]/u'     =>   'I',
          '/[íìîï]/u'     =>   'i',
          '/[éèêë]/u'     =>   'e',
          '/[ÉÈÊË]/u'     =>   'E',
          '/[óòôõºö]/u'   =>   'o',
          '/[ÓÒÔÕÖ]/u'    =>   'O',
          '/[úùûü]/u'     =>   'u',
          '/[ÚÙÛÜ]/u'     =>   'U',
          '/ç/'           =>   'c',
          '/Ç/'           =>   'C',
          '/ñ/'           =>   'n',
          '/Ñ/'           =>   'N',
          '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
          '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
          '/[“”«»„]/u'    =>   ' ', // Double quote
          '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
      );
      return preg_replace(array_keys($utf8), array_values($utf8), $text);
  }

  function compareByName($a, $b) {
    return strcmp($a["rel_node_name"], $b["rel_node_name"]);
  }

  public function SortAlpha ($array) {

    $arr = $array ;

      for  ($j=0 ; $j<sizeof($arr['relationsEntrantes']);$j++ ){
        usort($arr['relationsEntrantes'][$j],array($this,"compareByName"));
      }

      for  ($j=0 ; $j<sizeof($arr['relationsSortantes']);$j++ ) {
        usort($arr['relationsSortantes'][$j],array($this,"compareByName"));
      }

    return $arr ;
    }

    public function cmpp($a,$b) {
      return ($a["id_type_rel"] - $b["id_type_rel"]);
    }

    public function cmppweightAsc($a,$b) {
      return ($a["rel_node_weight"] - $b["rel_node_weight"]);
    }

    public function cmppweightDesc($a,$b) {
      return ($b["rel_node_weight"] - $a["rel_node_weight"]);
    }

    public function sortweight($array) {
      $arr = $array ;

      for  ($j=0 ; $j<sizeof($arr['relationsEntrantes']);$j++ )
      {

        if($this->SortWeight == 1 )
        {
          usort($arr['relationsEntrantes'][$j],array($this,"cmppweightAsc"));

        }
        else {
          usort($arr['relationsEntrantes'][$j],array($this,"cmppweightDesc"));

        }

      }

      for  ($j=0 ; $j<sizeof($arr['relationsSortantes']);$j++ )
      {
        if($this->SortWeight == 1 )
        {
          usort($arr['relationsSortantes'][$j],array($this,"cmppweightAsc"));

        }
        else {
          usort($arr['relationsSortantes'][$j],array($this,"cmppweightDesc"));

        }

      }

    return $arr ;
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

        if( $this->i != -1) {
            array_push($outgoing_nodesfinal, ${"arrayoftype" . $this->i});
         }


        foreach ($incoming_nodes as $key => $value) {

          if ($value['id_type_rel'] != $this->j)
          {
            if( $this->j !== -1) {
            array_push($incoming_nodesfinal, ${"arrayoftype" . $this->j});
            }

            $this->j = $value['id_type_rel'] ;
            ${"arrayoftype".$this->j} = [] ;
            array_push(${"arrayoftype" . $this->j}, $value);

          } else {

            array_push(${"arrayoftype".$this->j}, $value);
          }

        }

        if( $this->j != -1)  {
           array_push($incoming_nodesfinal, ${"arrayoftype" . $this->j});
        }


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

    public function rootAction(Request $request) {
        return $this->render('root.html.twig');
    }


	/*
	 * Requête JDMAPI portant sur un terme
	 * */

	public function getAction(Request $request) {
       $out = 0;
       $in = 0;

       $rel = $request->query->get('rel');

       if($rel != null) {

           if (in_array("0", $rel)) {
            $out = 1;
          }

          if (in_array("1", $rel)) {
            $in = 1;
          }
        }

        if( $request->query->get('SortWeight') != null) {
            $this->SortWeight =  $request->query->get('SortWeight') ;
        }

       $rel_type_out_list = $request->query->get('type_rel_out');
       $rel_type_in_list = $request->query->get('type_rel_in');

       if ( $rel_type_in_list != null ) {

         $rel_type_in_list = array_map('intval', $rel_type_in_list);
       }

       if( $rel_type_out_list != null  ) {

         $rel_type_out_list = array_map('intval', $rel_type_out_list);
       }

       $reltypes = "all";
       $nodetypes = "all" ;
       $returnresults = 0;
       $urlencodedterm = $request->query->get('urlencodedterm');

       if ( ($out == 1 && $in == 1) || ($out == 0 && $in == 0)) {
         $reldir = "both";
       }

       else if ( $out == 1 && $in == 0) {
         $reldir = "relout";
       }

       else {
         $reldir = "relin";
       }

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
        $this->id = $em->getRepository("JdmapiBundle:Node")->existsLocally($urlencodedterm);

        $previousState = $this->get('jdmapi.batch')->setMaxResourcesState();

        // Le terme est présent dans la base locale en tant que terme principal : requête la base locale

        //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        // SUPPRIMER false APRES DEBUG
        //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

        if (is_numeric($this->id) && $this->id > 0 && false) {

            $this->session->getFlashBag()->add("notice", "Le terme « $urlencodedterm » est trouvé localement. Requête LOCALE.");

            $results = $em->getRepository("JdmapiBundle:Node")->get($this->id, $excludeRelout, $excludeRelin, $reltypes, $nodetypes);
            $results = $this->sortFinal($results) ;
        }
        // Le terme n'est pas présent dans la base locale : requête sur le site distant
        else {

              //  echo "<p>Le terme « $urlencodedterm » n'est pas trouvé localement. Requête DISTANTE.</p>";
              $this->session->getFlashBag()->add("notice", "Le terme « $urlencodedterm » n'est pas trouvé localement. Requête DISTANTE.");

              //$results = $this->getRemote($request, $urlencodedterm);
              $this->getRemote($urlencodedterm);
              $this->id = $em->getRepository("JdmapiBundle:Node")->existsLocally($urlencodedterm);

               if (is_numeric($this->id) && $this->id > 0) {

                   // echo "<p>Le terme « $urlencodedterm » est trouvé localement. Requête LOCALE.</p>";

                   $results = $em->getRepository("JdmapiBundle:Node")->get($this->id, $excludeRelout, $excludeRelin, $reltypes, $nodetypes);

//                   echo "<pre>";
//                   echo "<p>Dans getAction() cas requête distante, requête locale après insertion</p>";
//                   print_r($results);
//                   echo "</pre>";
//                   exit();

                   $results = $this->sortFinal($results) ;

                   // $results = array(
                   //     "relationsEntrantes" => $incoming_nodes,
                   //     "relationsSortantes" => $outgoing_nodes);

               }

        }

        $this->get('jdmapi.batch')->resetResourcesStateToPrevious($previousState);

        // Renvoi les données récupérées pour le noeud (mode fonctionnel applicatif)
        if (1 === $returnresults) {
            return new Response($results);
        }
        // Affiche un récupitalatif (mode debug)
        else {
            // return $this->render('@Jdmapi/node/get.html.twig', array("results" => $results));

            // dump($results['relationsSortantes'][]);
            // exit();
            if($results['relationsSortantes'] != null)
            {
              $main_Name = $results['relationsSortantes'][0][0]['main_node_name'];
              $definition = $results['relationsSortantes'][0][0]['main_node_serialized_definition_array'];

            } else {
              $main_Name = $results['relationsEntrantes'][0][0]['main_node_name'];
              $definition = $results['relationsEntrantes'][0][0]['main_node_serialized_definition_array'];
            }

            if($this->SortWeight == 1 || $this->SortWeight == 0 ) {
              $results = $this->sortweight($results);

            }
            else if ($this->SortWeight == 2) {
              $results = $this->SortAlpha($results);
            }

//              echo "<pre>";
//              echo "<p>Dans getAction()</p>";
//              print_r($results);
//              echo "</pre>";
//              exit();

            return $this->render('body.html.twig', array("results" => $results,
                                                              "name" => $main_Name,
                                                              "rel_type_in_list" => $rel_type_in_list ,
                                                              "rel_type_out_list" => $rel_type_out_list,
                                                              "definition" => $definition));
        }
   }

    /*
     * Requête JDMAPI portant sur un terme à récupérer sur rezo-dump
    * */
    public function getRemote(String $urlencodedterm) {

        $em = $this->getDoctrine()->getManager();
        $resultsN = $em->getRepository("JdmapiBundle:Node")->getNodesFromTypes($urlencodedterm, "");

//        echo "<pre>";
//        echo "<p>Dans getRemote()</p>";
//        print_r($resultsN);
//        echo "</pre>";
//        exit();

        $nodes_from_types = $resultsN["nodes_from_types"];
        $mainId = $resultsN["mainId"];
        $definitions="";

        // Affichage d'un message si pas de définition pour le mot
        if (isset($resultsN["definitions"]["message"])) {
            $definitions = "Ce mot n'a pas de définition.";
        } else {

          for  ($j=0 ; $j<sizeof($resultsN['definitions']['definitions']);$j++ )
                $definitions = $definitions.$resultsN["definitions"]['definitions'][$j];
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

                $nodeData[2] = utf8_encode($nodeData[2]);
                //$nodeData[2] = $this->hyphenize($nodeData[2]);
                
                if (strpos( $nodeData[2], '\\' ) !== false ||
                    strpos( $nodeData[2], '?' ) !== false ||
                    strpos( $nodeData[2], '/' ) !== false ||
                    strpos( $nodeData[2], "'" ) !== false ||
                    strpos( $nodeData[2], '0' ) !== false  ) {
                  continue ; 
                }

                // Le noeud principal est déjà enregistré en tant que tel
                // on le passe.
                if ($nodeData[1] === $mainId) {
                    $mainData = array();
                    $mainData["id"] = $mainId;
                    $mainData["name"] = $nodeData[2];
                    $mainData["type"] = $typeId;
                    $mainData["weight"] = $nodeData[3];
                    $mainData["formatted_name"] = $nodeData[5] ?? "";
                    //$mainData["definitions"]  = isset($resultsN["definitions"]["definitions"]) ? serialize($resultsN["definitions"]["definitions"]) : "";
                    $mainData["definitions"] = $definitions;
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
        //  "mainId" => $mainId,
        //            "definitions" => $definitions);
    }

}

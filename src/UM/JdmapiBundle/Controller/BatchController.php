<?php
namespace UM\JdmapiBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UM\JdmapiBundle\Entity\Container;
use UM\JdmapiBundle\Entity\Node;

/*
 * @todo :
 * - Articulation des 2 actions insertNodes et insertRelations selon les paramètres utilisés.
 * - Formulaire uilisateur pour spécifier les critères (et/ou scripting alimenté par liste de mots fournie par
 *   le site et exécuté via CRON).
 */
class BatchController extends Controller
{
    // Pile de messages à passer au template pour affichage
    protected $buffer = "";
    protected $termListFilePath = "../src/UM/JdmapiBundle/Resources/data";

    public function indexAction()
    {
        return $this->render('@Jdmapi/batch/index.html.twig');
    }

    public function setMaxResourcesState() {

        // Relèvement temporaire des limites de mémoire et de temps d'exécution
        // pour le processus courant. Les valeurs initiales sont recueillies
        // pour être rétablies après l'opération.
        $max_execution_time = ini_get('max_execution_time');
        $memory_limit = ini_get('memory_limit');
        ini_set('max_execution_time', 60*15);
        ini_set('memory_limit', "1000M");
        return array("max_execution_time" => $max_execution_time, "memory_limit" => $memory_limit);
    }

    public function resetResourcesStateToPrevious(array $previousState) {

        // Rétabli les valeurs préexistantes des directives
        ini_set('max_execution_time', $previousState["max_execution_time"]);
        ini_set('memory_limit', $previousState["memory_limit"]);
    }

    public function insertFromTermListAction(Request $request, String $type, String $relDir) {

        if (is_dir($this->termListFilePath) && is_readable($this->termListFilePath)) {
            $d = dir($this->termListFilePath);

            $previousState = $this->setMaxResourcesState();

            while (false !== ($entry = $d->read())) {

                if (preg_match("/ENTRIES[-\w]*\.txt$/", $entry)) {

                    $this->buffer .= $entry."\n";
                    $matches = [];

                    $fp = @fopen($this->termListFilePath ."/". $entry, "r");

                    if ($fp) {

                        while (($line = fgets($fp, 4096)) !== false) {

                            $line = mb_convert_encoding($line, "UTF-8", "ISO-8859-1");
                            // On récupère les termes listés dans le fichier (id;terme;)
                            $terms_pattern = "/\d+;([^;]+);\s*\n?/";
                            $matched = preg_match($terms_pattern, $line, $matches);

                            if ($matched) {
                                /*echo "<pre>";
                                print_r($matches);
                                echo "</pre>";*/

                                // On les range dans un tableau
                                $words[] = $matches[1];
                                //$this->buffer .= "<p>\$matches[0] = $matches[0]</p>";
                            }
                        }
                        if (!feof($fp)) {
                            $this->buffer .= "Erreur: fgets() a échoué\n";
                        }
                        fclose($fp);
                    }

                    $nbrWords = count($words);
                    // Exécution des insertions pour les mots récupérés
                    for ($i = 0; $i < $nbrWords; $i++) {
                        $word = $words[$i];
                        echo "<p>\$word = ". urlencode($word) ."</p>";

                        try {
                            $this->insertNodesAndRelsAction($request, $type, urlencode($word), $relDir, 0);
                        }
                        catch (\PDOException $e) {
                            $this->buffer .= 'Some insertions were skipped: ' . $e->getMessage();
                        }
                    }

                }
            }
            // Rétabli les valeurs préexistantes des directives
            $this->resetResourcesStateToPrevious($previousState);

        }
        return $this->render('@Jdmapi/batch/insertfromtermslist.html.twig', array("buffer" => $this->buffer));
    }

    /*
     * Requête rezo-dump avec un terme et un paramètrage optionnel des relations
     * liées à celui-ci et lance l'insertion et la mise à jour dans la base de donnée (selon paramètre $type) :
     * - des termes résultant
     * - des relations résultantes entrantes et ou sortantes selon le paramètre $relDir
     *  et la valeur du paramètre $relid.
    */
    public function insertNodesAndRelsAction(Request $request, String $type, String $urlencodedterm, String $relDir = "*")
    {
        $previousState = $this->setMaxResourcesState();

        try {
            if ('rel' !==  $type) {
                $this->buffer .= "<p>Inserting Nodes</p>";
                echo "<p>Inserting Nodes</p>";
                $this->insertNodesAction($request, $urlencodedterm, $relDir);
            }
            if ('node' !==  $type) {
                $this->buffer .= "<p>Inserting Relation(s)</p>";
                echo "<p>Inserting Relation(s)</p>";
                $this->insertRelsAction($request, $urlencodedterm, $relDir);
            }

        } catch (\PDOException $e) {
            $this->buffer .= 'Some insertions were skipped: ' . $e->getMessage();
        }

        // Rétabli les valeurs préexistantes des directives
        $this->resetResourcesStateToPrevious($previousState);
        // Affichage d'un récapitulatif
        return $this->render('@Jdmapi/batch/insertnodesandrels.html.twig', array("buffer" => $this->buffer));
    }

    /*
     * Requête rezo-dump avec un terme et un paramètrage optionnel des relations
     * liées à celui-ci. Insère et mets à jour les termes résultant dans la base de donnée.
     * Si $returnresults = true, renvoi les nodes classés par type dans un tableau.
     */
    public function insertNodesAction(Request $request, String $urlencodedterm, String $relDir = "*")
    {
        $this->buffer .= "<p>Begin source parsing for nodes</p>";
        echo "<p>Begin source parsing for nodes</p>";

        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository("JdmapiBundle:Node")->getNodesFromTypes($urlencodedterm, $relDir);
        $nodes_from_types = $results["nodes_from_types"];
        $mainId = $results["mainId"];

        if (isset($results["definitions"]["message"])) {
            $request->getSession()->getFlashBag()->add("info", $results["definitions"]["message"]);
        }

        $em->getRepository("JdmapiBundle:Node")->setConnectionChannelUtf8();

        // Pour chaque type de noeuds
        foreach ($nodes_from_types as $typeId => $nodes) {

            $this->buffer .= "<hr /><p>Nodes of type : <pre>$typeId</pre></p>";

            // e;3739399;'cabriole>83824';1;0;'cabriole>équitation'
            // /e;(\d+);'(.+?)';{$typeId};(\d+);('(.+?)')?\n?/

            // Pour chaque noeud de ce type
            foreach ($nodes as $index => $nodeData) {

                echo "<p>\$nodeData[1] = $nodeData[1]</p>";
                // Le noeud principal est déjà enregistré en tant que tel
                // on le passe.
                if ($nodeData[1] === $mainId) {

                    $mainData = array();
                    $mainData["id"] = $mainId;
                    $mainData["name"] = $nodeData[2];
                    $mainData["type"] = $typeId;
                    $mainData["weight"] = $nodeData[3];
                    $mainData["formatted_name"] = $nodeData[5] ?? "";
                    $mainData["definitions"] = isset($results["definitions"]["definitions"]) ?
                                               serialize($results["definitions"]["definitions"]) : "";
                    // Enregistrement de ces données après les itérations d'insertion de ses relations ci-dessous.
                    continue;
                }
                $returned = $em->getRepository("JdmapiBundle:Node")->insert($typeId, $nodeData);
            }
        }
        // Enregistrement du noeud principal en tant que tel
        $em->getRepository("JdmapiBundle:Node")->insertMain($mainData);

        // Affiche un récupitalatif (mode batch d'insertion seul)
        return $this->render('@Jdmapi/batch/insertnodes.html.twig', array("buffer" => $this->buffer));
     }


    /*
     * Requête rezo-dump avec un terme et un paramètrage optionnel des relations liées à celui-ci.
     * Insère et mets à jour les relations résultantes dans la base de donnée
     * optionnellement filtrées selon le paramètre $relDir et la valeur du paramètre $relid.
     * Si $returnresults = true, renvoi les relations classés par type dans un tableau.
     */
    public function insertRelsAction(Request $request, String $urlencodedterm, String $relDir = "*", Int $relid = 0,
                                     Bool $returnresults = false)
    {
        $this->buffer = "<p>Begin source parsing</p>";

        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository("JdmapiBundle:Relation")->getRelsFromType($urlencodedterm, $relDir);
        $incoming_rels_from_types = $results["incoming_rels_from_types"];
        $outgoing_rels_from_types = $results["outgoing_rels_from_types"];
        $mainId = $results["mainId"];

        $em->getRepository("JdmapiBundle:Node")->setConnectionChannelUtf8();

        // Insertion des relations entrantes pour ce noeud
        // ====================================================

        if (is_array($incoming_rels_from_types) && !empty($incoming_rels_from_types)) {

            // For each relation type array entry
            foreach ($incoming_rels_from_types as $type_id => $relations) {

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
        }


        // Insertion des relations sortantes pour ce noeud
        // ====================================================

        if (is_array($outgoing_rels_from_types) && !empty($outgoing_rels_from_types)) {

            // For each relation type array entry
            foreach ($outgoing_rels_from_types as $type_id => $relations) {

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
        }

        // Affiche un récupitalatif (mode batch d'insertion seul)
        return $this->render('@Jdmapi/batch/insertrels.html.twig', array("buffer" => $this->buffer));
   }

   public function __invoke($call)
   {
       return $this;
   }

}

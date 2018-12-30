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
    public function insertNodesAndRelsAction(Request $request, String $type, String $urlencodedterm, String $relDir = "*",
                                             Int $relid = 0, Bool $returnresults = false)
    {
        $previousState = $this->setMaxResourcesState();

        try {
            if ('rel' !==  $type) {
                $this->buffer .= "<p>Inserting Nodes</p>";
                echo "<p>Inserting Nodes</p>";
                $nodes = $this->insertNodesAction($request, $urlencodedterm, $relDir, $relid, $returnresults);
            }
            if ('node' !==  $type) {
                $this->buffer .= "<p>Inserting Relation(s)</p>";
                echo "<p>Inserting Relation(s)</p>";
                $rels = $this->insertRelsAction($request, $urlencodedterm, $relDir, $relid, $returnresults);
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
    public function insertNodesAction(Request $request, String $urlencodedterm, String $relDir = "*", Int $relid = 0,
                                      Bool $returnresults = false)
    {
        $this->buffer .= "<p>Begin source parsing for nodes</p>";
        echo "<p>Begin source parsing for nodes</p>";

        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository("JdmapiBundle:Node")->getNodesFromTypes($urlencodedterm, $relDir);
        $nodes_from_types = $results["nodes_from_types"];
        $mainId = $results["mainId"];

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

        $url = "http://www.jeuxdemots.org/rezo-dump.php?gotermsubmit=Chercher&gotermrel={$urlencodedterm}";

        // Ciblage explicite d'une relation par son ID
        if (isset($relid) && $relid > 0) {
            $url .= "&rel={$relid}";
        }
        else {
            // Exclusion des relations entrantes
            if (in_array($relDir, array("relout", "none"))) {
                $url .= "&relin=norelin";
            }
            // Exclusion des relations sortantes
            if (in_array($relDir, array("relin", "none"))) {
                $url .= "&relout=norelout";
            }
        }

        /*echo "<pre>";
        print_r($url);
        echo "</pre>";
        exit();*/


        // réglage de timeout pour file_get_contents avec
        // backup et restauration de la valeur existante
        // après l'opération
        $default_socket_timeout = ini_get('default_socket_timeout');
        ini_set('default_socket_timeout', 60*3);
        $src = file_get_contents($url);
        ini_set('default_socket_timeout', $default_socket_timeout);
        // Conversion de l'encodage de la page source en UTF-8
        $src = mb_convert_encoding($src, "UTF-8", "ISO-8859-1");

/*        echo "<pre>";
        print_r($src);
        echo "</pre>";
        exit();*/

        try {

            // Get node EID
            $node_id_pattern = "/\(eid=(\d+)\)/";
            $matches = array();

            $matched = preg_match($node_id_pattern, $src,$matches);

            if ($matched) {
                $query_node_id = $matches[1];
                $matches = array();
            } else {
                throw new \Exception("Le Node ID du mot n'a pas été trouvé dans le code source.");
            }
        }
        catch (\Exception $e) {
            $this->buffer .= $e->getMessage();
            return 0;
        }

        $rels_types =  array(0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 30, 32, 35, 36, 41, 42, 45, 46, 51, 52, 53, 58, 59, 60, 64, 66, 67, 69, 72, 73, 74, 102, 106, 107, 109, 115, 126, 128, 151, 155, 333, 444, 555, 666, 777, 999, 1002, 2000);
        $incoming_rels_from_types = array();
        $outgoing_rels_from_types = array();

        // Pour chaque type de relation
        foreach ($rels_types as $type_id) {

            //$this->buffer .="\$type_id = $type_id<br />";

            $incoming_rels_from_type_pattern = "/r;(\d+);(\d+);{$query_node_id};{$type_id};(-?\d+)\n?/";
            $outgoing_rels_from_type_pattern = "/r;(\d+);{$query_node_id};(\d+);{$type_id};(-?\d+)\n?/";

            // Récupération des relations entrantes de ce type pour ce noeud

            $matched = preg_match_all($incoming_rels_from_type_pattern, $src, $matches, PREG_SET_ORDER);

            if ($matched) {
                $incoming_rels_from_types[$type_id] = $matches;
            }

            // Récupération des relations sortantes de ce type pour ce noeud
            $matched = preg_match_all($outgoing_rels_from_type_pattern, $src, $matches, PREG_SET_ORDER);

            if ($matched) {
                $outgoing_rels_from_types[$type_id] = $matches;
            }

        }

        try {

            if (($em = $this->get('doctrine')->getManager()) != null) {

                $this->buffer .= 'Connected to the MySQL database successfully!';

                $sqlInit = "SET NAMES 'utf8';";
                $em->getConnection()->executeQuery($sqlInit);

                //echo 'Connected to the SQLite database successfully!';
                $this->buffer .='Connected to the MySQL database successfully!';

                // SQLite Upsert
                $sql = "INSERT OR REPLACE INTO relation (id, id_node, id_node2, id_type, weight) 
						VALUES (?, ?, ?, ?, ?)
                        ON CONFLICT(id) DO UPDATE 
                        SET id_node = excluded.id_node,
                        id_node2 = excluded.id_node2,
                        id_type = excluded.id_type,
                        weight = excluded.weight;";

                // MySQL Upsert
                $sql = "INSERT INTO relation (id, id_node, id_node2, id_type, weight) 
						VALUES (?, ?, ?, ?, ?)
                        ON DUPLICATE KEY UPDATE 
                        id_node = VALUES(id_node),
                        id_node2 = VALUES(id_node2),
                        id_type = VALUES(id_type),
                        weight = VALUES(weight);";

                $insertStmt = $em->getConnection()->prepare($sql);

                // Insertion des relations entrantes pour ce noeud
                // ====================================================

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

                        $insertStmt->bindValue(1, /*id*/ $id_relation);
                        $insertStmt->bindValue(2, /*id_node1*/ $id_node1);
                        $insertStmt->bindValue(3, /*id_node2*/ $query_node_id);
                        $insertStmt->bindValue(4, /*type_id*/ $type_id);
                        $insertStmt->bindValue(5, /*weight*/ $weight);

                        $insertStmt->execute();
                    }
                }


                // Insertion des relations sortantes pour ce noeud
                // ====================================================

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

                        $insertStmt->bindValue(1, /*id*/ $id_relation);
                        $insertStmt->bindValue(2, /*id_node1*/ $query_node_id);
                        $insertStmt->bindValue(3, /*id_node2*/ $id_node2);
                        $insertStmt->bindValue(4, /*type_id*/ $type_id);
                        $insertStmt->bindValue(5, /*weight*/ $weight);

                        $insertStmt->execute();
                    }
                }

            }
            else {
                $this->buffer .='Whoops, could not connect to the MySQL database!';
            }

        } catch (\PDOException $e) {
            $this->buffer .='Some insertions were skipped: ' . $e->getMessage();
        }

        // Renvoi dans un tableau les relations entrantes et sortantes classées par type (mode fonctionnel applicatif)
        if (true === $returnresults) {
            return array("incoming" => $incoming_rels_from_types, "outgoing" => $outgoing_rels_from_types);
        }
        // Affiche un récupitalatif (mode batch d'insertion seul)
        else {
            return $this->render('@Jdmapi/batch/insertrels.html.twig', array("buffer" => $this->buffer));
        }
   }

   public function __invoke($call)
   {
       return $this;
   }

}
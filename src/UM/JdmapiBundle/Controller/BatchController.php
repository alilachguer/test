<?php
namespace UM\JdmapiBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/*
 * @todo :
 * - Test existence d'une entrée et remplacement de celle-ci si elle existe déjà.
 * - Mise en commun de la partie requête pour les deux processus d'insertion.
 * - Formulaire uilisateur pour spécifier les critères (et/ou scripting alimenté par liste de mots fournie par
 *   le site et exécuté via CRON).
 */


class BatchController extends Controller
{
    // Pile de messages à passer au template pour affichage
    protected $buffer = "";

    public function indexAction()
    {
        return $this->render('@Jdmapi/batch/index.html.twig');
    }

    /*
     * Requête rezo-dump avec un terme et un paramètrage optionnel des relations
     * liées à celui-ci et insère les termes résultant dans la base de donnée.
     */
    public function insertNodesAction(Request $request, Int $relid = 0)
    {
        $this->buffer .= "<p>Begin source parsing</p>";

        $term = "cheval";
        $url = "http://www.jeuxdemots.org/rezo-dump.php?gotermsubmit=Chercher&gotermrel={$term}";
        $relType = $request->query->get("rel");

        // Ciblage explicite d'une relation par son ID
        if (isset($relid) && $relid > 0) {
            $url .= "&rel={$relid}";
        }
        else {
            // Exclusion des relations entrantes
            if (in_array($relType, array("relout", "none"))) {
                $url .= "&relin=norelin";
            }
            // Exclusion des relations sortantes
            if (in_array($relType, array("relin", "none"))) {
                $url .= "&relout=norelout";
            }
        }

        $src = file_get_contents($url);

        //$src = file_get_contents("rezo-dump_source_cheval.html");

        // Pattern collection by node type
        // generic node pattern : (^e;\d+;'.+';\d+;\d+(;'.+')?\n)+
        // Node types :
        // nt;0;'n_generic'
        // nt;1;'n_term'
        // nt;2;'n_form'
        // nt;4;'n_pos'
        // nt;6;'n_flpot'
        // nt;8;'n_chunk'
        // nt;9;'n_question'
        // nt;10;'n_relation'
        // nt;12;'n_analogy'
        // nt;18;'n_data'
        // nt;36;'n_data_pot'
        // nt;444;'n_link'
        // nt;666;'n_AKI'
        // nt;777;'n_wikipedia'
        // nt;1002;'n_group'

        $node_types =  array_merge(range(0,12), array(18, 36, 444, 666, 777, 1002));
        $nodes_from_types = array();

        foreach ($node_types as $typeId) {

            $nodes_from_type_pattern = "/e;(\d+);'(.+?)';{$typeId};(\d+)(;'(.+?)')?\n?/";
            $matched = preg_match_all($nodes_from_type_pattern, $src, $matches, PREG_SET_ORDER);
            $nodes_from_types[$typeId] = $matches;

            /*    $this->buffer .= "<pre>";
                print_r($matches);
                $this->buffer .= "</pre>";*/
        }

        /*$this->buffer .= "<pre>";
        print_r($nodes_from_types);
        $this->buffer .= "</pre>";*/

        try {
            // SQLITE3
            //$conn = new SQLiteConnection();

//            $conn = new MySQLConnection();
//            $pdo = $conn->connect();

            if (($em = $this->get('doctrine')->getManager()) != null) {

                //$this->buffer .='Connected to the SQLite database successfully!';
                $this->buffer .='Connected to the MySQL database successfully!';

                $sqlInit = "SET NAMES 'utf8';";
                $em->getConnection()->executeQuery($sqlInit);

                // SQLite Upsert
                $sql = "INSERT OR REPLACE INTO node (id, name, id_type, weight, formatted_name) 
						VALUES (?, ?, ?, ?, ?)
                        ON CONFLICT(id) DO UPDATE 
                        SET name = excluded.name,
                        id_type = excluded.id_type,
                        weight = excluded.weight,
                        formatted_name = excluded.formatted_name;";

                // MySQL Upsert
                $sql  =  "INSERT INTO node (id, name, id_type, weight, formatted_name) 
						VALUES (?, ?, ?, ?, ?)
                        ON DUPLICATE KEY UPDATE 
                        name = VALUES(name),
                        id_type = VALUES(id_type),
                        weight = VALUES(weight),
                        formatted_name = VALUES(formatted_name);";

                $insertStmt = $em->getConnection()->prepare($sql);

                // For each node type nodes array
                foreach ($nodes_from_types as $typeId => $nodes) {

                    $this->buffer .= "<hr /><p>Nodes of type : <pre>$typeId</pre></p>";

                    // e;3739399;'cabriole>83824';1;0;'cabriole>équitation'
                    // /e;(\d+);'(.+?)';{$typeId};(\d+);('(.+?)')?\n?/

                    foreach ($nodes as $index => $nodeData) {

                        $name = $nodeData[2] ?? null;
                        $weight = $nodeData[3] ?? null;
                        $formattedName = $nodeData[5] ?? null;

                        $this->buffer .= "<p>Node ID = {$nodeData[1]}<br />";
                        $this->buffer .= "Node \$name = $name<br />";
                        $this->buffer .= "Node \$weight = $weight<br />";
                        $this->buffer .= "Node \$formattedName = $formattedName</p>";

                        $insertStmt->bindValue(1, /*id*/ $nodeData[1]);
                        $insertStmt->bindValue(2, /*name*/ $name);
                        $insertStmt->bindValue(3, /*type*/ $typeId);
                        $insertStmt->bindValue(4, /*weight*/ $weight);
                        $insertStmt->bindValue(5, /*formatted_name*/ $formattedName);

                        $insertStmt->execute();
                    }
                }

            }
            else {
                //$this->buffer .= 'Whoops, could not connect to the SQLite database!';
                $this->buffer .= 'Whoops, could not connect to the MySQL database!';
            }

        } catch (\PDOException $e) {
            $this->buffer .= 'Connection failed: ' . $e->getMessage();
        }

        return $this->render('batch/insertnodes.html.twig');
    }

    public function insertRelsAction(Int $relid, String $type)
    {
        return $this->render('batch/insertrels.html.twig', array("buffer" => $this->buffer));
    }

}
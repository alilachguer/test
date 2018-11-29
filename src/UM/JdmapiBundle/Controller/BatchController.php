<?php
namespace UM\JdmapiBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    public function indexAction()
    {
        return $this->render('@Jdmapi/batch/index.html.twig');
    }

    /*
     * Requête rezo-dump avec un terme et un paramètrage optionnel des relations
     * liées à celui-ci et lance l'insertion et la mise à jour dans la base de donnée :
     * - les termes résultant
     * - des relations résulatantes entrantes et ou sortantes selon le paramètre
     *   de requête rel et la valeur du paramètre $relid.
    */
    public function insertNodesAndRelsAction(Request $request, Int $relid = 0)
    {
        $this->insertNodesAction($request, $relid);
        $this->insertRelsAction($request, $relid);
    }

    /*
     * Requête rezo-dump avec un terme et un paramètrage optionnel des relations
     * liées à celui-ci et insère et mets à jour les termes résultant dans la base de donnée.
     */
    public function insertNodesAction(Request $request, Int $relid = 0)
    {
        $this->buffer .= "<p>Begin source parsing for nodes</p>";

        $term = "cheval";
        $url = "http://www.jeuxdemots.org/rezo-dump.php?gotermsubmit=Chercher&gotermrel={$term}&rel=";
        $relType = $request->query->get("rel");
        //$relType = "none";

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

        // réglage de timeout pour file_get_contents avec
        // backup et restauration de la valeur existante
        // après l'opération
        $default_socket_timeout = ini_get('default_socket_timeout');
        ini_set('default_socket_timeout', 60*3);
        $src = file_get_contents($url);
        ini_set('default_socket_timeout', $default_socket_timeout);
        // Conversion de l'encodage de la page source en UTF-8
        $src = mb_convert_encoding($src, "UTF-8", "ISO-8859-1");

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

        // IDs des types de noeuds connus
        $node_types =  array_merge(range(0,12), array(18, 36, 444, 666, 777, 1002));
        $nodes_from_types = array();

        // Pour chaque type de noeud
        foreach ($node_types as $typeId) {

            // On génère un pattern
            // $nodes_from_type_pattern = "/e;(\d+);'(.+?)';{$typeId};(\d+)(;'(.+?)')?\n?/";
            $nodes_from_type_pattern = "/e;(\d+);'(.+?)';{$typeId};(\d+)(;'([^\n]+)')?\n?/";
            // On récupère les noeuds de ce type
            $matched = preg_match_all($nodes_from_type_pattern, $src, $matches, PREG_SET_ORDER);
            // On les range dans un tableau
            $nodes_from_types[$typeId] = $matches;


        }

        try {
            // Connexion à la base de donnée
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
                $sql = "INSERT INTO node (id, name, id_type, weight, formatted_name) 
						VALUES (?, ?, ?, ?, ?)
                        ON DUPLICATE KEY UPDATE 
                        name = VALUES(name),
                        id_type = VALUES(id_type),
                        weight = VALUES(weight),
                        formatted_name = VALUES(formatted_name);";

                $insertStmt = $em->getConnection()->prepare($sql);

                // Pour chaque type de noeuds
                foreach ($nodes_from_types as $typeId => $nodes) {

                    $this->buffer .= "<hr /><p>Nodes of type : <pre>$typeId</pre></p>";

                    // e;3739399;'cabriole>83824';1;0;'cabriole>équitation'
                    // /e;(\d+);'(.+?)';{$typeId};(\d+);('(.+?)')?\n?/

                    // Pour chaque noeud de ce type
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

        return $this->render('@Jdmapi/batch/insertnodes.html.twig', array("buffer" => $this->buffer));
    }


    /*
     * Requête rezo-dump avec un terme et un paramètrage optionnel des relations
     * liées à celui-ci et insère et mets à jour les relations résultantes dans la base de donnée
     * optionnellement filtrées selon le paramètre de requête rel et la valeur du paramètre $relid.
     */
    public function insertRelsAction(Request $request, Int $relid = 0)
    {

        $this->buffer = "<p>Begin source parsing</p>";

        $term = "renard";
        $url = "http://www.jeuxdemots.org/rezo-dump.php?gotermsubmit=Chercher&gotermrel={$term}&rel=";
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

        // réglage de timeout pour file_get_contents avec
        // backup et restauration de la valeur existante
        // après l'opération
        $default_socket_timeout = ini_get('default_socket_timeout');
        ini_set('default_socket_timeout', 60*3);
        $src = file_get_contents($url);
        ini_set('default_socket_timeout', $default_socket_timeout);
        // Conversion de l'encodage de la page source en UTF-8
        $src = mb_convert_encoding($src, "UTF-8", "ISO-8859-1");

        // Get node EID
        $node_id_pattern = "/\(eid=(\d+)\)/";
        $matches = array();

        $matched = preg_match($node_id_pattern, $src,$matches);

        if ($matched) {
            $query_node_id = $matches[1];
            $matches = array();
        } else {
            throw Exception("Le Node ID du mot n'a pas été trouvé dans le code source.");
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
                        $this->buffer .="Relation \$$id_node2 = $id_node2<br />";
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
                //$this->buffer .='Whoops, could not connect to the SQLite database!';
                $this->buffer .='Whoops, could not connect to the MySQL database!';
            }

        } catch (\PDOException $e) {
            $this->buffer .='Connection failed: ' . $e->getMessage();
        }

        return $this->render('@Jdmapi/batch/insertrels.html.twig', array("buffer" => $this->buffer));
    }

}
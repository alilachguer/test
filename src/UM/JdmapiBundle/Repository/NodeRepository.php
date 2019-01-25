<?php

namespace UM\JdmapiBundle\Repository;

use Symfony\Component\Serializer\Serializer;

/**
 * nodeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NodeRepository extends \Doctrine\ORM\EntityRepository
{
    protected $stmts = array();
    protected $sources = array();

    /**
     * Renvoie le code source de Rezo-dump pour la requête
     * @return string
     */
    public function getSource($key): string
    {
        if (isset($this->sources[$key]) && !empty($this->sources[$key])) {
            return $this->sources[$key];
        } else {
            return "";
        }
    }

    /**
     * Enregistre le code source récupéré sur Rezo-dump pour réutilisation
     */
    public function setSource(string $key, string $src)
    {
        if (!empty($src)) {
            return $this->sources[$key] = $src;
        }
    }

    /*
     * Teste l'existence d'un node/term dans la base locale
     * en recherchant son ID qu'elle renvoieS
     */
    public function existsLocally(String $urlencodedterm)
    {
        $em = $this->getEntityManager();
        $conn = $em->getConnection();

        //echo "<p>\$urlencodedterm = $urlencodedterm</p>";

        // Si la requête préparée existe on la récupère et on l'exécute
        if (isset($this->stmts["existsLocally"]) && is_object($this->stmts["existsLocally"])
            && "Doctrine\DBAL\Driver\Statement" == get_class($this->stmts["existsLocally"])) {
            $stmt = $this->stmts["existsLocally"];
            $stmt->execute(array($urlencodedterm));

        // Sinon on crée la requête on l'exécute et on l'enregistre
        } else {
            $sql = "SELECT N.id FROM node N WHERE Binary N.name = ? AND is_main = 1 LIMIT 1";

            $stmt = $conn->executeQuery($sql, array($urlencodedterm));
            $this->stmts["existsLocally"] = $stmt;
        }
        $idRrow = $stmt->fetch();
        return $idRrow["id"] ?? 0;
    }

    /*
    * Insertion ou mise à jour d'un terme isolé avec le statut "main" (terme principal)
    * à réaliser après l'insertion des noeuds et relations pour ce terme.
    */
    public function insertMain(array $data) {

        // Récupération de l'ID d'un terme existant
/*        if (is_null($id)) {
            $row = $this->findBy(array("name" => $urlencodedterm));

            var_dump($id);
            exit();

            if (empty($row) || !isset($row[0]) || !is_object($row[0])) {
                throw new \Exception("ID du terme principal introuvable (donnée requise).");
            } else {
                $node = $row[0];
                $id = $node->getId();
            }
        }*/


        /***
        $fp = fopen('mots.json', 'w');
        $file = file_get_contents('./mots.json', FILE_USE_INCLUDE_PATH);
        $data = json_decode($file, true);
        $json = json_decode($file);
        dump($data);
        exit();
         */

        $sql = "INSERT INTO node (id, name, id_type, weight, formatted_name, is_main, definitions)
                VALUES (?, ?, ?, ?, ?, 1, ?)
                ON DUPLICATE KEY UPDATE
                name = VALUES(name),
                id_type = VALUES(id_type),
                weight = VALUES(weight),
                formatted_name = VALUES(formatted_name),
                is_main = 1,
                definitions = VALUES(definitions);";

        $em = $this->getEntityManager();
        $insertStmt = $em->getConnection()->prepare($sql);

        $insertStmt->bindValue(1, /*id*/ $data["id"]);
        $insertStmt->bindValue(2, /*name*/ $data["name"]);
        $insertStmt->bindValue(3, /*type*/ $data["type"]);
        $insertStmt->bindValue(4, /*weight*/ $data["weight"]);
        $insertStmt->bindValue(5, /*formatted_name*/ $data["formatted_name"]);
        $insertStmt->bindValue(6, /*formatted_name*/ $data["definitions"]);

//            echo "<pre>";
//            print_r($data);
//            echo "\$sql = $sql";
//            echo "</pre>";
//            exit();

        $insertStmt->execute();
    }

    /*
     * Renvoie les les données pour un noeud d'ID $nodeId
     * avec ou sans ses relation
     */
    public function get(string $nodeId, bool $excludeRelout, bool $excludeRelin,
                        String $relTypes = "all", String $nodeTypes = "all",
                        String $sortDirection1 = "DESC", String $sortDirection2 = "DESC")
    {
        // Pas de filtrage par défaut
        $filterNodeType = "false";
        $filterRelType = "false";
        $patternIdSet = "/(\d+,?)*/";

        // Filtrage par type de noeuds actif
        if ("" !== $nodeTypes && preg_match($patternIdSet, $nodeTypes) && "all" !== $nodeTypes) {
            $filterNodeType = "true";
        }

        // Filtrage par type des relations actif
        if ("" !== $relTypes && preg_match($patternIdSet, $relTypes) && "all" !== $relTypes) {
            $filterRelType = "true";
        }

        // Si la requête préparée correspondante existe déjà on la récupère et on l'exécute
        if (isset($this->stmts["get"][$filterRelType][$filterNodeType][$sortDirection1][$sortDirection2])
            && is_object($this->stmts["get"][$filterRelType][$filterNodeType][$sortDirection1][$sortDirection2])
            && "Doctrine\DBAL\Driver\Statement" == get_class($this->stmts["get"][$filterRelType][$filterNodeType][$sortDirection1][$sortDirection2])) {
            $stmt = $this->stmts["get"][$filterRelType][$filterNodeType][$sortDirection1][$sortDirection2];
            $stmt->execute(array($nodeId));
        // Sinon on crée la requête on l'exécute et on l'enregistre
        } else {

            $em = $this->getEntityManager();
            $conn = $em->getConnection();
            $select = "
                SELECT
                N.id AS main_node_id,
                N.name AS main_node_name,
                N.id_type AS main_node_id_type,
                N.weight AS main_node_weight,
                N.formatted_name AS main_node_formatted_name,
                N.definitions AS main_node_serialized_definition_array,

                D.id AS rel_node_id,
                D.name AS rel_node_name,
                D.id_type AS rel_node_id_type,
                D.weight AS rel_node_weight,
                D.formatted_name AS rel_node_formatted_name,
                D.is_main AS rel_node_is_main,

                R.id AS id_rel,
                R.id_node AS id_node_rel,
                R.id_node2 AS id_node2_rel,
                R.id_type AS id_type_rel,
                R.weight AS weight_rel,
                (R.id_node2 = N.id) AS is_relin,
                (R.id_node = N.id) AS is_relout,
                T. formatted_name as type_name

                ";

            $from = "FROM node N, relation R, node D , relation_type T
                ";
            $where = "WHERE N.id = ?

                 AND  T.id = R.id_type 

                 AND (
                    /* Relation entrante */
                    (N.id = R.id_node2 AND R.id_node = D.id)
                    OR
                    /* Relation sortante */
                    (N.id = R.id_node AND R.id_node2 = D.id)
                  )

                 ";
            // $orderBy = "ORDER BY is_relin DESC, weight_rel DESC";

            if ($excludeRelin) {
                // AND is_relin = 0
                $where .= " AND (R.id_node2 = N.id) = 0
                ";
                $excludeRelin = "true"; // String pour clé tableau stockage Statement
            }

            if ($excludeRelout) {
                // AND is_relout = 0
                $where .= " AND (R.id_node = N.id) = 0
                   ";
                $excludeRelout = "true"; // String pour clé tableau stockage Statement
            }

            //**********************************************
            // Filtrage par type de relations
            //**********************************************
            if ("true" === $filterRelType) {
                $where .= "AND R.id_type IN(" . trim($relTypes, ",") .") ";
            }

            //**********************************************
            // Filtrage par type de noeuds
            //**********************************************
            if ("true" === $filterNodeType) {
                $where .= "AND D.id_type IN(" . trim($nodeTypes, ",") . ") ";
            }

            $sql = $select . $from . $where; // . $orderBy

//            echo "<pre>";
//            echo "\$sql = $sql";
//            echo "</pre>";
//            exit();


            $stmt = $conn->executeQuery($sql, array($nodeId));
            $this->stmts["get"][$excludeRelin][$excludeRelout][$filterNodeType][$filterRelType][$sortDirection1][$sortDirection2] = $stmt;
        }

//        echo "<pre>";
//        var_dump($stmt->fetchAll());
//        echo "</pre>";
//        exit();

        return $stmt->fetchAll();
    }

    /*
     * Insère ou mets à jour la base de donnée pour le noeud de type $typeId avec les données
     * contenues dans $nodeData.
     */
    public function insert(Int $typeId, array $nodeData) {

       
            $em = $this->getEntityManager();

            if (isset($this->stmts["insert"]) && is_object($this->stmts["insert"])
                && "Doctrine\DBAL\Driver\Statement" == get_class($this->stmts["insert"])) {
                $insertStmt = $this->stmts["insert"];

            } else {


               
            
                // SQLite Upsert
                /*$sql = "INSERT OR REPLACE INTO node (id, name, id_type, weight, formatted_name)
                            VALUES (?, ?, ?, ?, ?)
                            ON CONFLICT(id) DO UPDATE
                            SET name = excluded.name,
                            id_type = excluded.id_type,
                            weight = excluded.weight,
                            formatted_name = excluded.formatted_name;";*/

                // MySQL Upsert
                $sql = "INSERT INTO node (id, name, id_type, weight, formatted_name,is_main)
						VALUES (?, ?, ?, ?, ?,0)
                        ON DUPLICATE KEY UPDATE
                        name = VALUES(name),
                        id_type = VALUES(id_type),
                        weight = VALUES(weight),
                        formatted_name = VALUES(formatted_name);";

                $insertStmt = $em->getConnection()->prepare($sql);
                $this->stmts["insert"] = $insertStmt;
            }
             
            
            $name = $nodeData[2] ?? null;

            $weight = $nodeData[3] ?? null;
            $formattedName = $nodeData[5] ?? null;
            // echo "<p>Node ID = {$nodeData[1]}<br />";
            // echo "Node \$decodedName = "+ $decodedName +"<br />";
            // echo "Node \$weight = $weight<br />";
            // echo "Node \$formattedName = $formattedName</p>";

            $insertStmt->bindValue(1, /*id*/ $nodeData[1]);
            $insertStmt->bindValue(2, /*name*/  $name);
            $insertStmt->bindValue(3, /*type*/ $typeId);
            $insertStmt->bindValue(4, /*weight*/ $weight);
            $insertStmt->bindValue(5, /*formatted_name*/ $formattedName);

        

            try{
                $Success=$insertStmt->execute();
                if(!$Success){}
                }
                catch(PDOException $e)
                {
                }


    }


    public static function convertUtf8codes(string $word) {

        $pattern = "/\x{0000}-\x{ffff}/u";
        $match = array();
        $return = $word;

      //  echo "<p>\$word in convertUtf8codes = $word</p>";

        while (preg_match($pattern, $word,$match)) {

            $codePoint = $match[0];
            $hexa = substr($codePoint, 4);

            echo "<p>\$word = $word</p>";
            echo "<p>\$codePoint = $codePoint</p>";
            echo "<p>\$hexa = $hexa</p>";

            $ascii = hexdec($hexa);

            echo "<p>\$ascii = $ascii</p>";

            if (is_int($ascii)) {
                $char = chr($ascii);
                $return = str_replace($hexa, $char, $word);
            } else {
                continue;
            }
        }
    //    echo "<p>\$return = $return</p>";

        return $return;

//        $search = array(
//            "\\u009c",
//            "\\u00e8"
//        );
//       $replace = array(
//           "œ",
//           "è"
//       );
//       return str_replace($search, $replace, $word);
    }


    // Récupération des définition d'un noeud dans le code source
    // Extraction du bloc de définition et appel à sous-fonction
    // pour renvoyer chaque définition dans un tableau
    protected function getDefinitions(string $src) {

        $definitions = array();
            // Récupère l'ensemble des définitions
        $pattern = "#<def>\n(.+\n)+</def>#";
        $matched = preg_match($pattern, $src, $matches);

        // Mot sans définition
        if (1 !== $matched) {
            $definitions["message"] = "Définition absente pour ce terme.";
        // Définition(s) présentes
        } else {
            $definitions = $this->splitDefinitions($matches[0]);
        }


        return $definitions;

    }

    // Renvoie les différentes définitions d'un mot dans un tableau
    // à partir du bloc de définitions contenu dans le code source
    // de rezo-dump
    protected function splitDefinitions (string $strDefinitions) {

        // Extraction de chaque définition depuis le bloc des définitions
        $pattern = "#(?<=<br\s\/>\n)(\d+\.\s+)?([^<]+)#";
        $matched = preg_match_all($pattern, $strDefinitions, $matches);

        return array("definitions" => $matches[2], "nbrDefinitions" => $matched);
    }


    /*
     * Requête rezo-dump avec un terme et un paramètrage optionnel des relations
     * liées à celui-ci. Renvoie les résultats dans un tableau avec l'ID du terme requêté.
     */
    public function getNodesFromTypes(String $urlencodedterm, String $relDir = "*") {

        $urlencodedterm = rawurlencode(utf8_decode($urlencodedterm));
        $url = "http://www.jeuxdemots.org/rezo-dump.php?gotermsubmit=Chercher&gotermrel={$urlencodedterm}";

        // echo "<p>\$url = $url</p>";

        // Exclusion des relations entrantes
        if (in_array($relDir, array("relout", "none"))) {
            $url .= "&relin=norelin";
        }
        // Exclusion des relations sortantes
        if (in_array($relDir, array("relin", "none"))) {
            $url .= "&relout=norelout";
        }

        // réglage de timeout pour file_get_contents avec
        // backup et restauration de la valeur existante
        // après l'opération
        $default_socket_timeout = ini_get('default_socket_timeout');
        ini_set('default_socket_timeout', 60*3);
        $src = file_get_contents($url);
        //$src = file_get_contents("rezo-dump_source_cheval.html");
        ini_set('default_socket_timeout', $default_socket_timeout);
        // Conversion de l'encodage de la page source en UTF-8
        $src = mb_convert_encoding($src, "UTF-8", "ISO-8859-1");

        // Enregistrement du code source pour réutilisation
        $sourceKey = serialize($urlencodedterm . $relDir);

        // echo "<p>\$sourceKey = $sourceKey</p>";

        $this->setSource($sourceKey, $src);

        // Le premier noeud matché est le noeud principal
        // les noeuds/termes (Entries) : e;eid;'name';type;w;'formated name'
        // e;73893;'singe';1;864
        $matches = array();
        $pattern_main_node = "/e;(\d+);'(.+?)';(\d+);(\d+)(;'([^\n]+)')?\n?/";
        $matched = preg_match($pattern_main_node, $src, $matches);

        if (1 !== $matched) {
            $message = "Le noeud principal n'a pas été trouvé dans le code source JDM.";
            $message .= "Code source : <hr />". htmlentities(substr($src, 0, 1000));
            throw new \Exception($message);
        }

        // on conserve son ID pour le renvoyer dans les résultats.
        $mainId = $matches[1];

        // Récupération des définitions pour ce mot
        $definitions = $this->getDefinitions($src);

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
            $nodes_from_type_pattern = "/e;(\d+);'(.+?)';{$typeId};(\d+)(;'([^\n]+)')?\n?/";
            // On récupère les noeuds de ce type
            $matched = preg_match_all($nodes_from_type_pattern, $src, $matches, PREG_SET_ORDER);
            // On les range dans un tableau
            $nodes_from_types[$typeId] = $matches;
        }

        return array("nodes_from_types" => $nodes_from_types, "mainId" => $mainId, "definitions" => $definitions);
    }

    /*
     * Set DB connection ends and channel to UTF8
     * */
    public function setConnectionChannelUtf8() {

        try {
            $sqlInit = "SET NAMES 'utf8';";
            $em = $this->getEntityManager();
            $em->getConnection()->executeQuery($sqlInit);

        } catch (\PDOException $e) {
            echo "SET NAMES 'utd8' has thrown an Exception : " . $e->getMessage();
        }
    }

}

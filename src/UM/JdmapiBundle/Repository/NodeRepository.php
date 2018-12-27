<?php

namespace UM\JdmapiBundle\Repository;

/**
 * nodeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NodeRepository extends \Doctrine\ORM\EntityRepository
{
    protected $stmts = array();

    /*
     * Teste l'existence d'un node/term dans la base locale
     * en recherchant son ID qu'elle renvoieS
     */
    public function existsLocally(String $urlencodedterm)
    {
        $em = $this->getEntityManager();
        $conn = $em->getConnection();

        // Si la requête préparée existe on la récupère et on l'exécute
        if (isset($this->stmts["existsLocally"]) && is_object($this->stmts["existsLocally"])
            && "Doctrine\DBAL\Driver\Statement" == get_class($this->stmts["existsLocally"])) {
            $stmt = $this->stmts["existsLocally"];
            $stmt->execute(array($urlencodedterm));

        // Sinon on crée la requête on l'exécute et on l'enregistre
        } else {
            $sql = "SELECT N.id FROM node N WHERE N.name = ? LIMIT 1";

            $stmt = $conn->executeQuery($sql, array($urlencodedterm));
            $this->stmts["existsLocally"] = $stmt;
        }
        $idRrow = $stmt->fetch();
        return $idRrow["id"] ?? 0;
    }

    /*
     * Renvoie les les données pour un noeud d'ID $nodeId
     * avec ou sans ses relation
     */
    public function get(string $nodeId, bool $excludeRelout, bool $excludeRelin,
                        String $relTypes = "", String $nodeTypes = "", string $sortDirection = "DESC")
    {
        // Pas de filtrage par défaut
        $filterNodeType = "false";
        $filterRelType = "false";
        $patternIdSet = "/(\d+,*)*/";

        // Filtrage par type de noeuds actif
        if (!empty($nodeTypes) && preg_match($patternIdSet, $nodeTypes)) {
            $filterNodeType = "true";
        }

        // Filtrage par type des relations actif
        if (!empty($relTypes) && preg_match($patternIdSet, $relTypes)) {
            $filterRelType = "true";
        }

        // Si la requête préparée correspondante existe on la récupère et on l'exécute
        if (isset($this->stmts["get"][$filterRelType][$filterNodeType][$sortDirection])
            && is_object($this->stmts["get"][$filterRelType][$filterNodeType][$sortDirection])
            && "Doctrine\DBAL\Driver\Statement" == get_class($this->stmts["get"][$filterRelType][$filterNodeType][$sortDirection])) {
            $stmt = $this->stmts["get"][$filterRelType][$filterNodeType][$sortDirection];
            $stmt->execute(array($nodeId));
        // Sinon on crée la requête on l'exécute et on l'enregistre
        } else {

            $em = $this->getEntityManager();
            $conn = $em->getConnection();
            $select = "SELECT N.*, 
                          RI.id AS id_relin, 
                          RI.id_node AS id_node_relin, 
                          RI.id_type AS id_type_relin, 
                          RI.weight AS weight_relin, 
                          RO.id AS id_relin, 
                          RO.id_node2 AS id_node_relout, 
                          RO.id_type AS id_type_relout, 
                          RO.weight AS weight_relout ";
            $from = "FROM node N ";
            $where = "WHERE N.id = ? ";
            $orderBy = "ORDER BY (weight_relin + weight_relout) $sortDirection;";

            // Inclusion des relation entrantes ou/et sortantes (les 2 par défaut)
            if (!$excludeRelout || !$excludeRelin) {

                $where .= "AND (";

                if (!$excludeRelin) {
                    $from .= ", relation RI ";
                    $where .= "RI.id_node2 = N.id";
                }

                if (!$excludeRelout) {
                    if (!$excludeRelin) {
                        $where .= " OR ";
                    }
                    $from .= ", relation RO ";
                    $where .= "RO.id_node = N.id";
                }

                $where .= ") ";

                //**********************************************
                // Filtrage par type de relations
                //**********************************************

                // Filtrage par type des relations
                if ("true" === $filterRelType) {
                    $where .= "AND RI.id_type IN('" . trim($relTypes, ",") ."') ";
                }

                //**********************************************
                // Filtrage par type de noeuds
                //**********************************************

                // Filtrage par type des relations sortantes
                if ("true" === $filterNodeType) {
//                    $from .= ", nodeType NT ";
//                    $where .= "N.id = NT.id AND NT.id IN('" . implode("','", $filter["nodetype"]) . "') ";
                    $where .= "AND N.id_type IN('" . trim($nodeTypes, ",") . "') ";
                }

            }

            $sql = $select . $from . $where . $orderBy;

//            echo "<pre>";
//            echo "\$sql = $sql";
//            echo "</pre>";
//            exit();
            
            $stmt = $conn->executeQuery($sql, array($nodeId));
            $this->stmts["get"][$filterRelin][$filterRelout][$filterNodeType][$sortDirection] = $stmt;
        }

        return $stmt->fetchAll();
    }


}

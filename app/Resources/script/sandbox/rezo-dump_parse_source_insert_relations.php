<?php

require './phpsqliteconnect/vendor/autoload.php';

use App\SQLiteConnection;
use App\MySQLConnection;


echo "<p>Begin source parsing</p>";

$src = file_get_contents("http://www.jeuxdemots.org/rezo-dump.php?gotermsubmit=Chercher&gotermrel=cheval&rel=");
//$src = file_get_contents("rezo-dump_source_cheval.html");

// Pattern collection by relation type
// generic relation pattern : ^r;(\d+);(\d+);(\d+);(\d+);(-?\d+)\n?

// Get node EID
$node_id_pattern = "/\(eid=(\d+)\)/";
$matches = array();
$matches = array();

$matched = preg_match($node_id_pattern, $src, $matches);

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

    //echo "\$type_id = $type_id<br />";

    $incoming_rels_from_type_pattern = "/r;(\d+);(\d+);{$query_node_id};{$type_id};(-?\d+)\n?/";
    $outgoing_rels_from_type_pattern = "/r;(\d+);{$query_node_id};(\d+);{$type_id};(-?\d+)\n?/";

    // Récupération des relations entrantes de ce type pour ce noeud

    $matched = preg_match_all($incoming_rels_from_type_pattern, $src, $matches, PREG_SET_ORDER);

    if ($matched) {
        $incoming_rels_from_types[$type_id] = $matches;
    }

/*    echo "<pre>";
    print_r($matches);
    echo "</pre>";*/

    // Récupération des relations sortantes de ce type pour ce noeud

//    echo "<hr />\$outgoing_rels_from_type_pattern = $outgoing_rels_from_type_pattern<br /><hr />";

    $matched = preg_match_all($outgoing_rels_from_type_pattern, $src, $matches, PREG_SET_ORDER);

    if ($matched) {
        $outgoing_rels_from_types[$type_id] = $matches;
    }

/*   echo "<pre>";
    print_r($matches);
    echo "</pre>";*/

}

/*echo "<pre>";
print_r($incoming_rels_from_types);
echo "</pre>";*/
/*echo "<pre>";
print_r($outgoing_rels_from_types);
echo "</pre>";*/

try {
	// $conn = new SQLiteConnection();
	// $pdo = (new SQLiteConnection())->connect();

    $conn = new MySQLConnection();
    $pdo = $conn->connect();

    if ($pdo != null) {

	    //echo 'Connected to the SQLite database successfully!';
        echo 'Connected to the MySQL database successfully!';

		$insertStmt = $pdo->prepare("INSERT INTO relation (id, id_node, id_node2, id_type, weight) 
						                       VALUES (?, ?, ?, ?, ?)");

		// Insertion des relations entrantes pour ce noeud
        // ====================================================

		// For each relation type array entry
		foreach ($incoming_rels_from_types as $type_id => $relations) {

            echo "<hr /><p>Incoming relations of type : <pre>$type_id</pre></p>";

		    foreach ($relations as $index => $relationData) {

                $id_relation = $relationData[1];
                $id_node1 = $relationData[2];
                $weight = $relationData[3] ?? null;

                echo "<p>Relation ID = $id_relation<br />";
                echo "Relation \$id_node1 = $id_node1<br />";
                echo "Relation \$weight = $weight</p>";

                $inserted = $insertStmt->execute(array(/*id*/ $id_relation,
                    /*id_node*/ $id_node1,
                    /*id_node2*/ $query_node_id,
                    /*id_type*/ $type_id,
                    /*weight*/ $weight)
                );
            }
        }


        // Insertion des relations sortantes pour ce noeud
        // ====================================================

        // For each relation type array entry
        foreach ($outgoing_rels_from_types as $type_id => $relations) {

            echo "<hr /><p>Outgoing relations of type : <pre>$type_id</pre></p>";

            foreach ($relations as $index => $relationData) {

                $incoming_rels_from_type_pattern = "/r;(\d+);(\d+);{$query_node_id};{$type_id};(-?\d+)\n?/";
                $outgoing_rels_from_type_pattern = "/r;(\d+);{$query_node_id};(\d+);{$type_id};(-?\d+)\n?/";

                // les relations entrantes : r;rid;node1;node2;type;w
                // r;9348721;44320;145246;0;-20

                $id_relation = $relationData[1];
                $id_node2 = $relationData[2];
                $weight = $relationData[3] ?? null;

                echo "<p>Relation ID = $id_relation<br />";
                echo "Relation \$$id_node2 = $id_node2<br />";
                echo "Relation \$weight = $weight</p>";

                $inserted = $insertStmt->execute(array(/*id*/ $id_relation,
                        /*id_node*/ $query_node_id,
                        /*id_node2*/ $id_node2,
                        /*id_type*/ $type_id,
                        /*weight*/ $weight)
                );
            }
        }


    }
	else {
        //echo 'Whoops, could not connect to the SQLite database!';
	    echo 'Whoops, could not connect to the MySQL database!';
	}

} catch (\PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}


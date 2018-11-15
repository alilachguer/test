<?php
require './phpsqliteconnect/vendor/autoload.php';

use App\SQLiteConnection;
use App\MySQLConnection;

echo "<p>Begin source parsing</p>";

$term = "cheval";
$targetRelationId = null;
$noRelIn = false;
$noRelOut = false;


$url = "http://www.jeuxdemots.org/rezo-dump.php?gotermsubmit=Chercher&gotermrel={$term}";

// Ciblage explicite d'une relation par son ID
if (isset($targetRelationId)) {
    $url .= "&rel={$targetRelationId}";
}
else {
    // Exclusion des relations entrantes
    if (true === $norelIn) {
        $url .= "&relin=norelin";
    }
    // Exclusion des relations sortantes
    if (true === $norelOut) {
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

/*    echo "<pre>";
    print_r($matches);
    echo "</pre>";*/

}

/*echo "<pre>";
print_r($nodes_from_types);
echo "</pre>";*/

try {

    // SQLITE3
    //$conn = new SQLiteConnection();

    $conn = new MySQLConnection();
    $pdo = $conn->connect();

	if ($pdo != null) {

        //echo 'Connected to the SQLite database successfully!';
        echo 'Connected to the MySQL database successfully!';

		$insertStmt = $pdo->prepare("INSERT INTO node (id, name, id_type, weight, formatted_name) 
						                       VALUES (?, ?, ?, ?, ?)");

		// For each node type nodes array
		foreach ($nodes_from_types as $typeId => $nodes) {

            echo "<hr /><p>Nodes of type : <pre>$typeId</pre></p>";

            // e;3739399;'cabriole>83824';1;0;'cabriole>équitation'
            // /e;(\d+);'(.+?)';{$typeId};(\d+);('(.+?)')?\n?/

		    foreach ($nodes as $index => $nodeData) {


                $name = $nodeData[2] ?? null;
                $weight = $nodeData[3] ?? null;
                $formattedName = $nodeData[5] ?? null;

                echo "<p>Node ID = {$nodeData[1]}<br />";
                echo "Node \$name = $name<br />";
                echo "Node \$weight = $weight<br />";
                echo "Node \$formattedName = $formattedName</p>";

                $insertStmt->execute(array(/*id*/ $nodeData[1],
                    /*name*/ $name,
                    /*type*/ $typeId,
                    /*weight*/ $weight,
                    /*formatted_name*/ $formattedName)
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


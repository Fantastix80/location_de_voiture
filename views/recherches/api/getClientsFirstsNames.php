<?php

require_once "../../../src/db_connexion.php";

$db = CONNECT_DB();
$prenoms = $db->query("SELECT prenom FROM CLIENTS;")->fetchAll(PDO::FETCH_NUM);

$data = [];
for ($i = 0; $i < count($prenoms); $i++) {
    $data[] = $prenoms[$i][0];
}

echo json_encode($data , JSON_PRETTY_PRINT);
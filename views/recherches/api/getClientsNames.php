<?php

require_once "../../../src/db_connexion.php";

$db = CONNECT_DB();
$noms = $db->query("SELECT nom FROM CLIENTS;")->fetchAll(PDO::FETCH_NUM);

$data = [];

for ($i = 0; $i < count($noms); $i++) {
    $data[] = $noms[$i][0];
}

echo json_encode($data , JSON_PRETTY_PRINT);
<?php

function findAll($db, string $table, string $orderBy) {

    $query = "SELECT * FROM $table ORDER BY $orderBy ASC";
    $data = $db->prepare($query);
    $data->execute();

    return $data->fetchAll(PDO::FETCH_ASSOC);
}

function findLimit($db, string $table, string $orderBy, int $startFrom, int $numberOfResults) {

    $query = "SELECT * FROM $table ORDER BY $orderBy ASC LIMIT :startFrom, :numberOfResults";
    $data = $db->prepare($query);
    $data->bindValue("startFrom", $startFrom, PDO::PARAM_INT);
    $data->bindValue("numberOfResults", $numberOfResults, PDO::PARAM_INT);
    $data->execute();

    return $data->fetchAll(PDO::FETCH_ASSOC);
}

function insert($db, string $table, array $data):string {

    $sqlFields = [];
    foreach ($data as $key => $value) {
        $sqlFields[] = "$key = :$key";
    }

    $query = $db->prepare("INSERT INTO $table SET " . implode(', ', $sqlFields) . ";");

    if ($query->execute($data)) {
        $rep = "L'élément a bien été enregistré !";
    } else {
        $rep = "Un problème est survenue lors de l'enregistrement de la voiture.";
    }

    return $rep;
}

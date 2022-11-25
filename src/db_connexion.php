<?php

require_once "db_identifiants.php";

function CONNECT_DB() {
    try {
        $db = new PDO('mysql:host=' . DB_SERVER .';dbname=' . DB_NAME, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        $db = $e->getMessage();
    }

    return $db;
}

function DISCONNECT_DB($db) {
    $db = null;
}
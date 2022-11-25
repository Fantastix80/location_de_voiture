<?php

require_once "../db_connexion.php";
require_once "../fonctions/fonctions_bdd.php";
require_once "../fonctions/validate.php";

$immat = $_POST["immatriculation"];
$marque = $_POST["marque"];
$modele = $_POST["modele"];
$cylindre = $_POST["cylindre"];
$date_achat = $_POST["dateachat"];

if (isNotNull($immat) && isNotNull($marque) && isNotNull($modele) && isNotNull($cylindre) && isInt($cylindre) && isNotNull($date_achat)) {
    $db = CONNECT_DB();

    $data = [
        "immatriculation" => $immat,
        "marque" => $marque,
        "modele" => $modele,
        "cylindre" => $cylindre,
        "dateachat" => $date_achat
    ];

    print_r(insert($db, "voitures", $data));

    header("refresh:2; url=../../views/voitures/affichageVoitures.php");
} else {
    print_r("Les champs n'ont pas été remplis correctement.");
    header("refresh:2; url=../../views/voitures/formulaireVoitures.php");
}





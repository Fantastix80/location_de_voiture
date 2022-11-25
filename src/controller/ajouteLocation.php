<?php

require_once "../db_connexion.php";
require_once "../fonctions/fonctions_bdd.php";
require_once "../fonctions/validate.php";

$idClient = $_POST["idClient"];
$immat = $_POST["immatriculation"];
$dateDebut = $_POST["dateDebut"];
$dateFin = $_POST["dateFin"];
$dateRetour = $_POST["dateRetour"];
$assurance = $_POST["assurance"];

if (isNotNull($idClient) && isNotNull($immat) && isNotNull($dateDebut) && isNotNull($dateFin) && isNotNull($dateRetour) && isNotNull($assurance)) {
    $db = CONNECT_DB();

    $data = [
        "idClient" => $idClient,
        "immatriculation" => $immat,
        "dateDebut" => $dateDebut,
        "dateFin" => $dateFin,
        "dateRentree" => $dateRetour,
        "assurance" => $assurance
    ];

    print_r(insert($db, "locations", $data));
    header("refresh:2; url=../../views/locations/affichageLocations.php");
} else {
    print_r("Les champs n'ont pas été remplis correctement.");
    header("refresh:2; url=../../views/locations/formulaireLocations.php");
}





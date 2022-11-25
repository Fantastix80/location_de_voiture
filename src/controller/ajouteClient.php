<?php

require_once "../db_connexion.php";
require_once "../fonctions/fonctions_bdd.php";
require_once "../fonctions/validate.php";

$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$codepostal = $_POST["codePostal"];
$ville = $_POST["ville"];
$rue = $_POST["rue"];
$numero = $_POST["num"];
$tel = $_POST["tel"];
$email = $_POST["email"];

if (isNotNull($nom) && isNotNull($prenom) && isNotNull($codepostal) && isNotNull($ville) && isNotNull($rue) && isNotNull($numero) && isNotNull($tel) && isInt($tel) && isNotNull($email)) {
    $db = CONNECT_DB();

    $data = [
        "nom" => $nom,
        "prenom" => $prenom,
        "codePostal" => $codepostal,
        "localite" => $ville,
        "rue" => $rue,
        "numero" => $numero,
        "telephone" => $tel,
        "email" => $email
    ];

    print_r(insert($db, "clients", $data));
    header("refresh:2; url=../../views/clients/affichageClients.php");
} else {
    print_r("Les champs n'ont pas été remplis correctement.");
    header("refresh:2; url=../../views/clients/formulaireClients.php");
}





<?php

require_once "../../src/fonctions/fonctions_bdd.php";
require_once "../../src/fonctions/validate.php";
require_once "../../src/db_connexion.php";

$db = CONNECT_DB();

if (isset($_POST["submit"])) {
    $nom = strtoupper($_POST["nom"]);
    $prenom = strtoupper($_POST["prenom"]);

    if (isNotNull($nom) && isNotNull($prenom)) {
        $data = [
            "nom" => $nom,
            "prenom" => $prenom
        ];

        $query = $db->prepare("SELECT * FROM voitures WHERE immatriculation IN (SELECT immatriculation FROM locations WHERE idClient IN (SELECT idClient FROM clients WHERE UPPER(nom) = :nom AND UPPER(prenom) = :prenom));");
        $query->execute(["nom" => $nom, "prenom" => $prenom]);
        $liste_voitures = $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

DISCONNECT_DB($db);

function getClientsNames() {
    $db = CONNECT_DB();
    $noms = $db->query("SELECT nom FROM CLIENTS;")->fetchAll(PDO::FETCH_NUM);
    DISCONNECT_DB($db);

    $data = [];
    for ($i = 0; $i < count($noms); $i++) {
        array_push($data, $noms[$i][0]);
    }
    var_dump($data);
    return json_encode($data);
}

require_once "../layouts/header.php";
?>

    <main class="container content w-100 mt-5">

        <!-- Recherche par nom et prénom -->
        <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
            <h1>Liste des véhicules loués par un client</h1>
            <a href="recherches.php" class="btn btn-primary">Retour au menu</a>
        </div>

        <form autocomplete="off" method="POST" class="mt-3 rechercheDynamique">
            <div class="mb-3 champs">
                <label for="nom" class="form-label">Nom du client:</label>
                <input id="nom" type="text" name="nom" class="form-control">
            </div>
            <div class="mb-3 champs">
                <label for="prenom" class="form-label">Prénom du client:</label>
                <input id="prenom" type="text" name="prenom" class="form-control">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <table class="table">
            <thead>
            <tr class="table-header">
                <th>Immatriculation</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Cylindre</th>
                <th>Date d'achat</th>
            </tr>
            </thead>

            <tbody>
            <?php
            if (isset($liste_voitures)) {
                if (count($liste_voitures) > 0) { ?>
                    <?php foreach ($liste_voitures as $voiture) : ?>
                        <tr>
                            <td> <?= $voiture['immatriculation']; ?></td>
                            <td> <?= $voiture['marque'] ?></td>
                            <td> <?= $voiture['modele']; ?></td>
                            <td> <?= $voiture['cylindre'] ?></td>
                            <td> <?= $voiture['dateachat'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6" class="text-center">Aucune voitures n'a été loué par cette personne.</td>
                    </tr>
                    <?php
                }
            } ?>
            </tbody>
        </table>

    </main>

    <script type="text/javascript" src="../../assets/js/autoComplete.js"></script>

    <script>
        var noms = [];
        var prenoms = [];

        function autocompletion(data, tableau) {
            if (tableau == "noms") {
                for(let i = 0; i < data.length; i++) {
                    noms.push(data[i]);
                }
            } else {
                for(let i = 0; i < data.length; i++) {
                    prenoms.push(data[i]);
                }
            }
        }

        const promise = fetch('http://localhost:8000/views/recherches/api/getClientsNames.php');
        promise.then((reponse) => {
            const data = reponse.json();
            data.then((reponse) => autocompletion(reponse, "noms"))
        })

        const promise2 = fetch('http://localhost:8000/views/recherches/api/getClientsFirstsNames.php');
        promise2.then((reponse2) => {
            const data2 = reponse2.json();
            data2.then((reponse2) => autocompletion(reponse2, "prenoms"))
        })

        autocomplete(document.getElementById("nom"), noms);
        autocomplete(document.getElementById("prenom"), prenoms);
    </script>

<?php require_once "../layouts/footer.php";
<?php

require_once "../../src/fonctions/fonctions_bdd.php";
require_once "../../src/fonctions/validate.php";
require_once "../../src/db_connexion.php";

$db = CONNECT_DB();

$liste_marque_modele = findAll($db, "voitures", "marque,modele");

if (isset($_POST["marque_modele"])) {
    $marque_modele = explode("|", $_POST["marque_modele"]);
    $marque = $marque_modele[0];
    $modele = $marque_modele[1];

    $query = "SELECT * FROM clients WHERE idClient IN (SELECT idClient FROM locations WHERE immatriculation IN (SELECT immatriculation FROM voitures WHERE marque = '$marque' AND modele = '$modele'));";
    $liste_clients = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

DISCONNECT_DB($db);

require_once "../layouts/header.php";
?>

    <main class="container content w-100 mt-5">

        <!-- Recherche par marque et modèle -->
        <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
            <h1>Liste des clients par marque/modèle de voiture</h1>
            <a href="recherches.php" class="btn btn-primary">Retour au menu</a>
        </div>

        <form action="" method="POST" class="d-flex justify-content-between mt-3">
            <div class="mb-3">
                <select class="form-select" name="marque_modele" onchange="this.form.submit();">
                    <option selected disabled>Sélectionnez la marque et modèle du véhicule</option>
                    <?php foreach ($liste_marque_modele as $marque_modele):  ?>
                        <option value="<?= $marque_modele['marque'] . '|' . $marque_modele['modele'] ?>"><?= $marque_modele['marque'] . " | " . $marque_modele['modele'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <table class="table mb-6">
            <thead>
            <tr class="table-header">
                <th>Nom</th>
                <th>Prénom</th>
                <th>Code postal</th>
                <th>Ville</th>
                <th>Rue</th>
                <th>Numéro</th>
                <th>Téléphone</th>
                <th>Email</th>
            </tr>
            </thead>

            <tbody>
            <?php
            if (isset($liste_clients)) {
                if (count($liste_clients) > 0) { ?>
                    <?php foreach ($liste_clients as $client) : ?>
                        <tr>
                            <td> <?= $client['nom']; ?></td>
                            <td> <?= $client['prenom'] ?></td>
                            <td> <?= $client['codePostal'] ?></td>
                            <td> <?= $client['localite'] ?></td>
                            <td> <?= $client['rue'] ?></td>
                            <td> <?= $client['numero'] ?></td>
                            <td> <?= $client['telephone']; ?></td>
                            <td> <?= $client['email'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6" class="text-center">Aucun client n'a loué de voiture de cette marque et de ce modèle.</td>
                    </tr>
                    <?php
                }
            } ?>
            </tbody>
        </table>

    </main>

<?php require_once "../layouts/footer.php";
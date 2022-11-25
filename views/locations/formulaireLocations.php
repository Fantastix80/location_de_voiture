<?php
require_once "../../src/fonctions/fonctions_bdd.php";
require_once "../../src/db_connexion.php";

$db = CONNECT_DB();

$liste_clients = findAll($db, 'clients', 'nom');
$liste_immat = findAll($db, 'voitures', 'immatriculation');


require_once "../layouts/header.php"
?>

<main class="container content w-100 mt-5">

    <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
        <h1>Ajouter une Location</h1>
        <a href="affichageLocations.php" class="btn btn-primary">Liste des Locations</a>
    </div>

    <form method="POST" action="../../src/controller/ajouteLocation.php">
        <div class="mb-3">
            <select class="form-select" name="idClient">
                <option selected disabled>Sélectionnez le client correspondant</option>
                <?php foreach ($liste_clients as $client):  ?>
                    <option value="<?= $client['idClient'] ?>"><?= $client['prenom'] . " " . $client['nom'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <select class="form-select" name="immatriculation">
                <option selected value="">Sélectionnez l'immatriculation correspondante</option>
                <?php foreach ($liste_immat as $immatriculation):  ?>
                    <option value="<?= $immatriculation['immatriculation'] ?>"><?= $immatriculation['immatriculation'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="dateDebut" class="form-label">Date de début:</label>
            <input id="dateDebut" type="datetime-local" name="dateDebut" class="form-control">
        </div>
        <div class="mb-3">
            <label for="dateFin" class="form-label">Date de fin:</label>
            <input id="dateFin" type="datetime-local" name="dateFin" class="form-control">
        </div>
        <div class="mb-3">
            <label for="dateRetour" class="form-label">Date de retour:</label>
            <input id="dateRetour" type="datetime-local" name="dateRetour" class="form-control">
        </div>
        <div class="mb-3">
            <label for="assurance" class="form-label">Assurance (0/1):</label>
            <input id="assurance" type="number" name="assurance" class="form-control">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
    </form>
</main>

<?php require_once "../layouts/footer.php" ?>

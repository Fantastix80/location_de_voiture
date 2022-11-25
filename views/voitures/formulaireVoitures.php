<?php require_once "../layouts/header.php" ?>

<main class="container content w-100 mt-5">

    <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
        <h1>Ajouter une voiture</h1>
        <a href="affichageVoitures.php" class="btn btn-primary">Liste des voitures</a>
    </div>

    <form method="POST" action="../../src/controller/ajouteVoiture.php">
        <div class="mb-3">
            <label for="immatriculation" class="form-label">Immatriculation:</label>
            <input id="immatriculation" type="text" name="immatriculation" class="form-control">
        </div>
        <div class="mb-3">
            <label for="marque" class="form-label">Marque:</label>
            <input id="marque" type="text" name="marque" class="form-control">
        </div>
        <div class="mb-3">
            <label for="modele" class="form-label">Modèle:</label>
            <input id="modele" type="text" name="modele" class="form-control">
        </div>
        <div class="mb-3">
            <label for="cylindre" class="form-label">Cylindre (cm3):</label>
            <input id="cylindre" type="number" name="cylindre" class="form-control">
        </div>
        <div class="mb-3">
            <label for="dateachat" class="form-label">Date d'achat:</label>
            <input id="dateachat" type="date" name="dateachat" class="form-control">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
    </form>
</main>

<?php require_once "../layouts/footer.php" ?>

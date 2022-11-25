<?php require_once "../layouts/header.php" ?>

<main class="container content w-100 mt-5">

    <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
        <h1>Ajouter un client</h1>
        <a href="affichageClients.php" class="btn btn-primary">Liste des clients</a>
    </div>

    <form method="POST" action="../../src/controller/ajouteClient.php">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom:</label>
            <input id="nom" type="text" name="nom" class="form-control">
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom:</label>
            <input id="prenom" type="text" name="prenom" class="form-control">
        </div>
        <div class="mb-3">
            <label for="codePostal" class="form-label">Code Postal:</label>
            <input id="codePostal" type="text" name="codePostal" class="form-control">
        </div>
        <div class="mb-3">
            <label for="ville" class="form-label">Ville:</label>
            <input id="ville" type="text" name="ville" class="form-control">
        </div>
        <div class="mb-3">
            <label for="rue" class="form-label">Rue:</label>
            <input id="rue" type="text" name="rue" class="form-control">
        </div>
        <div class="mb-3">
            <label for="num" class="form-label">Numéro:</label>
            <input id="num" type="text" name="num" class="form-control">
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Téléphone:</label>
            <input id="tel" type="text" name="tel" class="form-control">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input id="email" type="email" name="email" class="form-control">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
    </form>
</main>

<?php require_once "../layouts/footer.php" ?>

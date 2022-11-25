<?php require_once "../layouts/header.php"; ?>

    <main class="container content w-100 mt-5">

        <!-- Recherche par marque et modèle -->
        <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
            <h1>Liste des clients par marque/modèle de voiture</h1>
            <a href="rechercheParVoiture.php" class="btn btn-primary">Rechercher</a>
        </div>

        <!-- Recherche par nom et prénom -->
        <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline separate2forms">
            <h1>Liste des véhicules loués par un client</h1>
            <a href="rechercheParClient.php" class="btn btn-primary">Rechercher</a>
        </div>

    </main>

<?php require_once "../layouts/footer.php";
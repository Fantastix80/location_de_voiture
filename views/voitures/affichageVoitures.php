<?php

require_once "../../src/fonctions/fonctions_bdd.php";
require_once "../../src/db_connexion.php";

$url = "http://localhost:8000/views/voitures/affichageVoitures.php";
$liste_valeurs = [2, 4, 5, 7];

if (isset($_GET["numberOfResults"])) {
    if (is_numeric($_GET["numberOfResults"])) {
        $numberOfResults = $_GET["numberOfResults"];
        if (!in_array($numberOfResults, $liste_valeurs)) {
            $numberOfResults = $liste_valeurs[0];
        }
    }
} else {
    $numberOfResults = 2;
}

$db = CONNECT_DB();

$total_rows = count(findAll($db, "voitures", "immatriculation"));
$numberOfPages = ceil(($total_rows / $numberOfResults));

if (isset($_GET["page"])) {
    if (is_numeric($_GET["page"])) {
        $page = $_GET["page"];
        if ($page > $numberOfPages) {
            $page = $numberOfPages;
        } else if ($page < 0) {
            $page = 1;
        }
        $startFrom = ($page-1) * $numberOfResults;
    }
} else {
    $page = 1;
    $startFrom = ($page-1) * $numberOfResults;
}

$voitures = findLimit($db, "voitures", "immatriculation", $startFrom, $numberOfResults);

DISCONNECT_DB($db);

require_once "../layouts/header.php";
?>

<main class="container content w-100 mt-5">

    <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
        <h1>Liste des voitures</h1>
        <a href="formulaireVoitures.php" class="btn btn-primary">Ajouter une voiture</a>
    </div>

    <form action="" method="GET">
        <div class="mb-3">
            <select class="form-select" name="numberOfResults"  onchange="this.form.submit();">
                <?php
                foreach ($liste_valeurs as $valeur) : ?>
                    <option <?= ($valeur == $numberOfResults) ? 'selected' : '' ?> value=<?= $valeur ?>><?= $valeur ?></option>
                <?php endforeach; ?>
            </select>
        </div>
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
        if (isset($voitures)) {
            if (count($voitures) > 0) { ?>
                <?php foreach ($voitures as $voiture) : ?>
                    <tr>
                        <td> <?= $voiture['immatriculation']; ?></td>
                        <td> <?= $voiture['marque'] ?></td>
                        <td> <?= $voiture['modele']; ?></td>
                        <td> <?= $voiture['cylindre'] ?></td>
                        <td> <?= $voiture['dateachat']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php } else { ?>
                <tr>
                    <td colspan="6" class="text-center">Aucune voitures n'est enregistrée.</td>
                </tr>
            <?php
            }
        } ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        <ul class="pagination">
            <li class="page-item"><a <?= ($page == 1) ? 'style="pointer-events: none"' : '' ?> href="<?= $url.'?numberOfResults='.$numberOfResults.'&page='.$page - 1 ?>" class="page-link">Précédent</a></li>
            <?php
            for ($i = 1; $i <= $numberOfPages; $i++) {
                echo '<li class="page-item"><a href="'.$url.'?numberOfResults='.$numberOfResults.'&page='.$i.'" class="page-link">'.$i.'</a></li>';
            }
            ?>
            <li class="page-item"><a <?= ($page == $numberOfPages) ? 'style="pointer-events: none"' : '' ?> href="<?= $url.'?numberOfResults='.$numberOfResults.'&page='.$page + 1 ?>" class="page-link">Suivant</a></li>
        </ul>
    </div>

</main>

<?php require_once "../layouts/footer.php";
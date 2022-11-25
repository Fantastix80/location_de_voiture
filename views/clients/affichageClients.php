<?php

require_once "../../src/fonctions/fonctions_bdd.php";
require_once "../../src/db_connexion.php";

$url = "http://localhost:8000/views/clients/affichageClients.php";
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

$total_rows = count(findAll($db, "clients", "nom"));
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

$clients = findLimit($db, "clients", "nom", $startFrom, $numberOfResults);

DISCONNECT_DB($db);

require_once "../layouts/header.php";
?>

    <main class="container content w-100 mt-5">

        <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
            <h1>Liste des clients</h1>
            <a href="formulaireClients.php" class="btn btn-primary">Ajouter une client</a>
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
                <th>Nom</th>
                <th>Prénom</th>
                <th>Code Postale</th>
                <th>Ville</th>
                <th>Rue</th>
                <th>Numéro</th>
                <th>Téléphone</th>
                <th>Email</th>
            </tr>
            </thead>

            <tbody>
            <?php
            if (isset($clients)) {
                if (count($clients) > 0) { ?>
                    <?php foreach ($clients as $client) : ?>
                        <tr>
                            <td> <?= $client['nom']; ?></td>
                            <td> <?= $client['prenom']; ?></td>
                            <td> <?= $client['codePostal'] ?></td>
                            <td> <?= $client['localite']; ?></td>
                            <td> <?= $client['rue'] ?></td>
                            <td> <?= $client['numero']; ?></td>
                            <td> <?= $client['telephone']; ?></td>
                            <td> <?= $client['email']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6" class="text-center">Aucun clients n'est enregistré.</td>
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
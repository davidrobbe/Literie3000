<?php

$dsn = "mysql:host=localhost;dbname=literie3000";
$db = new PDO($dsn, "root", "");

$query = $db->query("SELECT id, marque, nom, taille, prix_normale, prix_solde, image_url FROM matelas");
$matelas = $query->fetchAll(PDO::FETCH_ASSOC);

include("templates/header.php");
?>
<h1>Catalogue</h1>
<div class="matelas">
    <?php
    foreach ($matelas as $m) {
    ?>
        <div class="m">
            <img src="<?= $m["image_url"] ?>" alt="<?= $m["nom"] ?>">
            <h2><?= $m["marque"] ?> - <?= $m["nom"] ?></h2>
            <p>Taille : <?= $m["taille"] ?></p>
            <p>Prix normal : <?= $m["prix_normale"] ?> €</p>
            <p>Prix soldé : <?= $m["prix_solde"] ?> €</p>

            <!-- Lien pour supprimer le matelas -->
            <a href="supprimer_matelas.php?id=<?= $m['id'] ?>" class="btn-supprimer">Supprimer</a>
        </div>

       
    <?php
    }
    ?>

<div class="detail">
        <h3>Vous y decouvrirez toutes nos dimensions :</h3>
        <p>90x190, 140x190, 160x200, 180x200, 200x200</p>
        <h3>et toutes nos marque de matelas :</h3>
        <p>Epeda, Dreamway, Bultex, Dorsoline, MemoryLine</p>
        </div>
</div>


<a href="add_matelas.php" class="btn-literie3000">Ajouter un matelas</a>

<?php
include("templates/footer.php");
?>

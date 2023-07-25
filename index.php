<?php
// Connexion à la base literie3000
$dsn = "mysql:host=localhost;dbname=literie3000";
$db = new PDO($dsn, "root", "");

// Récuperer les matelas de la table matelas
$query = $db->query("SELECT id, marque, nom, taille, prix_normale, prix_solde, image_url FROM matelas");
// Le parametre PDO::FETCH_ASSOC permet de ne récupérer les résultats qu'au format tableau associatif et non les deux
$matelas = $query->fetchAll(PDO::FETCH_ASSOC);

// Inclure le template header
include("templates/header.php");
?>
<h1>Nos matelas</h1>
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
</div>

<!-- Bouton pour rediriger vers la page d'ajout de matelas -->
<a href="add_matelas.php" class="btn-literie3000">Ajouter un matelas</a>

<?php
include("templates/footer.php");
?>

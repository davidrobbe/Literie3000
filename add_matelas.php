<?php
include("templates/header.php");

$error = [];

if (!empty($_POST)) {
    // Le formulaire est envoyé !
    // Utilisation de la fonction strip_tags pour supprimer d'éventuelles balises HTML
    // qui se seraient glissées dans les champs input et pallier à la faille XSS
    // Utilisation de la fonction trim pour supprimer d'éventuels espaces en début et fin de chaîne
    $marque = trim(strip_tags($_POST["marque"]));
    $nom = trim(strip_tags($_POST["nom"]));
    $taille = trim(strip_tags($_POST["taille"]));
    $prixNormale = trim(strip_tags($_POST["prix_normale"]));
    $prixSolde = trim(strip_tags($_POST["prix_solde"]));
    $imageUrl = "chemin/vers/image.jpg"; // Ici, vous devez gérer l'upload de l'image du matelas de la même manière que pour la recette

    if (empty($marque) || empty($nom) || empty($taille) || empty($prixNormale) || empty($prixSolde)) {
        $error["fields"] = "Tous les champs sont obligatoires.";
    }

    // Gestion de l'upload de l'image du matelas 

    // Requête d'insertion en BDD du matelas s'il n'y a aucune erreur
    if (empty($error)) {
        $dsn = "mysql:host=localhost;dbname=literie3000";
        $db = new PDO($dsn, "root", "");

        $query = $db->prepare("INSERT INTO matelas (marque, nom, taille, prix_normale, prix_solde, image_url)
                               VALUES (:marque, :nom, :taille, :prix_normale, :prix_solde, :image_url)");

        $query->bindParam(":marque", $marque);
        $query->bindParam(":nom", $nom);
        $query->bindParam(":taille", $taille);
        $query->bindParam(":prix_normale", $prixNormale);
        $query->bindParam(":prix_solde", $prixSolde);
        $query->bindParam(":image_url", $imageUrl); // Remplacez cette valeur par l'URL de l'image du matelas

        if ($query->execute()) {
            // La requête s'est bien déroulée, on redirige l'utilisateur vers la page d'accueil
            header("Location: index.php");
            exit(); // N'oubliez pas d'ajouter cette ligne pour arrêter l'exécution du script après la redirection
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un matelas</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body>
    <h1>Ajouter un matelas</h1>

    <!-- Lorsque l'attribut action est vide, les données du formulaire sont envoyées à la même page -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputMarque">Marque :</label>
            <input type="text" id="inputMarque" name="marque" value="<?= isset($marque) ? $marque : "" ?>">
        </div>
        <div class="form-group">
            <label for="inputNom">Nom :</label>
            <input type="text" id="inputNom" name="nom" value="<?= isset($nom) ? $nom : "" ?>">
        </div>
        <div class="form-group">
            <label for="inputTaille">Taille :</label>
            <input type="text" id="inputTaille" name="taille" value="<?= isset($taille) ? $taille : "" ?>">
        </div>
        <div class="form-group">
            <label for="inputPrixNormale">Prix normal :</label>
            <input type="number" name="prix_normale" id="inputPrixNormale" value="<?= isset($prixNormale) ? $prixNormale : "" ?>">
        </div>
        <div class="form-group">
            <label for="inputPrixSolde">Prix soldé :</label>
            <input type="number" name="prix_solde" id="inputPrixSolde" value="<?= isset($prixSolde) ? $prixSolde : "" ?>">
        </div>
        <div class="form-group">
            <label for="inputImage">Photo du matelas :</label>
            <input type="file" id="inputImage" name="image"> <!-- Remplacez le name par "image" pour gérer l'upload -->
            <!-- Affichage des erreurs -->
            <?php if (isset($error["picture"])) : ?>
                <span class="info-error"><?= $error["picture"] ?></span>
            <?php endif; ?>
        </div>
        <input type="submit" value="Ajouter le matelas" class="btn-literie3000" style="margin-top: 10px;">
    </form>

    <?php include("templates/footer.php"); ?>
</body>

</html>

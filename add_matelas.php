<?php


if (!empty($_POST)) {
    $dsn = "mysql:host=localhost;dbname=literie3000";
    $db = new PDO($dsn, "root", "");

    $marque = trim(strip_tags($_POST["marque"]));
    $nom = trim(strip_tags($_POST["nom"]));
    $taille = trim(strip_tags($_POST["taille"]));
    $prixNormale = trim(strip_tags($_POST["prix_normale"]));
    $prixSolde = trim(strip_tags($_POST["prix_solde"]));
    $imageUrl = ""; // Variable pour stocker le chemin de l'image après le téléchargement

    // Gestion de l'upload de l'image du matelas 
    if (!empty($_FILES['image']['tmp_name'])) {
        // Chemin où vous souhaitez enregistrer les images téléchargées
        $uploadDirectory = 'img/';

        // Obtenez le nom du fichier téléchargé
        $uploadedFileName = basename($_FILES['image']['name']);

        // Construisez le chemin complet où l'image sera enregistrée
        $targetPath = $uploadDirectory . $uploadedFileName;

        // Déplacez l'image téléchargée vers le répertoire cible
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            // Le téléchargement a réussi, mettez à jour la variable $imageUrl avec le chemin de l'image
            $imageUrl = $targetPath;
        } else {
            // Le téléchargement de l'image a échoué, vous pouvez gérer l'erreur ici si nécessaire
            $error["picture"] = "Erreur lors du téléchargement de l'image.";
        }
    }

    if (empty($marque) || empty($nom) || empty($taille) || empty($prixNormale) || empty($prixSolde)) {
        $error["fields"] = "Tous les champs sont obligatoires.";
    }

    // Requête d'insertion en BDD du matelas s'il n'y a aucune erreur
    if (empty($error)) {
        $query = $db->prepare("INSERT INTO matelas (marque, nom, taille, prix_normale, prix_solde, image_url)
                               VALUES (:marque, :nom, :taille, :prix_normale, :prix_solde, :image_url)");

        $query->bindParam(":marque", $marque);
        $query->bindParam(":nom", $nom);
        $query->bindParam(":taille", $taille);
        $query->bindParam(":prix_normale", $prixNormale);
        $query->bindParam(":prix_solde", $prixSolde);
        $query->bindParam(":image_url", $imageUrl); // Utilisation de la variable contenant le chemin de l'image

        if ($query->execute()) {
            // Redirection vers la page principale après l'ajout du matelas
            header("Location: index.php");
            exit();
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
            <input type="file" id="inputImage" name="image">
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

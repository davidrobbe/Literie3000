<?php
// Connexion à la base literie3000
$dsn = "mysql:host=localhost;dbname=literie3000";
$db = new PDO($dsn, "root", "");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idMatelas = $_GET['id'];

    // Requête de suppression du matelas avec l'identifiant spécifié
    $query = $db->prepare("DELETE FROM matelas WHERE id = :idMatelas");
    $query->bindParam(":idMatelas", $idMatelas);

    if ($query->execute()) {
        // Redirection vers la page principale après la suppression
        header("Location: index.php");
        exit();
    } else {
        // Gestion de l'erreur en cas d'échec de la suppression
        echo "Erreur lors de la suppression du matelas.";
    }
} else {
    // Gestion de l'erreur si l'identifiant du matelas est manquant ou invalide dans l'URL
    echo "Identifiant du matelas manquant ou invalide.";
}
?>

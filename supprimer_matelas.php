<?php

$dsn = "mysql:host=localhost;dbname=literie3000";
$db = new PDO($dsn, "root", "");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idMatelas = $_GET['id'];

    // Requête de suppression du matelas avec l'identifiant spécifié
    $query = $db->prepare("DELETE FROM matelas WHERE id = :idMatelas");
    $query->bindParam(":idMatelas", $idMatelas);

    if ($query->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de la suppression du matelas.";
    }
} else {
    echo "Identifiant du matelas manquant ou invalide.";
}
?>

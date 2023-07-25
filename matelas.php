<?php
function convertSecondsToMinutes($seconds) {
    return $seconds / 60;
}

$find = false;
$data = array("name" => "Matelas introuvable");
if (isset($_GET["id"])) {
    $dsn = "mysql:host=localhost;dbname=literie3000";
    $db = new PDO($dsn, "root", "");

    //1/ On prépare la requete SQL avec un parametre pour palier a l'injection SQL
    $query = $db->prepare("SELECT * FROM matelas WHERE id = :id");
    //2/ On donne des valeurs a nos parametres
    $query->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
    //3/ On execute notre requete préalablement préparée
    $query->execute();
    $matelas = $query->fetch(); // retourne un tableau associatif du matelas concerné ou false si pas de correspondance
    
    if ($matelas) {
        $find = true;

        $data = $matelas;
    }
}

// Inclure le template header
include("templates/header.php");
?>
<h1><?= $data["name"] ?></h1>
<?php
if ($find) {
?>
    <img src="<?= $data["image_url"] ?>" alt="<?= $data["nom"] ?>" class="matelas-picture">
    <p>Marque : <?= $data["marque"] ?></p>
    <p>Taille : <?= $data["taille"] ?></p>
    <p>Prix normal : <?= $data["prix_normale"] ?> €</p>
    <p>Prix soldé : <?= $data["prix_solde"] ?> €</p>
<?php
}

// Inclure le template footer
include("templates/footer.php");
?>

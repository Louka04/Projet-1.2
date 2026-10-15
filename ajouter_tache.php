
<?php

require_once "connexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titre = trim($_POST["titre"] ?? "");
    $categorie = $_POST["categorie"] ?? "";

    $categories = ["Travail", "Études", "Personnel"];

    if ($titre === "" || !in_array($categorie, $categories, true)) {
        die("Titre ou catégorie invalide.");
    }

    $sql = "INSERT INTO taches (titre, categorie)
            VALUES (:titre, :categorie)";

    $requete = $pdo->prepare($sql);

    $requete->execute([
        "titre" => $titre,
        "categorie" => $categorie
    ]);

    header("Location: accueil.php");
    exit;
}

header("Location: accueil.php");
exit;


<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: connect_screen.php");
    exit;
}

require_once "connexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titre = trim($_POST["titre"] ?? "");
    $categorie = $_POST["categorie"] ?? "";

    $categories = ["Travail", "Études", "Personnel"];

    if ($titre === "" || !in_array($categorie, $categories, true)) {
        die("Titre ou catégorie invalide.");
    }

    $sql = "INSERT INTO taches (titre, categorie, user_id)
            VALUES (:titre, :categorie, :user_id)";

    $requete = $pdo->prepare($sql);

    $requete->execute([
        "titre" => $titre,
        "categorie" => $categorie, 
        "user_id" => $SESSION["user_id"]
    ]);

    header("Location: accueil.php");
    exit;
}

header("Location: accueil.php");
exit;


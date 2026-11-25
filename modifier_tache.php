<?php

require_once "connexion.php";

if (isset($_POST["id"])) {
    $requete = $pdo->prepare("UPDATE taches SET titre = :titre, categorie  = :categorie WHERE id = :id");
    $requete->execute([
        "titre" => $_POST["titre"],
        "categorie" => $_POST["categorie"],
        "id" => $_POST["id"]
    ]);
}

header("Location: accueil.php");
exit;
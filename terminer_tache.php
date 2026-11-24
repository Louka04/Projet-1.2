<?php

require_once "connexion.php";

if (isset($_GET["id"])) {
    $requete = $pdo->prepare("UPDATE taches SET statut = 'terminee', date_fin = NOW() WHERE id = :id");
    $requete->execute(["id" => $_GET["id"]]);
}

header("Location: accueil.php");
exit;




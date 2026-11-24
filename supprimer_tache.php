<?php

require_once "connexion.php";

if (isset($_GET["id"])) {
    $requete = $pdo->prepare("DELETE FROM taches WHERE id = :id");
    $requete->execute(["id" => $_GET["id"]]);
}

header("Location: accueil.php");
exit;




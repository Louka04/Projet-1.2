<?php

session_start();

// if (isset($_SESSION["user_id"]) === true) {
//     header("Location: accueil.php");
//     exit;
// }

require_once "connexion.php";

if (isset($_COOKIE["jeton_souvenir"])) {
    $requete = $pdo->prepare("SELECT * FROM utilisateurs WHERE jeton_souvenir = :jeton_souvenir");
    $requete->execute(["jeton_souvenir" => $_COOKIE["jeton_souvenir"]]);
    $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
    if ($utilisateur !== false) {
        session_regenerate_id(true);
        $_SESSION["user_id"] = $utilisateur["id"];
        $_SESSION["user_name"] = $utilisateur["user_name"];
        header("Location: accueil.php");
        exit;
    }
}

$se_souvenir = false;
$erreurs = [];
$mail = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mail = trim($_POST["mail"] ?? "");
    $password = $_POST["password"] ?? "";
    $se_souvenir = isset($_POST["se_souvenir"]);

    if (empty($mail)) {
        $erreurs[] = "Veuillez saisir votre adresse mail";
    }
    if (empty($password)) {
        $erreurs[] = "Veuillez saisir votre mot de passe";
    }

    if (empty($erreurs)) {
        $requete = $pdo->prepare("SELECT * FROM utilisateurs WHERE mail = :mail");
        $requete->execute(["mail" => $mail]);
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur === false || !password_verify($password, $utilisateur["password"])) {
            $erreurs[] = "Mail ou mot de passe incorrect.";
        } else {
            if ($se_souvenir === true) {
                $jeton = bin2hex(random_bytes(32));
                $requete = $pdo->prepare("UPDATE utilisateurs SET jeton_souvenir = :jeton WHERE id = :id");
                $requete->execute([
                    "jeton" => $jeton,
                    "id" => $utilisateur["id"],
                ]);
                $optionCookie = [
                    // Date d'expiration : maintenant + 30 jours (60 s x 60 min x 24 h x 30 j)
                    "expires" => time() + 60 * 60 * 24 * 30,
                    // Le cookie est envoyé pour toutes les pages du site
                    "path" => "/",
                    // Le JavaScript de la page ne peut pas lire le cookie (protège contre le vol du jeton)
                    "httponly" => true,
                    // Les autres sites ne peuvent pas envoyer ce cookie à ta place
                    "samesite" => "Lax",
                ];

                setcookie("jeton_souvenir", $jeton, $optionCookie);
            }

            session_regenerate_id(true);
            $_SESSION["user_id"] = $utilisateur["id"];
            $_SESSION["user_name"] = $utilisateur["user_name"];
            header("Location: accueil.php");
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/connect.css">
    <link rel="icon" href="./img/Icon.png">
    <title>TaskHub Connection</title>
</head>

<body>
    <!-- Cote gauche présentation -->

    <section class="cote_gauche">
        <div class="Titre">
            <img src="./img/coche bleu.png" alt="Choche bleu">
            <h1 class="taskhub">Task<span class="hub">Hub</span></h1>
            <p>Organisez vos tâches, simplifiez votre contidien !</p>
        </div>

        <!-- LOGO -->

        <div class="logo">
            <img id="logo" src="./img/Interface connection.png" alt="Logo présentation">
        </div>

        <!-- PRESENTATION -->

        <div class="Presentation">
            <div>
                <img id="img1" src="./img/Choche bleu ronde.png" alt="Choche bleu ronde">
                <h4 id="txt1">Gérez</h4>
                <p id="p1">vos tâches facilement</p>
            </div>

            <div>
                <img id="img2" src="./img/Filtre.png" alt="Filtre">
                <h4 id="txt1">Organisez</h4>
                <p id="p2">par catégories et priorités</p>
            </div>

            <div>
                <img id="img3" src="./img/signal.png" alt="Signal">
                <h4 id="txt1">Progressez</h4>
                <p id="p3">jour après jour</p>
            </div>

        </div>

    </section>

    <!-- Cote droit connection -->

    <section class="cote_droit">
        <div class="cadre_formulaire">
            <div>
                <div class="titre">
                    <h3>Se connceter à</h3>
                    <h2 class="taskhub">Task<span class="hub">Hub</span></h2> <br>
                    <p>Heureux de vous revoir !</p>
                </div>

                <!-- FORMULAIRE CONNECTION -->
                <?php if (!empty($erreurs)) : ?>
                    <div class="erreur">
                        <?php foreach ($erreurs as $erreur): ?>
                            <p><?= htmlspecialchars($erreur) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="post" class="Formulaire">
                    <p>Adresse e-mail</p>
                    <div class="connect_container">
                        <img src="./img/Mail.png" alt="logo mail">
                        <input type="email" name="mail" id="mail" placeholder="exmple@domaine.fr" value="<?= htmlspecialchars($mail) ?>">
                    </div>
                    <p>Mot de passe</p>
                    <div class="connect_container">
                        <img src="./img/Cadenat.png" alt="logo mdp">
                        <input type="password" name="password" id="mdp" placeholder="Mot de passe">
                    </div>
                    <div class="checkbox">
                        <img src="./img/se-souvenir.svg" alt="logo se souvenir de moi">
                        <input type="checkbox" name="se_souvenir" id="checkbox">
                        <p>Se souvenir de moi dans ce navigateur ?</p>
                    </div>
                    <div class="connect">
                        <input type="submit" class="connect_div" name="connect" id="connect" value="Se connecter &#10132;">
                    </div>
                </form>
            </div>

            <!-- RREDIRECTION VERS PAGE CREATION COMPTE -->
            <div class="sign">
                <p id="separation">ou</p>
                <p>Pas de compte ?</p>
                <p><a href="./register.php" id="sign_lien">Inscrivez-vous</a> !</p>
            </div>
        </div>

    </section>
</body>

</html>
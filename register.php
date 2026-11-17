<?php
require_once "connexion.php";

$erreurs = [];
$user_name = "";
$mail = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST["password"] ?? "";
    $mail = trim($_POST["mail"] ?? "");
    $user_name = trim($_POST["user_name"] ?? "");

    if (mb_strlen($user_name) < 3 || mb_strlen($user_name) > 30) {
        $erreurs[] = "Le nom d'utilisateur doit contenir entre 3 et 30 caractères";
    }
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse e-mail n'est pas valide.";
    }
    if (mb_strlen($password) < 8) {
        $erreurs[] = "Votre mot de passe doit contenir au minimum 8 caractères";
    }
    if (empty($erreurs)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        try {
            $requete = $pdo->prepare(
                "INSERT INTO utilisateurs (user_name, mail, password)
                VALUES (:user_name, :mail, :password)"
            );
            $requete->execute([
                "user_name" => $user_name,
                "mail"      => $mail,
                "password"  => $hash
            ]);
            header("Location: connect_screen.php");
            exit;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                $erreurs[] = "Le nom d'utilisateur ou l'adresse mail est déjà utilisé";
            } else {
                throw $e;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/register.css">
    <link rel="icon" href="./img/Icon.png">
    <title>TaskHub - Page d'inscription</title>
</head>

<body>
    <main class="main_container">
        <div class="form_container">
            <div class="title_container">
                <img src="./img/coche bleu.png" alt="coche bleu">
                <h1 class="taskhub">Task<span class="hub">Hub</span></h1>
                <p>Devenez productif !</p>
            </div>
            <?php if (!empty($erreurs)) : ?>
                <div class="erreur">
                    <?php foreach ($erreurs as $erreur) : ?>
                        <p><?= htmlspecialchars($erreur) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="" method="POST" class="form">
                <div class="user_name_container">
                    <p>Entrez votre nom d'utilisateur :</p>
                    <div class="user_name">
                        <img src="./img/user-regular.png" alt="user-regular">
                        <input class="form_content" type="text" placeholder="Nom d'utilisateur" name="user_name" value="<?= htmlspecialchars($user_name) ?>">
                    </div>
                </div>
                <div class="mail_container">
                    <p>Entrez votre mail :</p>
                    <div class="mail">
                        <img src="./img/Mail.png" alt="logo mail">
                        <input class="form_content" type="email" name="mail" id="mail" placeholder="exemple@domaine.fr" value="<?= htmlspecialchars($mail) ?>">
                    </div>
                </div>
                <div class="password_container">
                    <p>Entrez votre mot de passe :</p>
                    <div class="password">
                        <img src="./img/Cadenat.png" alt="logo mdp">
                        <input class="form_content" type="password" name="password" id="mdp" placeholder="Mot de passe">
                    </div>
                </div>
                <div class="sign_container">
                    <input type="submit" value="Crée un compte &#10132;" id="sign_in" name="sign_in">
                </div>
            </form>

        </div>
    </main>
</body>

</html>
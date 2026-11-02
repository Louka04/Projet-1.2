<!DOCTYPE html>
<html lang="en">

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
            <form action="" class="form">
                <div class="user_name_container">
                    <p>Entrez votre nom d'utilisateur :</p>
                    <div class="user_name">
                        <img src="./img/user-regular.png" alt="user-regular">
                        <input type="text" placeholder="Nom d'utilisateur">
                    </div>
                </div>
                <div class="mail_container">
                    <p>Entrez votre mail :</p>
                    <div class="mail">
                        <img src="./img/Mail.png" alt="logo mail">
                        <input type="text" name="mail" id="mail" placeholder="exmple@domaine.fr">
                    </div>
                </div>
                <div class="password_container">
                    <p>Entrez votre mot de passe :</p>
                    <div class="password">
                        <img src="./img/Cadenat.png" alt="logo mdp">
                        <input type="text" name="mdp" id="mdp" placeholder="Mot de passe">
                    </div>
                </div>
            </form>
            <div class="sign_container">
                <input type="submit" value="Crée un compte &#10132;" id="sign_in" name="sign_in">
            </div>
        </div>
    </main>
</body>

</html>
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

                <form action="" class="Formulaire">
                    <p>Adresse e-mail</p>
                    <div class="connect_container">
                        <img src="./img/Mail.png" alt="logo mail">
                        <input type="text" name="mail" id="mail" placeholder="exmple@domaine.fr">
                    </div>
                    <p>Mot de passe</p>
                    <div class="connect_container">
                        <img src="./img/Cadenat.png" alt="logo mdp">
                        <input type="text" name="mdp" id="mdp" placeholder="Mot de passe">
                    </div>
                    <div class="connect">
                        <input type="submit" class="connect_div" name="se connecter" id="connect" value="Se connecter &#10132;">
                    </div>
                </form>
            </div>

            <!-- RREDIRECTION VERS PAGE CREATION COMPTE -->
            <div class="sign">
                <p>Pas de compte ?</p>
                <p><a href="" id="sign_lien">Inscrivez-vous</a> !</p>
            </div>
        </div>

    </section>
</body>

</html>
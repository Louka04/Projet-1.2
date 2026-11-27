<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: connect_screen.php");
    exit;
}

require_once "connexion.php";

$requete = $pdo->query("SELECT * FROM taches WHERE statut = 'en_cours'");
$taches = $requete->fetchAll();

$requete = $pdo->query("SELECT * FROM taches WHERE statut = 'terminee'");
$tachesTerminees = $requete->fetchAll();

$nbRestantes = count($taches);
$nbTerminees = count($tachesTerminees);
$nbTotal = $nbRestantes + $nbTerminees;

if ($nbTotal > 0) {
    $progression = round($nbTerminees * 100 / $nbTotal);
} else {
    $progression = 0;
}

if (isset($_GET["modifier"])) {
    $requete = $pdo->prepare("SELECT * FROM taches WHERE id = :id");
    $requete->execute(["id" => $_GET["modifier"]]);
    $tacheAModifier = $requete->fetch();
    }

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TASK-HUB</title>
    <link rel="stylesheet" href="./css/accueil.css">
    <link rel="icon" href="./img/Icon.png">
</head>

<body>

    <!-- MENU LATERAL -->
    <header>
        <h1>
            <span class="logo-icon">✓</span>
            <span>Task<span class="logo-blue">Hub</span></span>
        </h1>

        <nav>
            <a href="#">Tableau de bord</a>
            <a href="#">Mes tâches</a>
            <a href="#">Priorités</a>
        </nav>
    </header>

    <!-- CONTENU PRINCIPAL -->
    <main>

        <!-- PRESENTATION -->
        <section class="presentation">
            <div>
                <h2>Bonjour</h2>
                <p>Bienvenue sur votre espace de travail.</p>
            </div>

            <button type="button" onclick="document.getElementById('formulaire-tache').hidden = false">
                + Ajouter une tâche
            </button>
        </section>

        <!-- FORMULAIRE AJOUTER UNE TACHE -->
        <section id="formulaire-tache" hidden>
            <h2>Ajouter une nouvelle tâche</h2>

            <form action="ajouter_tache.php" method="POST">
                <div>
                    <label for="titre">Nom de la tâche</label>
                    <input type="text" id="titre" name="titre" placeholder="Ex : Réviser PHP" maxlength="255" required>
                </div>

                <div>
                    <label for="categorie">Catégorie</label>
                    <select id="categorie" name="categorie" required>
                        <option value="">Choisir une catégorie</option>
                        <option value="Travail">Travail</option>
                        <option value="Études">Études</option>
                        <option value="Personnel">Personnel</option>
                    </select>
                </div>

                <button type="submit">Enregistrer la tâche</button>
                <button type="button" onclick="document.getElementById('formulaire-tache').hidden = true">
                    Annuler
                </button>
            </form>
        </section>

        <?php if (isset($tacheAModifier)) { ?>
        <section id="formulaire-modifier">
        <h2>Modifier la tâche</h2>
        <form action="modifier_tache.php" method="POST">
        <input type="hidden" name="id" value="<?= $tacheAModifier["id"] ?>">

        <div>
            <label for="titre-modifier">Nom de la tâche</label>
            <input type="text" id="titre-modifier" name="titre" value="<?= htmlspecialchars($tacheAModifier["titre"]) ?>" maxlength="255" required>
        </div>

        <div>
            <label for="categorie-modifier">Catégorie</label>
            <select id="categorie-modifier" name="categorie" required>
                <option value="Travail" <?php if ($tacheAModifier["categorie"] == "Travail") { echo "selected"; } ?>>Travail</option>
                <option value="Études" <?php if ($tacheAModifier["categorie"] == "Études") { echo "selected"; } ?>>Études</option>
                <option value="Personnel" <?php if ($tacheAModifier["categorie"] == "Personnel") { echo "selected"; } ?>>Personnel</option>
            </select>
        </div>

        <button type="submit">Enregistrer les modifications</button>
        <button type="button" onclick="location.href='accueil.php'">Annuler</button>
    </form>
</section>
<?php } ?>


        <!-- TABLEAU DE BORD -->
        <section class="dashboard">
            <h2>Tableau de bord</h2>

            <div class="stats">
                <div class="card">
                    <h3>Total</h3>
                    <p><?= $nbTotal ?></p>
                </div>

                <div class="card">
                    <h3>Terminées</h3>
                    <p><?= $nbTerminees ?></p>
                </div>

                <div class="card">
                    <h3>Restantes</h3>
                    <p><?= $nbRestantes ?></p>
                </div>

                <div class="card">
                    <h3>Progression</h3>
                    <p><?= $progression ?> %</p>
                </div>
            </div>
        </section>

        <!-- RECHERCHE ET FILTRES -->
        <section class="filters">
            <h2>Mes tâches</h2>

            <div class="filter-bar">
                <input type="search" placeholder="🔍 Rechercher une tâche...">

                <button>Toutes</button>
                <button>En cours</button>
                <button>Terminées</button>

                <select>
                    <option>Toutes les catégories</option>
                    <option>Travail</option>
                    <option>Études</option>
                    <option>Personnel</option>
                </select>
            </div>
        </section>

        <!-- LISTE DES TACHES -->

        <section class="tasks">

    <?php foreach ($taches as $tache) { ?>
        <article class="task">
            <div>
                <h3><?= htmlspecialchars ($tache["titre"]) ?></h3>
                <p><?= htmlspecialchars ($tache["categorie"]) ?></p>
            </div>

            <div class="actions">
                <button onclick="if (confirm('Terminer cette tâche ?')) 
                { location.href='terminer_tache.php?id=<?= $tache["id"] ?>' }">Terminer</button>
                <button onclick="if (confirm('Voulez-vous modifier cette tâche ?'))
                { location.href='accueil.php?modifier=<?= $tache["id"] ?>' }">Modifier</button>
                <button onclick="if (confirm('Supprimer cette tâche ?')) 
                { location.href='supprimer_tache.php?id=<?= $tache["id"] ?>' }">Supprimer</button>
            </div>
        </article>
    <?php } ?>

</section>

        <!-- HISTORIQUE DES TACHES TERMINEES -->
        <section class="history">
            <h2>Historique</h2>
            <p class="history-description">Retrouvez ici vos tâches terminées.</p>

            <?php foreach ($tachesTerminees as $tache) { ?>
            <article class="history-task">
                <div class="history-check" aria-hidden="true">✓</div>

                <div class="history-details">
                    <h3><?= htmlspecialchars($tache["titre"]) ?></h3>
                    <p class="history-category"><?= htmlspecialchars($tache["categorie"]) ?></p>
                    <p class="history-date">
                        Terminée le
                        <time><?= date("d/m/Y à H:i", strtotime($tache["date_fin"])) ?></time>
                    </p>
                </div>

                <span class="history-status">Terminée</span>
            </article>
            <?php } ?>
        </section>

    </main>

</body>

</html>

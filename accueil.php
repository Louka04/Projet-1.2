
<?php
require_once "connexion.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TASK-HUB</title>

    <link rel="stylesheet" href="./css/accueil.css">
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

        <section class="presentation">    <!-- pour définir une section thématique d'un document , regroupe un ensemble de contenu lié par un même sujet ou une même fonctionnalité -->

            <div>

                <h2>Bonjour</h2>

                <p>
                    Bienvenue sur votre espace de travail.
                </p>

            </div>

            <button type="button"
                onclick="document.getElementById('formulaire-tache').hidden = false">
                + Ajouter une tâche
            </button>

        </section>

        
<!-- FORMULAIRE AJOUTER UNE TACHE -->

<section id="formulaire-tache" hidden>

    <h2>Ajouter une nouvelle tâche</h2>

    <form action="ajouter_tache.php" method="POST">

        <div>
            <label for="titre">Nom de la tâche</label>

            <input
                type="text"
                id="titre"
                name="titre"
                placeholder="Ex : Réviser PHP"
                maxlength="255"
                required
            >
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

        <button type="submit">
            Enregistrer la tâche
        </button>

        <button
            type="button"
            onclick="document.getElementById('formulaire-tache').hidden = true">
            Annuler
        </button>

    </form>

</section>



        <!-- TABLEAU DE BORD -->

        <section class="dashboard">

            <h2>Tableau de bord</h2>

            <div class="stats">

                <div class="card">

                    <h3>Total</h3>
                    <p>3</p>

                </div>

                <div class="card">

                    <h3>Terminées</h3>
                    <p>1</p>

                </div>

                <div class="card">

                    <h3>Restantes</h3>
                    <p>2</p>

                </div>

                <div class="card">

                    <h3>Progression</h3>
                    <p>33 %</p>

                </div>

            </div>

        </section>


        <!-- RECHERCHE ET FILTRES -->

        <section class="filters">

            <h2>Mes tâches</h2>

            <div class="filter-bar">

                <input
                    type="search"
                    placeholder="🔍 Rechercher une tâche..."
                >

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

            <article class="task">   <!-- représenter un contenu autonome et indépendant -->

                <div>

                    <h3>
                        Finaliser le projet TASK-HUB
                    </h3>

                    <p>
                        📚 Études
                    </p>

                </div>

                <div class="actions">

                    <button>Terminer</button>
                    <button>Modifier</button>
                    <button>Supprimer</button>

                </div>

            </article>


            <article class="task"> <!-- représenter un contenu autonome et indépendant -->

                <div>

                    <h3>
                        Créer le dépôt GitHub
                    </h3>

                    <p>
                        💼 Travail
                    </p>

                </div>

                <div class="actions">

                    <button>Terminer</button>
                    <button>Modifier</button>
                    <button>Supprimer</button>

                </div>

            </article> 

        </section>


        <!-- HISTORIQUE DES TACHES TERMINEES -->

        <section class="history">

            <h2>Historique</h2>

            <p class="history-description">
                Retrouvez ici vos tâches terminées.
            </p>

            <article class="history-task">

                <div class="history-check" aria-hidden="true">
                    ✓
                </div>

                <div class="history-details">

                    <h3>
                        Faire les courses
                    </h3>

                    <p class="history-category">
                        🏠 Personnel
                    </p>

                    <p class="history-date">

                        Terminée le

                        <time datetime="2026-10-13T10:11">
                            13 octobre 2026 à 10 h 11
                        </time>

                    </p>

                </div>

                <span class="history-status">
                    Terminée
                </span>

            </article>

        </section>

    </main>

</body>

</html>
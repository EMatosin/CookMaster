<?php
// Inclusion des fichiers requis
require_once 'bdd/db_connection.php';
require_once 'bdd/db_functions.php';

// Récupération des informations sur les cours à domicile depuis la base de données
$coursDomicile = getCoursDomicile();

// Vérification de la connexion de l'utilisateur
$loggedIn = false; // Mettez la variable à true si l'utilisateur est connecté

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Cours à domicile - Cookfusion</title>
</head>

<body>
    <!-- Inclusion du header -->
    <?php include 'includes/header-mainpages.php'; ?>

    <main>
        <section>
            <h2>Cours de cuisine à domicile</h2>
            <p>Profitez d'une expérience culinaire unique avec nos cours de cuisine à domicile. Nos chefs se rendront chez vous pour vous enseigner des recettes savoureuses.</p>
            <?php if ($loggedIn) : ?>
                <p>Bienvenue, utilisateur connecté !</p>
            <?php endif; ?>

            <div class="cours-container">
                <?php foreach ($coursDomicile as $cours) : ?>
                    <div class="cours">
                        <hr>
                        <h3><?php echo $cours['titre']; ?></h3>
                        <p><?php echo $cours['description']; ?></p>
                        <p>Durée : <?php echo $cours['duree']; ?> heures</p>
                        <p>Prix : <?php echo $cours['prix']; ?> €</p>
                        <?php if ($loggedIn) : ?>
                            <button class="btn">Réserver</button>
                        <?php else : ?>
                            <a href="login.php" class="btn">Se connecter pour réserver</a>
                        <?php endif; ?>
                        <hr>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <!-- Inclusion du footer -->
    <?php include 'includes/footer-mainpages.php'; ?>
</body>

</html>

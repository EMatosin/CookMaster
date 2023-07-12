<?php
// Inclusion des fichiers requis
require_once 'bdd/db_connection.php';
require_once 'bdd/db_functions.php';

// Récupération des informations sur la location de cuisine depuis la base de données
$locations = getLocationsCuisine();

// Vérification de la connexion de l'utilisateur
$loggedIn = false; // Mettez la variable à true si l'utilisateur est connecté

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Location de cuisine - Cookfusion</title>
</head>

<body>
    <!-- Inclusion du header -->
    <?php include 'includes/header-mainpages.php'; ?>

    <main>
        <section>
            <h2>Location d'espace de cuisine</h2>
            <p>Vous avez besoin d'un espace de cuisine pour vos événements ou vos ateliers ? Louez nos cuisines équipées et profitez d'un espace professionnel adapté à vos besoins.</p>
            <?php if ($loggedIn) : ?>
                <p>Bienvenue, utilisateur connecté !</p>
            <?php endif; ?>

            <div class="locations-container">
                <?php foreach ($locations as $location) : ?>
                    <div class="location">
                        <hr>
                        <h3><?php echo $location['titre']; ?></h3>
                        <p><?php echo $location['description']; ?></p>
                        <p>Capacité : <?php echo $location['capacite']; ?> personnes</p>
                        <p>Lieu : <?php echo $location['lieu']; ?></p>
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

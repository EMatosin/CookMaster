<?php
// Inclusion des fichiers requis
require_once 'bdd/db_connection.php';
require_once 'bdd/db_functions.php';

// Récupération de la liste des ateliers depuis la base de données
$ateliers = getAteliers();

// Vérification de la connexion de l'utilisateur
$loggedIn = false; // Mettez la variable à true si l'utilisateur est connecté

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Ateliers - Cookfusion</title>
</head>

<body>
    <!-- Inclusion du header -->
    <?php include 'includes/header-mainpages.php'; ?>

    <main>
        <section>
            <h2>Ateliers de cuisine</h2>
            <p>Découvrez nos ateliers de cuisine animés par des chefs passionnés. Apprenez de nouvelles recettes, techniques et astuces culinaires.</p>
            <?php if ($loggedIn) : ?>
                <p>Bienvenue, utilisateur connecté !</p>
            <?php endif; ?>

            <div class="ateliers-container">
                <hr>
                <?php foreach ($ateliers as $atelier) : ?>
                    <div class="atelier">
                        <h3><?php echo $atelier['titre']; ?></h3>
                        <p><?php echo $atelier['description']; ?></p>
                        <p>Date : <?php echo $atelier['date']; ?></p>
                        <p>Heure : <?php echo $atelier['heure']; ?></p>
                        <p>Lieu : <?php echo $atelier['lieu']; ?></p>
                        <p>Prix : <?php echo $atelier['prix']; ?> €</p>
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

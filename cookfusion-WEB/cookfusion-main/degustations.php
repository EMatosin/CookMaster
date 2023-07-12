<?php
// Inclusion des fichiers requis
require_once 'bdd/db_connection.php';
require_once 'bdd/db_functions.php';

// Récupération des informations sur les dégustations depuis la base de données
$degustations = getDegustations();

// Vérification de la connexion de l'utilisateur
$loggedIn = false; // Mettez la variable à true si l'utilisateur est connecté

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Dégustations - Cookfusion</title>
</head>

<body>
    <!-- Inclusion du header -->
    <?php include 'includes/header-mainpages.php'; ?>

    <main>
        <section>
            <h2>Dégustations de produits</h2>
            <p>Venez découvrir et déguster nos produits lors de nos séances de dégustation. Un moment convivial à ne pas manquer !</p>
            <?php if ($loggedIn) : ?>
                <p>Bienvenue, utilisateur connecté !</p>
            <?php endif; ?>

            <div class="degustations-container">
                <?php foreach ($degustations as $degustation) : ?>
                    <div class="degustation">
                        <hr>
                        <h3><?php echo $degustation['titre']; ?></h3>
                        <p><?php echo $degustation['description']; ?></p>
                        <p>Date : <?php echo $degustation['date']; ?></p>
                        <p>Lieu : <?php echo $degustation['lieu']; ?></p>
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

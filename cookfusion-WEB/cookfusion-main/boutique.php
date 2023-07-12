<?php
// Inclusion des fichiers requis
require_once 'bdd/db_connection.php';
require_once 'bdd/db_functions.php';

// Récupération des produits depuis la base de données
$produits = getProduits();

// Vérification de la connexion de l'utilisateur
$loggedIn = false; // Mettez la variable à true si l'utilisateur est connecté

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Boutique - Cookfusion</title>
</head>

<body>
    <!-- Inclusion du header -->
    <?php include 'includes/header-mainpages.php'; ?>

    <main>
        <section>
            <h2>Boutique en ligne</h2>
            <p>Découvrez notre sélection de produits de qualité pour la cuisine. Faites votre choix parmi notre large gamme d'ustensiles, d'ingrédients et d'accessoires culinaires.</p>
            <?php if ($loggedIn) : ?>
                <p>Bienvenue, utilisateur connecté !</p>
            <?php endif; ?>

            <div class="produits-container">
                <?php foreach ($produits as $produit) : ?>
                    <div class="produit">
                        <hr>
                        <img src="<?php echo $produit['image']; ?>" alt="<?php echo $produit['nom']; ?>" class="boutique-img">
                        <h3><?php echo $produit['nom']; ?></h3>
                        <p><?php echo $produit['description']; ?></p>
                        <p>Prix : <?php echo $produit['prix']; ?> €</p>
                        <?php if ($loggedIn) : ?>
                            <button class="btn">Ajouter au panier</button>
                        <?php else : ?>
                            <a href="login.php" class="btn">Se connecter pour acheter</a>
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

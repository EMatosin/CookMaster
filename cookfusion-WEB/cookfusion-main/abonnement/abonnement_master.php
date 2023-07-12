<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/img/Logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Devenez le chef de votre propre cuisine !">
    <title>Cookfusion | Accueil</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php include('../includes/header-secondpages.php'); ?>
<main class="abonnement-main">
    <section>
        <div class="abonnement-section-container">
            <div class="abonnement-section-text">
                <h1>Abonnement MASTER</h1>
                <ul class="abonnement-features">
                    <li>Pas de publicités dans le contenu</li>
                    <li>Commentaires et avis sur les cours disponibles</li>
                    <li>Accès illimité aux leçons</li>
                    <li>Accès au service de tchat avec un Chef</li>
                    <li>Réduction permanente de 5% sur la boutique</li>
                    <li>Livraison offerte sur la boutique</li>
                    <li>Accès au service de location d'espace de cuisine</li>
                    <li>Invitation à des événements exclusifs</li>
                    <li>Récompense de cooptation pour les nouveaux inscrits (Chèque cadeau de 5€ pour chaque nouvel inscrit + bonus de 3% du montant sur la première commande)</li>
                    <li>Bonus de renouvellement de l'abonnement (Réduction de 10% du montant de l'abonnement en cas de renouvellement)</li>
                </ul>
                <form method="POST" action="../process_principal/process_abonnement.php">
                    <input type="hidden" name="abonnement_type" value="MASTER">
                    <button type="submit" class="abonnement-btn">S'abonner</button>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include('../includes/footer-secondpages.php'); ?>
    </body>
</html> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/img/Logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Devenez le chef de votre propre cuisine !">
    <title>Cookfusion | Accueil</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php include('includes/header-mainpages.php'); ?>

    <main class="index-main">
        <section>
            <div class="index-section">
                <div class="index-section-text col-5">
                    <h1>Une nouvelle approche de la cuisine</h1>
                    <p class="index-p">Apprenez à cuisiner plus facilement et plus rapidement. Défiez les grands chefs!</p>
                    <button onclick="window.location.href = 'services.php';">Découvrir</button>
                </div>
            </div>
        </section>
        <hr>
        <section>
            <div class="index-section-container">
                <div class="index-section-text container">
                    <h1>Découvrez notre nouvelle application</h1>
                    <button onclick="window.location.href = 'services.php';">Découvrir</button>
                </div>
                <img src="assets/img/application-mobile.png" alt="logo" id="index-phone">
            </div>
        </section>

        <hr class="hr-container">

        <section>
            <div class="index-section-container">
                <div class="index-section-text container">
                    <h1>Nous vendons aussi du matériel !</h1>
                    <p class="index-p">Parce qu'un bon Chef n'est rien sans un bon matériel</p>
                    <button onclick="window.location.href = 'boutique.php';">Découvrir</button>
                </div>
                <img src="assets/img/ustensiles.png" alt="logo" id="index-tools">
            </div>
        </section>

        <hr class="hr-container">

        <section>
            <div class="index-section-table">
                <div>
                    <h1 class="centered">Que nous offrent les différents abonnements?</h1>
                </div>
                <div id="index-tableau">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Abonnement</th>
                                <th>Prix</th>
                                <th>Présence de publicités dans le contenu</th>
                                <th>Commenter, publier des avis (pour les cours uniquement)</th>
                                <th>Accès aux leçons</th>
                                <th>Accès au service de tchat avec un chef</th>
                                <th>Réduction permanente sur la boutique</th>
                                <th>Livraison gratuite sur la boutique</th>
                                <th>Accès au service de location d'espace de cuisine</th>
                                <th>Invitation à des événements exclusifs</th>
                                <th>Récompense cooptation nouvel inscrit</th>
                                <th>Bonus renouvellement de l'abonnement</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td><a href="abonnement/abonnement_free.php">FREE</a></td>
                                <td>(Gratuit)</td>
                                <td>Oui</td>
                                <td>Oui</td>
                                <td>1 par jour</td>
                                <td>Non</td>
                                <td>Non</td>
                                <td>Non</td>
                                <td>Non</td>
                                <td>Non</td>
                                <td>Non</td>
                                <td>Non</td>
                                </tr>
                            <tr>
                                <td></td>
                                <td><a href="abonnement/abonnement_starter.php">STARTER</a></td>
                                <td>9,90 €/mois<br>(113 €/an)</td>
                                <td>Non</td>
                                <td>Oui</td>
                                <td>5 par jour</td>
                                <td>Oui</td>
                                <td>Non</td>
                                <td>Non</td>
                                <td>Non</td>
                                <td>Oui</td>
                                <td>Non</td>
                                <td>Non</td>
                                </tr>
                            <tr>
                                <td></td>
                                <td><a href="abonnement/abonnement_master.php">MASTER</a></td>
                                <td>19 €/mois<br>(220 €/an)</td>
                                <td>Non</td>
                                <td>Oui</td>
                                <td>Illimité</td>
                                <td>Oui</td>
                                <td>Oui</td>
                                <td>Oui</td>
                                <td>Oui</td>
                                <td>Oui</td>
                                <td>Oui</td>
                                <td>Réduction de 10% du montant de l’abonnement en cas de renouvellement, valable uniquement sur le tarif annuel</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <hr>
    </main>

    <?php include('includes/footer-mainpages.php'); ?>
</body>
</html>

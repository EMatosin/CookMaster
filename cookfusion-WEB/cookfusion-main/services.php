<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/img/Logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Devenez le chef de votre propre cuisine !">
    <title>Cookfusion | Services</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php include('includes/header-mainpages.php'); ?>

    <main class="services-main">
        <section>
            <div class="services-section-container">
                <div class="services-section-text">
                    <h1>Nos services</h1>
                    <p>Découvrez les différents services que nous offrons pour vous aider à devenir un chef accompli :</p>
                </div>
                <br>
                <hr>
                <br>
                <div class="services-cards-container">
                    <div class="services-card">
                        <img src="assets/img/ateliers.jpg" alt="Ateliers de cuisine" class="services-img">
                        <div class="services-card-text">
                            <h2>Ateliers de cuisine</h2>
                            <p>Participez à nos ateliers de cuisine animés par des chefs renommés. Apprenez de nouvelles techniques et recettes.</p>
                            <button onclick="window.location.href = 'ateliers.php';">En savoir plus</button>
                        </div>
                    </div>
                    <div class="services-card">
                        <img src="assets/img/cours-domicile.jpg" alt="Cours de cuisine à domicile" class="services-img">
                        <div class="services-card-text">
                            <h2>Cours de cuisine à domicile</h2>
                            <p>Profitez de cours de cuisine personnalisés à votre domicile. Apprenez à cuisiner dans le confort de votre cuisine.</p>
                            <button onclick="window.location.href = 'cours-domicile.php';">En savoir plus</button>
                        </div>
                    </div>
                    <div class="services-card">
                        <img src="assets/img/degustations.jpg" alt="Dégustations de produits" class="services-img">
                        <div class="services-card-text">
                            <h2>Dégustations de produits</h2>
                            <p>Participez à nos dégustations de produits où vous pourrez découvrir et savourer des saveurs uniques.</p>
                            <button onclick="window.location.href = 'degustations.php';">En savoir plus</button>
                        </div>
                    </div>
                    <div class="services-card">
                        <img src="assets/img/location-cuisine.jpg" alt="Location d'espace de cuisine" class="services-img">
                        <div class="services-card-text">
                            <h2>Location d'espace de cuisine</h2>
                            <p>Louez notre espace de cuisine professionnel pour organiser vos propres événements culinaires.</p>
                            <button onclick="window.location.href = 'location-cuisine.php';">En savoir plus</button>
                        </div>
                    </div>
                    <div class="services-card">
                        <img src="assets/img/boutique.jpg" alt="Boutique en ligne" class="services-img">
                        <div class="services-card-text">
                            <h2>Boutique en ligne</h2>
                            <p>Découvrez notre sélection de produits de cuisine de haute qualité disponibles à l'achat en ligne.</p>
                            <button onclick="window.location.href = 'boutique.php';">En savoir plus</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include('includes/footer-mainpages.php'); ?>
</body>
</html>

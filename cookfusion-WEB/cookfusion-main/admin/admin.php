<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="../assets/img/Logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Devenez le chef de votre propre cuisine !">
    <title>Cookfusion | Espace d'administration</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php include('../includes/header-admin.php'); ?>
    <main class="admin-main">
        <section>
            <h2>Espace d'administration</h2>
            <div class="admin-options">
                <div class="admin-option">
                    <h3>Gestion des clients</h3>
                    <p>Gérez les comptes des clients, leurs abonnements, devis et factures.</p>
                    <a href="admin_clients.php" class="admin-btn">Accéder</a>
                </div>
                    <br>
                    <hr>
                    <br>
                <div class="admin-option">
                    <h3>Gestion des événements</h3>
                    <p>Gérez les événements tels que les ateliers, dégustations et cours à domicile.</p>
                    <a href="admin_evenements.php" class="admin-btn">Accéder</a>
                </div>
                    <br>
                    <hr>
                    <br>
                <div class="admin-option">
                    <h3>Gestion de la boutique</h3>
                    <p>Gérez les produits disponibles à la vente dans la boutique.</p>
                    <a href="admin_boutique.php" class="admin-btn">Accéder</a>
                </div>
                <!-- Ajoutez plus d'options de gestion ici -->
            </div>
        </section>
    </main>
    <?php include('../includes/footer-admin.php'); ?>
</body>
</html>

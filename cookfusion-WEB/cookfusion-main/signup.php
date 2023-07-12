<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/img/Logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Devenez le chef de votre propre cuisine !">
    <title>Cookfusion | Inscription</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php include('includes/header-mainpages.php'); ?>
    <main class="signup-main">
        <section class="signup-section-container">
            <div class="signup-section-text">
                <h1>Inscrivez-vous à Cookfusion</h1>
                <form action="process_principal/process_signup.php" method="POST">
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Adresse e-mail</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit">S'inscrire</button>
                </form>
                <br>
                <p>Déjà inscrit? <a href="login.php">Connectez-vous ici</a>.</p>
            </div>
            <img src="assets/img/Logo.png" alt="Image" id="signup-img" width="300" height="300">
        </section>
        <hr>
    </main>
    <?php include('includes/footer-mainpages.php'); ?>

    <?php
    // Vérifier si l'inscription a été effectuée avec succès
    if (isset($_GET['success']) && $_GET['success'] == 'true') {
        echo '<script>window.location.href = "login.php";</script>';
    }
    ?>

</body>
</html>

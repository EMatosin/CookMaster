<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/img/Logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Devenez le chef de votre propre cuisine !">
    <title>Cookfusion | Connexion Admin</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include('../includes/header-secondpages.php'); ?>
    <main class="login-main">
        <section class="login-section-container">
            <div class="login-section-text">
                <h1>Connexion Admin</h1>
                <form action="process_admin/process_admin_login.php" method="POST">
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit">Se connecter</button>
                </form>
            </div>
        </section>
    </main>
    <?php include('../includes/footer-secondpages.php'); ?>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/img/Logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Devenez le chef de votre propre cuisine !">
    <title>Cookfusion | Connexion</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php include('includes/header-mainpages.php'); ?>
    <main class="login-main">
        <section class="login-section-container">
            <div class="login-section-text">
                <h1>Connectez-vous à votre compte</h1>
                <form action="process_principal/process_login.php" method="POST">
                    <div class="form-group">
                        <label for="email">Adresse e-mail</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit">Se connecter</button>
                </form>
                <br>
                <p>Toujours pas de compte? <a href="signup.php">Cliquez ici</a> pour en créer un.</p>
            </div>
            <img src="assets/img/Logo.png" alt="Image" id="login-img" width="300" height="300">
        </section>
        <hr>
    </main>
    <?php include('includes/footer-mainpages.php'); ?>
</body>
</html>

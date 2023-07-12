<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contactez-nous | Cookfusion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include('includes/header-mainpages.php'); ?>
    <main class="index-main">
        <section>
            <div class="contact-section-container">
                <div class="contact-section-text">
                    <h1>Contactez-nous</h1>
                    <br>
                    <?php if (isset($successMessage)) { ?>
                        <p class="success-message"><?php echo $successMessage; ?></p>
                    <?php } ?>
                    <?php if (isset($errorMessage)) { ?>
                        <p class="error-message"><?php echo $errorMessage; ?></p>
                    <?php } ?>
                    <br>
                    <form method="POST" action="process_principal/process_contact.php">
                        <label for="name">Nom :</label>
                        <input type="text" id="name" name="name" required>
                        <br>
                        <br>
                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email" required>
                        <br>
                        <br>
                        <label for="message">Message :</label>
                        <textarea id="message" name="message" required></textarea>
                        <button type="submit">Envoyer</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <?php include('includes/footer-mainpages.php'); ?>
</body>
</html>

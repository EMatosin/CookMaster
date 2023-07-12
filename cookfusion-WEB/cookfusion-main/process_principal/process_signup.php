<?php
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Vérifier si l'utilisateur existe déjà dans la base de données
    $existingUser = get_user_by_email($email);

    if (!$existingUser) {
        // Hasher le mot de passe avant de l'enregistrer dans la base de données
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Enregistrer l'utilisateur dans la base de données
        $userId = create_user($name, $email, $hashedPassword);

        if ($userId) {
            // Rediriger vers la page de connexion avec un message de succès
            header("Location: login.php?signup=success");
            exit();
        }
    }
}

// En cas d'échec de l'inscription, rediriger vers la page d'inscription avec un message d'erreur
header("Location: signup.php?signup=error");
exit();
?>

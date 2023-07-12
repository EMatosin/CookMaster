<?php
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Vérifier les informations de connexion dans la base de données
    $user = get_user_by_email($email);

    if ($user && password_verify($password, $user["password"])) {
        // Générer un token bearer pour l'utilisateur
        $token = generate_token($user["id"]);

        // Enregistrer le token dans la base de données pour l'utilisateur
        save_token($user["id"], $token);

        // Rediriger vers la page d'accueil ou vers une autre page appropriée avec le token
        header("Location: ../index.php?token=" . urlencode($token));
        exit();
    }
}

// En cas d'échec de la connexion, rediriger vers la page de connexion
header("Location: ../login.php");
exit();
?>

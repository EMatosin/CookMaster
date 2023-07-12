<?php
// Vérification des informations d'identification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Vérification de l'identifiant et du mot de passe de l'administrateur
    if ($username == "admin" && $password == "admin_password") {
        // Effectuer les actions nécessaires en cas de succès de l'authentification
        
        // Redirection vers la page d'administration
        header("Location: ../admin.php");
        exit();
    } else {
        // Redirection vers la page de connexion en cas d'identifiants invalides
        header("Location: login_admin.php");
        exit();
    }
}
?>


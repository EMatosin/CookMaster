<?php
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userId"];
    $subscriptionType = $_POST["subscriptionType"];

    // Vérifier si l'utilisateur existe dans la base de données
    $existingUser = get_user_by_id($userId);

    if ($existingUser) {
        // Enregistrer l'abonnement dans la base de données
        $subscriptionId = create_subscription($userId, $subscriptionType);

        if ($subscriptionId) {
            // Rediriger vers la page de confirmation avec un message de succès
            header("Location: ../confirmation.php?subscription=success");
            exit();
        }
    }
}

// En cas d'échec de l'abonnement, rediriger vers la page d'abonnement avec un message d'erreur
header("Location: ../abonnement.php?subscription=error");
exit();
?>

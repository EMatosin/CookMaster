<?php
require_once("db_config.php");
require_once("db_connection.php");
require_once("db_functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userId"];
    $eventId = $_POST["eventId"];

    // Vérifier si l'utilisateur existe dans la base de données
    $existingUser = get_user_by_id($userId);

    // Vérifier si l'événement existe dans la base de données
    $existingEvent = get_event_by_id($eventId);

    if ($existingUser && $existingEvent) {
        // Enregistrer la réservation dans la base de données
        $reservationId = create_reservation($userId, $eventId);

        if ($reservationId) {
            // Rediriger vers la page de confirmation avec un message de succès
            header("Location: confirmation.php?reservation=success");
            exit();
        }
    }
}

// En cas d'échec de la réservation, rediriger vers la page de réservation avec un message d'erreur
header("Location: reservation.php?reservation=error");
exit();
?>

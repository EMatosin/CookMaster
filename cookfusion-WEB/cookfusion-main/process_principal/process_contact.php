<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Effectuer le traitement du formulaire de contact
    // Par exemple, envoyer un email à l'équipe de Cookfusion
    $to = "support@cookfusion.fr";
    $subject = "Nouveau message de contact";
    $body = "Nom: $name\n";
    $body .= "Email: $email\n";
    $body .= "Message:\n$message";

    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        $successMessage = "Votre message a été envoyé avec succès.";
    } else {
        $errorMessage = "Une erreur s'est produite lors de l'envoi du message.";
    }
}
?>

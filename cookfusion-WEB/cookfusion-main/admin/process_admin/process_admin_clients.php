<?php
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Traitement de l'ajout d'un client
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ajouter"])) {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];

    // Ajouter le client dans la base de données
    $result = add_client($nom, $email, $telephone);

    if ($result) {
        header("Location: admin_clients.php?message=Client ajouté avec succès");
        exit();
    } else {
        header("Location: admin_clients.php?error=Erreur lors de l'ajout du client");
        exit();
    }
}

// Traitement de la modification d'un client
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier"])) {
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];

    // Mettre à jour les informations du client dans la base de données
    $result = update_client($id, $nom, $email, $telephone);

    if ($result) {
        header("Location: admin_clients.php?message=Client modifié avec succès");
        exit();
    } else {
        header("Location: admin_clients.php?error=Erreur lors de la modification du client");
        exit();
    }
}

// Traitement de la suppression d'un client
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && isset($_GET["action"]) && $_GET["action"] == "supprimer") {
    $id = $_GET["id"];

    // Supprimer le client de la base de données
    $result = delete_client($id);

    if ($result) {
        header("Location: admin_clients.php?message=Client supprimé avec succès");
        exit();
    } else {
        header("Location: admin_clients.php?error=Erreur lors de la suppression du client");
        exit();
    }
}

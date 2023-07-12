<?php
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Traitement de l'ajout d'un abonnement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ajouter"])) {
    $nom = $_POST["nom"];
    $prix_mensuel = $_POST["prix_mensuel"];
    $prix_annuel = $_POST["prix_annuel"];
    $description = $_POST["description"];

    // Ajouter l'abonnement dans la base de données
    $result = add_abonnement($nom, $prix_mensuel, $prix_annuel, $description);

    if ($result) {
        header("Location: admin_abonnements.php?message=Abonnement ajouté avec succès");
        exit();
    } else {
        header("Location: admin_abonnements.php?error=Erreur lors de l'ajout de l'abonnement");
        exit();
    }
}

// Traitement de la modification d'un abonnement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier"])) {
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $prix_mensuel = $_POST["prix_mensuel"];
    $prix_annuel = $_POST["prix_annuel"];
    $description = $_POST["description"];

    // Mettre à jour les informations de l'abonnement dans la base de données
    $result = update_abonnement($id, $nom, $prix_mensuel, $prix_annuel, $description);

    if ($result) {
        header("Location: admin_abonnements.php?message=Abonnement modifié avec succès");
        exit();
    } else {
        header("Location: admin_abonnements.php?error=Erreur lors de la modification de l'abonnement");
        exit();
    }
}

// Traitement de la suppression d'un abonnement
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && isset($_GET["action"]) && $_GET["action"] == "supprimer") {
    $id = $_GET["id"];

    // Supprimer l'abonnement de la base de données
    $result = delete_abonnement($id);

    if ($result) {
        header("Location: admin_abonnements.php?message=Abonnement supprimé avec succès");
        exit();
    } else {
        header("Location: admin_abonnements.php?error=Erreur lors de la suppression de l'abonnement");
        exit();
    }
}

<?php
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Traitement de la création d'un devis ou d'une facture
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["creer"])) {
    $type = $_POST["type"];
    $client_id = $_POST["client_id"];
    $montant = $_POST["montant"];

    // Créer le devis ou la facture dans la base de données
    $result = create_devis_facture($type, $client_id, $montant);

    if ($result) {
        header("Location: admin_devis_factures.php?message=Devis/Facture créé avec succès");
        exit();
    } else {
        header("Location: admin_devis_factures.php?error=Erreur lors de la création du devis/facture");
        exit();
    }
}

// Traitement de la modification d'un devis ou d'une facture
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier"])) {
    $id = $_POST["id"];
    $type = $_POST["type"];
    $client_id = $_POST["client_id"];
    $montant = $_POST["montant"];

    // Mettre à jour le devis ou la facture dans la base de données
    $result = update_devis_facture($id, $type, $client_id, $montant);

    if ($result) {
        header("Location: admin_devis_factures.php?message=Devis/Facture modifié avec succès");
        exit();
    } else {
        header("Location: admin_devis_factures.php?error=Erreur lors de la modification du devis/facture");
        exit();
    }
}

// Traitement de la suppression d'un devis ou d'une facture
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && isset($_GET["action"]) && $_GET["action"] == "supprimer") {
    $id = $_GET["id"];

    // Supprimer le devis ou la facture de la base de données
    $result = delete_devis_facture($id);

    if ($result) {
        header("Location: admin_devis_factures.php?message=Devis/Facture supprimé avec succès");
        exit();
    } else {
        header("Location: admin_devis_factures.php?error=Erreur lors de la suppression du devis/facture");
        exit();
    }
}

<?php
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Vérifier l'action à effectuer
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    // Modifier une réservation
    if ($action === 'modifier') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $id = $_POST['id'];
            $etat = $_POST['etat'];
            
            // Valider et mettre à jour l'état de la réservation dans la base de données
            if (!empty($id) && !empty($etat)) {
                if (modifier_reservation($id, $etat)) {
                    header("Location: admin_reservations.php?message=Réservation modifiée avec succès.");
                    exit();
                } else {
                    header("Location: admin_reservations.php?error=Une erreur s'est produite lors de la modification de la réservation.");
                    exit();
                }
            } else {
                header("Location: admin_reservations.php?error=Tous les champs sont obligatoires.");
                exit();
            }
        } else {
            header("Location: admin_reservations.php");
            exit();
        }
    }
    
    // Supprimer une réservation
    if ($action === 'supprimer') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Supprimer la réservation de la base de données
            if (supprimer_reservation($id)) {
                header("Location: admin_reservations.php?message=Réservation supprimée avec succès.");
                exit();
            } else {
                header("Location: admin_reservations.php?error=Une erreur s'est produite lors de la suppression de la réservation.");
                exit();
            }
        } else {
            header("Location: admin_reservations.php");
            exit();
        }
    }
}

// Redirection en cas d'accès direct à ce fichier
header("Location: admin_reservations.php");
exit();

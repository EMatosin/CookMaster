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

    // Ajouter une planification
    if ($action === 'ajouter') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $titre = $_POST['titre'];
            $date_debut = $_POST['date_debut'];
            $date_fin = $_POST['date_fin'];
            $description = $_POST['description'];
            
            // Valider et ajouter la planification dans la base de données
            if (!empty($titre) && !empty($date_debut) && !empty($date_fin)) {
                if (ajouter_planification($titre, $date_debut, $date_fin, $description)) {
                    header("Location: admin_planification.php?message=Planification ajoutée avec succès.");
                    exit();
                } else {
                    header("Location: admin_planification.php?error=Une erreur s'est produite lors de l'ajout de la planification.");
                    exit();
                }
            } else {
                header("Location: admin_planification.php?error=Tous les champs obligatoires doivent être remplis.");
                exit();
            }
        } else {
            header("Location: admin_planification.php");
            exit();
        }
    }

    // Modifier une planification
    if ($action === 'modifier') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $id = $_POST['id'];
            $titre = $_POST['titre'];
            $date_debut = $_POST['date_debut'];
            $date_fin = $_POST['date_fin'];
            $description = $_POST['description'];
            
            // Valider et mettre à jour la planification dans la base de données
            if (!empty($id) && !empty($titre) && !empty($date_debut) && !empty($date_fin)) {
                if (modifier_planification($id, $titre, $date_debut, $date_fin, $description)) {
                    header("Location: admin_planification.php?message=Planification modifiée avec succès.");
                    exit();
                } else {
                    header("Location: admin_planification.php?error=Une erreur s'est produite lors de la modification de la planification.");
                    exit();
                }
            } else {
                header("Location: admin_planification.php?error=Tous les champs obligatoires doivent être remplis.");
                exit();
            }
        } else {
            header("Location: admin_planification.php");
            exit();
        }
    }

    // Supprimer une planification
    if ($action === 'supprimer') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Supprimer la planification de la base de données
            if (supprimer_planification($id)) {
                header("Location: admin_planification.php?message=Planification supprimée avec succès.");
                exit();
            } else {
                header("Location: admin_planification.php?error=Une erreur s'est produite lors de la suppression de la planification.");
                exit();
            }
        } else {
            header("Location: admin_planification.php");
            exit();
        }
    }
}

// Redirection en cas d'accès direct à ce fichier
header("Location: admin_planification.php");
exit();

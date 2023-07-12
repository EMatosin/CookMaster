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
    
    // Ajouter un nouvel événement
    if ($action === 'ajouter') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $date = $_POST['date'];
            $description = $_POST['description'];
            
            // Valider et insérer les données dans la base de données
            if (!empty($nom) && !empty($date) && !empty($description)) {
                if (ajouter_evenement($nom, $date, $description)) {
                    header("Location: admin_evenements.php?message=Evenement ajouté avec succès.");
                    exit();
                } else {
                    header("Location: admin_evenements.php?error=Une erreur s'est produite lors de l'ajout de l'événement.");
                    exit();
                }
            } else {
                header("Location: admin_evenements.php?error=Tous les champs sont obligatoires.");
                exit();
            }
        } else {
            header("Location: admin_evenements.php");
            exit();
        }
    }
    
    // Modifier un événement existant
    if ($action === 'modifier') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $date = $_POST['date'];
            $description = $_POST['description'];
            
            // Valider et mettre à jour les données dans la base de données
            if (!empty($id) && !empty($nom) && !empty($date) && !empty($description)) {
                if (modifier_evenement($id, $nom, $date, $description)) {
                    header("Location: admin_evenements.php?message=Evenement modifié avec succès.");
                    exit();
                } else {
                    header("Location: admin_evenements.php?error=Une erreur s'est produite lors de la modification de l'événement.");
                    exit();
                }
            } else {
                header("Location: admin_evenements.php?error=Tous les champs sont obligatoires.");
                exit();
            }
        } else {
            header("Location: admin_evenements.php");
            exit();
        }
    }
    
    // Supprimer un événement
    if ($action === 'supprimer') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Supprimer l'événement de la base de données
            if (supprimer_evenement($id)) {
                header("Location: admin_evenements.php?message=Evenement supprimé avec succès.");
                exit();
            } else {
                header("Location: admin_evenements.php?error=Une erreur s'est produite lors de la suppression de l'événement.");
                exit();
            }
        } else {
            header("Location: admin_evenements.php");
            exit();
        }
    }
}

// Redirection en cas d'accès direct à ce fichier
header("Location: admin_evenements.php");
exit();

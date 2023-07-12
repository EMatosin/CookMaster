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

    // Ajouter un service au catalogue
    if ($action === 'ajouter') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            
            // Valider et ajouter le service au catalogue dans la base de données
            if (!empty($nom)) {
                if (ajouter_service_catalogue($nom, $description)) {
                    header("Location: admin_catalogue_services.php?message=Service ajouté avec succès.");
                    exit();
                } else {
                    header("Location: admin_catalogue_services.php?error=Une erreur s'est produite lors de l'ajout du service au catalogue.");
                    exit();
                }
            } else {
                header("Location: admin_catalogue_services.php?error=Tous les champs obligatoires doivent être remplis.");
                exit();
            }
        } else {
            header("Location: admin_catalogue_services.php");
            exit();
        }
    }

    // Modifier un service du catalogue
    if ($action === 'modifier') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            
            // Valider et mettre à jour le service du catalogue dans la base de données
            if (!empty($id) && !empty($nom)) {
                if (modifier_service_catalogue($id, $nom, $description)) {
                    header("Location: admin_catalogue_services.php?message=Service modifié avec succès.");
                    exit();
                } else {
                    header("Location: admin_catalogue_services.php?error=Une erreur s'est produite lors de la modification du service du catalogue.");
                    exit();
                }
            } else {
                header("Location: admin_catalogue_services.php?error=Tous les champs obligatoires doivent être remplis.");
                exit();
            }
        } else {
            header("Location: admin_catalogue_services.php");
            exit();
        }
    }

    // Supprimer un service du catalogue
    if ($action === 'supprimer') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Supprimer le service du catalogue de la base de données
            if (supprimer_service_catalogue($id)) {
                header("Location: admin_catalogue_services.php?message=Service supprimé avec succès.");
                exit();
            } else {
                header("Location: admin_catalogue_services.php?error=Une erreur s'est produite lors de la suppression du service du catalogue.");
                exit();
            }
        } else {
            header("Location: admin_catalogue_services.php");
            exit();
        }
    }
}

// Redirection en cas d'accès direct à ce fichier
header("Location: admin_catalogue_services.php");
exit();

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

    // Ajouter une location d'espace de cuisine
    if ($action === 'ajouter') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $adresse = $_POST['adresse'];
            $capacite = $_POST['capacite'];
            
            // Valider et ajouter la location d'espace de cuisine dans la base de données
            if (!empty($nom) && !empty($adresse) && !empty($capacite)) {
                if (ajouter_location_cuisine($nom, $adresse, $capacite)) {
                    header("Location: admin_location_cuisine.php?message=Location d'espace de cuisine ajoutée avec succès.");
                    exit();
                } else {
                    header("Location: admin_location_cuisine.php?error=Une erreur s'est produite lors de l'ajout de la location d'espace de cuisine.");
                    exit();
                }
            } else {
                header("Location: admin_location_cuisine.php?error=Tous les champs obligatoires doivent être remplis.");
                exit();
            }
        } else {
            header("Location: admin_location_cuisine.php");
            exit();
        }
    }

    // Modifier une location d'espace de cuisine
    if ($action === 'modifier') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $adresse = $_POST['adresse'];
            $capacite = $_POST['capacite'];
            
            // Valider et mettre à jour la location d'espace de cuisine dans la base de données
            if (!empty($id) && !empty($nom) && !empty($adresse) && !empty($capacite)) {
                if (modifier_location_cuisine($id, $nom, $adresse, $capacite)) {
                    header("Location: admin_location_cuisine.php?message=Location d'espace de cuisine modifiée avec succès.");
                    exit();
                } else {
                    header("Location: admin_location_cuisine.php?error=Une erreur s'est produite lors de la modification de la location d'espace de cuisine.");
                    exit();
                }
            } else {
                header("Location: admin_location_cuisine.php?error=Tous les champs obligatoires doivent être remplis.");
                exit();
            }
        } else {
            header("Location: admin_location_cuisine.php");
            exit();
        }
    }

    // Supprimer une location d'espace de cuisine
    if ($action === 'supprimer') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Supprimer la location d'espace de cuisine de la base de données
            if (supprimer_location_cuisine($id)) {
                header("Location: admin_location_cuisine.php?message=Location d'espace de cuisine supprimée avec succès.");
                exit();
            } else {
                header("Location: admin_location_cuisine.php?error=Une erreur s'est produite lors de la suppression de la location d'espace de cuisine.");
                exit();
            }
        } else {
            header("Location: admin_location_cuisine.php");
            exit();
        }
    }
}

// Redirection en cas d'accès direct à ce fichier
header("Location: admin_location_cuisine.php");
exit();

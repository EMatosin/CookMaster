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

    // Ajouter une salle
    if ($action === 'ajouter') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $capacite = $_POST['capacite'];
            
            // Valider et ajouter la salle dans la base de données
            if (!empty($nom) && !empty($capacite)) {
                if (ajouter_salle($nom, $capacite)) {
                    header("Location: admin_salle.php?message=Salle ajoutée avec succès.");
                    exit();
                } else {
                    header("Location: admin_salle.php?error=Une erreur s'est produite lors de l'ajout de la salle.");
                    exit();
                }
            } else {
                header("Location: admin_salle.php?error=Tous les champs obligatoires doivent être remplis.");
                exit();
            }
        } else {
            header("Location: admin_salle.php");
            exit();
        }
    }

    // Modifier une salle
    if ($action === 'modifier') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $capacite = $_POST['capacite'];
            
            // Valider et mettre à jour la salle dans la base de données
            if (!empty($id) && !empty($nom) && !empty($capacite)) {
                if (modifier_salle($id, $nom, $capacite)) {
                    header("Location: admin_salle.php?message=Salle modifiée avec succès.");
                    exit();
                } else {
                    header("Location: admin_salle.php?error=Une erreur s'est produite lors de la modification de la salle.");
                    exit();
                }
            } else {
                header("Location: admin_salle.php?error=Tous les champs obligatoires doivent être remplis.");
                exit();
            }
        } else {
            header("Location: admin_salle.php");
            exit();
        }
    }

    // Supprimer une salle
    if ($action === 'supprimer') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Supprimer la salle de la base de données
            if (supprimer_salle($id)) {
                header("Location: admin_salle.php?message=Salle supprimée avec succès.");
                exit();
            } else {
                header("Location: admin_salle.php?error=Une erreur s'est produite lors de la suppression de la salle.");
                exit();
            }
        } else {
            header("Location: admin_salle.php");
            exit();
        }
    }
}

// Redirection en cas d'accès direct à ce fichier
header("Location: admin_salle.php");
exit();

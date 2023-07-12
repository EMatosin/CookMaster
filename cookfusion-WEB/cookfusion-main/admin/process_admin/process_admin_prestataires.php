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

    // Ajouter un prestataire
    if ($action === 'ajouter') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];
            
            // Valider et ajouter le prestataire dans la base de données
            if (!empty($nom) && !empty($email)) {
                if (ajouter_prestataire($nom, $email, $telephone)) {
                    header("Location: admin_prestataires.php?message=Prestataire ajouté avec succès.");
                    exit();
                } else {
                    header("Location: admin_prestataires.php?error=Une erreur s'est produite lors de l'ajout du prestataire.");
                    exit();
                }
            } else {
                header("Location: admin_prestataires.php?error=Tous les champs obligatoires doivent être remplis.");
                exit();
            }
        } else {
            header("Location: admin_prestataires.php");
            exit();
        }
    }

    // Modifier un prestataire
    if ($action === 'modifier') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];
            
            // Valider et mettre à jour le prestataire dans la base de données
            if (!empty($id) && !empty($nom) && !empty($email)) {
                if (modifier_prestataire($id, $nom, $email, $telephone)) {
                    header("Location: admin_prestataires.php?message=Prestataire modifié avec succès.");
                    exit();
                } else {
                    header("Location: admin_prestataires.php?error=Une erreur s'est produite lors de la modification du prestataire.");
                    exit();
                }
            } else {
                header("Location: admin_prestataires.php?error=Tous les champs obligatoires doivent être remplis.");
                exit();
            }
        } else {
            header("Location: admin_prestataires.php");
            exit();
        }
    }

    // Supprimer un prestataire
    if ($action === 'supprimer') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Supprimer le prestataire de la base de données
            if (supprimer_prestataire($id)) {
                header("Location: admin_prestataires.php?message=Prestataire supprimé avec succès.");
                exit();
            } else {
                header("Location: admin_prestataires.php?error=Une erreur s'est produite lors de la suppression du prestataire.");
                exit();
            }
        } else {
            header("Location: admin_prestataires.php");
            exit();
        }
    }
}

// Redirection en cas d'accès direct à ce fichier
header("Location: admin_prestataires.php");
exit();

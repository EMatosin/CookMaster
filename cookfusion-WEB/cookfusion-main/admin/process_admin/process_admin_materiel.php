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

    // Ajouter du matériel
    if ($action === 'ajouter') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $quantite = $_POST['quantite'];
            
            // Valider et ajouter le matériel dans la base de données
            if (!empty($nom) && !empty($quantite)) {
                if (ajouter_materiel($nom, $quantite)) {
                    header("Location: admin_materiel.php?message=Matériel ajouté avec succès.");
                    exit();
                } else {
                    header("Location: admin_materiel.php?error=Une erreur s'est produite lors de l'ajout du matériel.");
                    exit();
                }
            } else {
                header("Location: admin_materiel.php?error=Tous les champs obligatoires doivent être remplis.");
                exit();
            }
        } else {
            header("Location: admin_materiel.php");
            exit();
        }
    }

    // Modifier du matériel
    if ($action === 'modifier') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $quantite = $_POST['quantite'];
            
            // Valider et mettre à jour le matériel dans la base de données
            if (!empty($id) && !empty($nom) && !empty($quantite)) {
                if (modifier_materiel($id, $nom, $quantite)) {
                    header("Location: admin_materiel.php?message=Matériel modifié avec succès.");
                    exit();
                } else {
                    header("Location: admin_materiel.php?error=Une erreur s'est produite lors de la modification du matériel.");
                    exit();
                }
            } else {
                header("Location: admin_materiel.php?error=Tous les champs obligatoires doivent être remplis.");
                exit();
            }
        } else {
            header("Location: admin_materiel.php");
            exit();
        }
    }

    // Supprimer du matériel
    if ($action === 'supprimer') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Supprimer le matériel de la base de données
            if (supprimer_materiel($id)) {
                header("Location: admin_materiel.php?message=Matériel supprimé avec succès.");
                exit();
            } else {
                header("Location: admin_materiel.php?error=Une erreur s'est produite lors de la suppression du matériel.");
                exit();
            }
        } else {
            header("Location: admin_materiel.php");
            exit();
        }
    }
}

// Redirection en cas d'accès direct à ce fichier
header("Location: admin_materiel.php");
exit();

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

    // Ajouter une vente de produit
    if ($action === 'ajouter') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $prix = $_POST['prix'];
            $description = $_POST['description'];
            
            // Valider et ajouter la vente de produit dans la base de données
            if (!empty($nom) && !empty($prix)) {
                if (ajouter_vente_produit($nom, $prix, $description)) {
                    header("Location: admin_ventes_produits.php?message=Vente de produit ajoutée avec succès.");
                    exit();
                } else {
                    header("Location: admin_ventes_produits.php?error=Une erreur s'est produite lors de l'ajout de la vente de produit.");
                    exit();
                }
            } else {
                header("Location: admin_ventes_produits.php?error=Tous les champs obligatoires doivent être remplis.");
                exit();
            }
        } else {
            header("Location: admin_ventes_produits.php");
            exit();
        }
    }

    // Modifier une vente de produit
    if ($action === 'modifier') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $prix = $_POST['prix'];
            $description = $_POST['description'];
            
            // Valider et mettre à jour la vente de produit dans la base de données
            if (!empty($id) && !empty($nom) && !empty($prix)) {
                if (modifier_vente_produit($id, $nom, $prix, $description)) {
                    header("Location: admin_ventes_produits.php?message=Vente de produit modifiée avec succès.");
                    exit();
                } else {
                    header("Location: admin_ventes_produits.php?error=Une erreur s'est produite lors de la modification de la vente de produit.");
                    exit();
                }
            } else {
                header("Location: admin_ventes_produits.php?error=Tous les champs obligatoires doivent être remplis.");
                exit();
            }
        } else {
            header("Location: admin_ventes_produits.php");
            exit();
        }
    }

    // Supprimer une vente de produit
    if ($action === 'supprimer') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Supprimer la vente de produit de la base de données
            if (supprimer_vente_produit($id)) {
                header("Location: admin_ventes_produits.php?message=Vente de produit supprimée avec succès.");
                exit();
            } else {
                header("Location: admin_ventes_produits.php?error=Une erreur s'est produite lors de la suppression de la vente de produit.");
                exit();
            }
        } else {
            header("Location: admin_ventes_produits.php");
            exit();
        }
    }
}

// Redirection en cas d'accès direct à ce fichier
header("Location: admin_ventes_produits.php");
exit();

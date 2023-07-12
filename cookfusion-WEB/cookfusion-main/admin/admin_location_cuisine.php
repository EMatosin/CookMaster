<?
require_once("../includes/header-admin.php");
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");
require_once("process_admin/process_admin_location_cuisine.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Récupérer la liste des locations d'espace de cuisine
$locations = get_locations_cuisine();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion de la location d'espace de cuisine | Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include('header-admin.php'); ?>

    <h1>Gestion de la location d'espace de cuisine</h1>

    <!-- Afficher les messages ou erreurs -->
    <?php if (isset($_GET['message'])) { ?>
        <p class="success-message"><?php echo $_GET['message']; ?></p>
    <?php } ?>
    <?php if (isset($_GET['error'])) { ?>
        <p class="error-message"><?php echo $_GET['error']; ?></p>
    <?php } ?>

    <a href="admin_location_cuisine_ajouter.php">Ajouter une nouvelle location d'espace de cuisine</a>

    <?php if (count($locations) > 0) { ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($locations as $location) { ?>
                <tr>
                    <td><?php echo $location['id']; ?></td>
                    <td><?php echo $location['nom']; ?></td>
                    <td><?php echo $location['description']; ?></td>
                    <td><?php echo $location['adresse']; ?></td>
                    <td>
                        <a href="process_admin/process_admin_location_cuisine.php?action=modifier&id=<?php echo $location['id']; ?>">Modifier</a>

                        <a href="process_admin/process_admin_location_cuisine.php?action=supprimer&id=<?php echo $location['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>Aucune location d'espace de cuisine disponible.</p>
    <?php } ?>

    <?php require_once("../includes/footer-admin.php"); ?>
</body>
</html>

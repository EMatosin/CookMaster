<?php
require_once("../includes/header-admin.php");
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");
require_once("../process_admin/process_admin_catalogue_services.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Récupérer la liste des services depuis la base de données
$services = get_all_services();

?>

<div class="admin-container">
    <h2>Gestion du catalogue des services</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service) { ?>
                <tr>
                    <td><?php echo $service['id']; ?></td>
                    <td><?php echo $service['titre']; ?></td>
                    <td><?php echo $service['description']; ?></td>
                    <td><?php echo $service['prix']; ?></td>
                    <td>
                        <a href="process_admin/process_admin_catalogue_services.php?action=modifier&id=<?php echo $service['id']; ?>">Modifier</a>

                        <a href="process_admin/process_admin_catalogue_services.php?action=supprimer&id=<?php echo $service['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once("../includes/footer-admin.php"); ?>

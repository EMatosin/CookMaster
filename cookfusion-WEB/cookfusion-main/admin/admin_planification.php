<?php
require_once("../includes/header-admin.php");
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");
require_once("process_admin/process_admin_planification.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Récupérer la liste des événements planifiés depuis la base de données
$events = get_all_events();

?>

<div class="admin-container">
    <h2>Gestion de la planification</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Lieu</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event) { ?>
                <tr>
                    <td><?php echo $event['id']; ?></td>
                    <td><?php echo $event['type']; ?></td>
                    <td><?php echo $event['date']; ?></td>
                    <td><?php echo $event['heure']; ?></td>
                    <td><?php echo $event['lieu']; ?></td>
                    <td>
                        <a href="process_admin/process_admin_planification.php?action=modifier&id=<?php echo $planification['id']; ?>">Modifier</a>

                        <a href="process_admin/process_admin_planification.php?action=supprimer&id=<?php echo $planification['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once("../includes/footer-admin.php"); ?>

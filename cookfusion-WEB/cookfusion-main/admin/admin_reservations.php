<?php
require_once("../includes/header-admin.php");
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");
require_once("process_admin/process_admin_reservatons.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Récupérer la liste des réservations depuis la base de données
$reservations = get_all_reservations();

?>

<div class="admin-container">
    <h2>Gestion des réservations</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Evénement</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation) { ?>
                <tr>
                    <td><?php echo $reservation['id']; ?></td>
                    <td><?php echo $reservation['client']; ?></td>
                    <td><?php echo $reservation['evenement']; ?></td>
                    <td><?php echo $reservation['date']; ?></td>
                    <td><?php echo $reservation['statut']; ?></td>
                    <td>
                        <a href="process_admin/process_admin_reservations.php?action=modifier&id=<?php echo $reservation['id']; ?>">Modifier</a>

                        <a href="process_admin/process_admin_reservations.php?action=supprimer&id=<?php echo $reservation['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once("../includes/footer-admin.php"); ?>

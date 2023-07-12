<?php
require_once("../includes/header-admin.php");
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");
require_once("process_admin/process_admin_evenements.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Récupérer la liste des événements depuis la base de données
$evenements = get_all_evenements();

?>

<div class="admin-container">
    <h2>Gestion des événements</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Emplacement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($evenements as $evenement) { ?>
                <tr>
                    <td><?php echo $evenement['id']; ?></td>
                    <td><?php echo $evenement['nom']; ?></td>
                    <td><?php echo $evenement['date']; ?></td>
                    <td><?php echo $evenement['heure']; ?></td>
                    <td><?php echo $evenement['emplacement']; ?></td>
                    <td>
                        <a href="process_admin/process_admin_evenements.php?action=modifier&id=<?php echo $evenement['id']; ?>">Modifier</a>

                        <a href="process_admin/process_admin_evenements.php?action=supprimer&id=<?php echo $evenement['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once("../includes/footer-admin.php"); ?>

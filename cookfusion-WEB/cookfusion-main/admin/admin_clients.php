<?php
require_once("../includes/header-admin.php");
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");
require_once("process_admin/process_admin_clients.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Récupérer la liste des clients depuis la base de données
$clients = get_all_clients();

?>

<div class="admin-container">
    <h2>Gestion des clients</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client) { ?>
                <tr>
                    <td><?php echo $client['id']; ?></td>
                    <td><?php echo $client['nom']; ?></td>
                    <td><?php echo $client['email']; ?></td>
                    <td>
                        <a href="process_admin/process_admin_clients.php?action=modifier&id=<?php echo $client['id']; ?>">Modifier</a>

                        <a href="process_admin/process_admin_clients.php?action=supprimer&id=<?php echo $client['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once("../includes/footer-admin.php"); ?>

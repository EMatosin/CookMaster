<?php
require_once("../includes/header-admin.php");
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");
require_once("process_admin/process_admin_salle.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Récupérer la liste des salles depuis la base de données
$salles = get_all_salles();

?>

<div class="admin-container">
    <h2>Gestion des salles</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Capacité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salles as $salle) { ?>
                <tr>
                    <td><?php echo $salle['id']; ?></td>
                    <td><?php echo $salle['nom']; ?></td>
                    <td><?php echo $salle['description']; ?></td>
                    <td><?php echo $salle['capacite']; ?></td>
                    <td>
                        <a href="process_admin/process_admin_salle.php?action=modifier&id=<?php echo $salle['id']; ?>">Modifier</a>

                        <a href="process_admin/process_admin_salle.php?action=supprimer&id=<?php echo $salle['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once("../includes/footer-admin.php"); ?>

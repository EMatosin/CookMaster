<?php
require_once("../includes/header-admin.php");
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");
require_once("process_admin/process_admin_materiel.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Récupérer la liste du matériel depuis la base de données
$materiels = get_all_materiels();

?>

<div class="admin-container">
    <h2>Gestion du matériel</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Quantité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materiels as $materiel) { ?>
                <tr>
                    <td><?php echo $materiel['id']; ?></td>
                    <td><?php echo $materiel['nom']; ?></td>
                    <td><?php echo $materiel['description']; ?></td>
                    <td><?php echo $materiel['quantite']; ?></td>
                    <td>
                        <a href="process_admin/process_admin_materiel.php?action=modifier&id=<?php echo $materiel['id']; ?>">Modifier</a>

                        <a href="process_admin/process_admin_materiel.php?action=supprimer&id=<?php echo $materiel['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once("../includes/footer-admin.php"); ?>

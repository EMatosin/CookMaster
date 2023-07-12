<?php
require_once("../includes/header-admin.php");
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");
require_once("../process_admin/process_admin_abonnements.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Récupérer la liste des abonnements depuis la base de données
$abonnements = get_all_abonnements();

?>

<div class="admin-container">
    <h2>Gestion des abonnements</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($abonnements as $abonnement) { ?>
                <tr>
                    <td><?php echo $abonnement['id']; ?></td>
                    <td><?php echo $abonnement['nom']; ?></td>
                    <td><?php echo $abonnement['prix']; ?></td>
                    <td>
                        <a href="process_admin/process_admin_abonnements.php?action=modifier&id=<?php echo $abonnement['id']; ?>">Modifier</a>

                        <a href="process_admin/process_admin_abonnements.php?action=supprimer&id=<?php echo $abonnement['id']; ?>">Supprimer</a>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once("../includes/footer-admin.php"); ?>

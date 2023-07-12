<?php
require_once("../includes/header-admin.php");
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");
require_once("process_admin/process_admin_devis_factures.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Récupérer la liste des devis et factures depuis la base de données
$devisFactures = get_all_devis_factures();

?>

<div class="admin-container">
    <h2>Gestion des devis et factures</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Client</th>
                <th>Date</th>
                <th>Montant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devisFactures as $devisFacture) { ?>
                <tr>
                    <td><?php echo $devisFacture['id']; ?></td>
                    <td><?php echo $devisFacture['type']; ?></td>
                    <td><?php echo $devisFacture['client']; ?></td>
                    <td><?php echo $devisFacture['date']; ?></td>
                    <td><?php echo $devisFacture['montant']; ?></td>
                    <td>
                        <a href="process_admin/process_admin_devis_factures.php?action=modifier&id=<?php echo $devisFacture['id']; ?>">Modifier</a>

                        <a href="process_admin/process_admin_devis_factures.php?action=supprimer&id=<?php echo $devisFacture['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once("../includes/footer-admin.php"); ?>

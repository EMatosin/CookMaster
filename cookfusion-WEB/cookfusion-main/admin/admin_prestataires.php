<?php
require_once("../includes/header-admin.php");
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");
require_once("process_admin/process_admin_prestataires.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Récupérer la liste des prestataires depuis la base de données
$prestataires = get_all_prestataires();

?>

<div class="admin-container">
    <h2>Gestion des prestataires</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prestataires as $prestataire) { ?>
                <tr>
                    <td><?php echo $prestataire['id']; ?></td>
                    <td><?php echo $prestataire['nom']; ?></td>
                    <td><?php echo $prestataire['email']; ?></td>
                    <td><?php echo $prestataire['telephone']; ?></td>
                    <td>
                        <a href="process_admin/process_admin_prestataires.php?action=modifier&id=<?php echo $prestataire['id']; ?>">Modifier</a>

                        <a href="process_admin/process_admin_prestataires.php?action=supprimer&id=<?php echo $prestataire['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once("../includes/footer-admin.php"); ?>

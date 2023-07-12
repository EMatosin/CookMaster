<?php
require_once("../includes/header-admin.php");
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");
require_once("process_admin/process_admin_ventes_produits.php");

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Récupérer la liste des ventes de produits depuis la base de données
$sales = get_all_sales();

?>

<div class="admin-container">
    <h2>Gestion des ventes de produits</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Date de vente</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sales as $sale) { ?>
                <tr>
                    <td><?php echo $sale['id']; ?></td>
                    <td><?php echo $sale['produit']; ?></td>
                    <td><?php echo $sale['quantite']; ?></td>
                    <td><?php echo $sale['prix_unitaire']; ?></td>
                    <td><?php echo $sale['date_vente']; ?></td>
                    <td>
                        <a href="process_admin/process_admin_ventes_produits.php?action=modifier&id=<?php echo $salle'id']; ?>">Modifier</a>

                        <a href="process_admin/process_admin_ventes_produits.php?action=supprimer&id=<?php echo $sale['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once("../includes/footer-admin.php"); ?>

<?php
require_once("../bdd/db_config.php");
require_once("../bdd/db_connection.php");
require_once("../bdd/db_functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userId"];
    $productId = $_POST["productId"];
    $quantity = $_POST["quantity"];

    // Vérifier si l'utilisateur existe dans la base de données
    $existingUser = get_user_by_id($userId);

    // Vérifier si le produit existe dans la base de données
    $existingProduct = get_product_by_id($productId);

    if ($existingUser && $existingProduct) {
        // Enregistrer l'achat dans la base de données
        $purchaseId = create_purchase($userId, $productId, $quantity);

        if ($purchaseId) {
            // Rediriger vers la page de confirmation avec un message de succès
            header("Location: ../confirmation.php?purchase=success");
            exit();
        }
    }
}

// En cas d'échec de l'achat, rediriger vers la page d'achat avec un message d'erreur
header("Location: ../achat_produit.php?purchase=error");
exit();
?>

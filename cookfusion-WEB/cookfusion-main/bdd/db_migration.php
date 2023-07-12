<?php
require_once("db_functions.php");

// Création de la base de données
function createDatabase() {
    $connection = connectDB();

    $sql = "CREATE DATABASE IF NOT EXISTS cookfusion DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $success = $connection->exec($sql);

    if ($success === false) {
        $error = $connection->errorInfo();
        echo "Erreur lors de la création de la base de données : " . $error[2];
        exit;
    } else {
        echo "La base de données Cookfusion a bien été créée. <a href='../index.php'>Retour à la page d'accueil</a>";
    }

    $connection = null;
}

// Création des tables
function createTables() {
    $connection = connectDB();

    // Table abonnements
    $sql = "CREATE TABLE IF NOT EXISTS abonnements (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        prix_mensuel DECIMAL(10,2) NOT NULL,
        prix_annuel DECIMAL(10,2) NOT NULL,
        description TEXT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table catalogue_services
    $sql = "CREATE TABLE IF NOT EXISTS catalogue_services (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        description TEXT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table clients
    $sql = "CREATE TABLE IF NOT EXISTS clients (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        telephone VARCHAR(20) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table devis_factures
    $sql = "CREATE TABLE IF NOT EXISTS devis_factures (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        type ENUM('devis', 'facture') NOT NULL,
        client_id INT(11) UNSIGNED NOT NULL,
        montant DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table evenements
    $sql = "CREATE TABLE IF NOT EXISTS evenements (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        date DATE NOT NULL,
        description TEXT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table location_cuisine
    $sql = "CREATE TABLE IF NOT EXISTS location_cuisine (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        adresse TEXT NOT NULL,
        capacite INT(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table admins
    $sql = "CREATE TABLE IF NOT EXISTS admins (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table materiel
    $sql = "CREATE TABLE IF NOT EXISTS materiel (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        quantite INT(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table planification
    $sql = "CREATE TABLE IF NOT EXISTS planification (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titre VARCHAR(255) NOT NULL,
        date_debut DATETIME NOT NULL,
        date_fin DATETIME NOT NULL,
        description TEXT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table prestataire
    $sql = "CREATE TABLE IF NOT EXISTS prestataire (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        telephone VARCHAR(20) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table reservation
    $sql = "CREATE TABLE IF NOT EXISTS reservation (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        etat ENUM('en_attente', 'confirmee', 'annulee') NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table salle
    $sql = "CREATE TABLE IF NOT EXISTS salle (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        capacite INT(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table vente_produit
    $sql = "CREATE TABLE IF NOT EXISTS vente_produit (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        prix DECIMAL(10,2) NOT NULL,
        description TEXT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table ateliers
    $sql = "CREATE TABLE IF NOT EXISTS ateliers (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titre VARCHAR(255) NOT NULL,
        description TEXT,
        date DATE NOT NULL,
        heure VARCHAR(10) NOT NULL,
        lieu VARCHAR(255) NOT NULL,
        prix DECIMAL(10,2) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table produits
    $sql = "CREATE TABLE IF NOT EXISTS produits (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        description TEXT,
        prix DECIMAL(10,2) NOT NULL,
        image VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);

    // Table cours_domicile
    $sql = "CREATE TABLE IF NOT EXISTS cours_domicile (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titre VARCHAR(255) NOT NULL,
        description TEXT,
        duree INT(11) NOT NULL,
        prix DECIMAL(10, 2) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);
    
    
    
    // Table degustation
    $sql = "CREATE TABLE IF NOT EXISTS degustations (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    date DATE NOT NULL,
    lieu VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);
    
    // Table location_cuisine
    $sql = "CREATE TABLE IF NOT EXISTS locations_cuisine (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    capacite INT(11) NOT NULL,
    lieu VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $connection->exec($sql);
    
    
    
    
    $connection = null;
}

// Création des tables et de la base de données
function createDatabaseTables() {
    createDatabase();
    createTables();
}

// Appel de la fonction pour créer les tables et la base de données
createDatabaseTables();
?>

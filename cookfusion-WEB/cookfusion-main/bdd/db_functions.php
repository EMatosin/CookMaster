<?php
require_once("db_config.php");
require_once('db_config.php');
require_once('db_connection.php');

function connectDB() {
    global $db_host, $db_name, $db_user, $db_password;
    
    try {
        $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch(PDOException $e) {
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
        exit();
    }
}



// Ajouter un abonnement
function add_abonnement($nom, $prix_mensuel, $prix_annuel, $description) {
    $connection = connectDB();

    $nom = $connection->quote($nom);
    $prix_mensuel = $connection->quote($prix_mensuel);
    $prix_annuel = $connection->quote($prix_annuel);
    $description = $connection->quote($description);

    $sql = "INSERT INTO abonnements (nom, prix_mensuel, prix_annuel, description) VALUES ($nom, $prix_mensuel, $prix_annuel, $description)";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Mettre à jour un abonnement
function update_abonnement($id, $nom, $prix_mensuel, $prix_annuel, $description) {
    $connection = connectDB();

    $id = $connection->quote($id);
    $nom = $connection->quote($nom);
    $prix_mensuel = $connection->quote($prix_mensuel);
    $prix_annuel = $connection->quote($prix_annuel);
    $description = $connection->quote($description);

    $sql = "UPDATE abonnements SET nom=$nom, prix_mensuel=$prix_mensuel, prix_annuel=$prix_annuel, description=$description WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Supprimer un abonnement
function delete_abonnement($id) {
    $connection = connectDB();

    $id = $connection->quote($id);

    $sql = "DELETE FROM abonnements WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Ajouter un service au catalogue
function ajouter_service_catalogue($nom, $description) {
    $connection = connectDB();

    $nom = $connection->quote($nom);
    $description = $connection->quote($description);

    $sql = "INSERT INTO catalogue_services (nom, description) VALUES ($nom, $description)";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Modifier un service du catalogue
function modifier_service_catalogue($id, $nom, $description) {
    $connection = connectDB();

    $id = $connection->quote($id);
    $nom = $connection->quote($nom);
    $description = $connection->quote($description);

    $sql = "UPDATE catalogue_services SET nom=$nom, description=$description WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Supprimer un service du catalogue
function supprimer_service_catalogue($id) {
    $connection = connectDB();

    $id = $connection->quote($id);

    $sql = "DELETE FROM catalogue_services WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Ajouter un client
function add_client($nom, $email, $telephone) {
    $connection = connectDB();

    $nom = $connection->quote($nom);
    $email = $connection->quote($email);
    $telephone = $connection->quote($telephone);

    $sql = "INSERT INTO clients (nom, email, telephone) VALUES ($nom, $email, $telephone)";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Mettre à jour un client
function update_client($id, $nom, $email, $telephone) {
    $conn = connectDB();

    $id = $conn->real_escape_string($id);
    $nom = $conn->real_escape_string($nom);
    $email = $conn->real_escape_string($email);
    $telephone = $conn->real_escape_string($telephone);

    $sql = "UPDATE clients SET nom='$nom', email='$email', telephone='$telephone' WHERE id='$id'";

    $result = $conn->query($sql);
    $conn->close();

    return $result;
}

// Supprimer un client
function delete_client($id) {
    $connection = connectDB();

    $id = $connection->quote($id);

    $sql = "DELETE FROM clients WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Créer un devis ou une facture
function create_devis_facture($type, $client_id, $montant) {
    $connection = connectDB();

    $type = $connection->quote($type);
    $client_id = $connection->quote($client_id);
    $montant = $connection->quote($montant);

    $sql = "INSERT INTO devis_factures (type, client_id, montant) VALUES ($type, $client_id, $montant)";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Mettre à jour un devis ou une facture
function update_devis_facture($id, $type, $client_id, $montant) {
    $connection = connectDB();

    $id = $connection->quote($id);
    $type = $connection->quote($type);
    $client_id = $connection->quote($client_id);
    $montant = $connection->quote($montant);

    $sql = "UPDATE devis_factures SET type=$type, client_id=$client_id, montant=$montant WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Supprimer un devis ou une facture
function delete_devis_facture($id) {
    $connection = connectDB();

    $id = $connection->quote($id);

    $sql = "DELETE FROM devis_factures WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Ajouter un événement
function ajouter_evenement($nom, $date, $description) {
    $connection = connectDB();

    $nom = $connection->quote($nom);
    $date = $connection->quote($date);
    $description = $connection->quote($description);

    $sql = "INSERT INTO evenements (nom, date, description) VALUES ($nom, $date, $description)";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Modifier un événement
function modifier_evenement($id, $nom, $date, $description) {
    $connection = connectDB();

    $id = $connection->quote($id);
    $nom = $connection->quote($nom);
    $date = $connection->quote($date);
    $description = $connection->quote($description);

    $sql = "UPDATE evenements SET nom=$nom, date=$date, description=$description WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Supprimer un événement
function supprimer_evenement($id) {
    $connection = connectDB();

    $id = $connection->quote($id);

    $sql = "DELETE FROM evenements WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Ajouter une location d'espace de cuisine
function ajouter_location_cuisine($nom, $adresse, $capacite) {
    $connection = connectDB();

    $nom = $connection->quote($nom);
    $adresse = $connection->quote($adresse);
    $capacite = $connection->quote($capacite);

    $sql = "INSERT INTO location_cuisine (nom, adresse, capacite) VALUES ($nom, $adresse, $capacite)";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Modifier une location d'espace de cuisine
function modifier_location_cuisine($id, $nom, $adresse, $capacite) {
    $connection = connectDB();

    $id = $connection->quote($id);
    $nom = $connection->quote($nom);
    $adresse = $connection->quote($adresse);
    $capacite = $connection->quote($capacite);

    $sql = "UPDATE location_cuisine SET nom=$nom, adresse=$adresse, capacite=$capacite WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Supprimer une location d'espace de cuisine
function supprimer_location_cuisine($id) {
    $connection = connectDB();

    $id = $connection->quote($id);

    $sql = "DELETE FROM location_cuisine WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}



// Fonction de vérification des informations d'identification de l'administrateur
function verify_admin_credentials($username, $password) {
    $connection = connectDB();

    $username = $connection->quote($username);
    $password = $connection->quote($password);

    $sql = "SELECT * FROM admins WHERE username = $username AND password = $password";
    $result = $connection->query($sql);

    if ($result && $result->rowCount() === 1) {
        // Génération du token bearer en cas de succès
        $token = "Bearer abcdef1234567890"; // Remplacez cette ligne par votre génération de token réelle

        // Stockage du token dans la session ou dans un cookie sécurisé

        $result->closeCursor();
        $connection = null;

        return true; // Les informations d'identification sont valides
    } else {
        $connection = null;
        return false; // Les informations d'identification sont invalides
    }
}

// Vérification des informations d'identification si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Vérification des informations d'identification de l'administrateur
    $isCredentialsValid = verify_admin_credentials($username, $password);

    if ($isCredentialsValid) {
        // Redirection vers la page d'administration
        header("Location: ../admin.php");
        exit();
    } else {
        // Redirection vers la page de connexion en cas d'identifiants invalides
        header("Location: ../login_admin.php");
        exit();
    }
}



// Ajouter du matériel
function ajouter_materiel($nom, $quantite) {
    $connection = connectDB();

    $nom = $connection->quote($nom);
    $quantite = $connection->quote($quantite);

    $sql = "INSERT INTO materiel (nom, quantite) VALUES ($nom, $quantite)";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Modifier du matériel
function modifier_materiel($id, $nom, $quantite) {
    $connection = connectDB();

    $id = $connection->quote($id);
    $nom = $connection->quote($nom);
    $quantite = $connection->quote($quantite);

    $sql = "UPDATE materiel SET nom=$nom, quantite=$quantite WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Supprimer du matériel
function supprimer_materiel($id) {
    $connection = connectDB();

    $id = $connection->quote($id);

    $sql = "DELETE FROM materiel WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}



// Ajouter une planification
function ajouter_planification($titre, $date_debut, $date_fin, $description) {
    $connection = connectDB();

    $titre = $connection->quote($titre);
    $date_debut = $connection->quote($date_debut);
    $date_fin = $connection->quote($date_fin);
    $description = $connection->quote($description);

    $sql = "INSERT INTO planification (titre, date_debut, date_fin, description) VALUES ($titre, $date_debut, $date_fin, $description)";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Modifier une planification
function modifier_planification($id, $titre, $date_debut, $date_fin, $description) {
    $connection = connectDB();

    $id = $connection->quote($id);
    $titre = $connection->quote($titre);
    $date_debut = $connection->quote($date_debut);
    $date_fin = $connection->quote($date_fin);
    $description = $connection->quote($description);

    $sql = "UPDATE planification SET titre=$titre, date_debut=$date_debut, date_fin=$date_fin, description=$description WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Supprimer une planification
function supprimer_planification($id) {
    $connection = connectDB();

    $id = $connection->quote($id);

    $sql = "DELETE FROM planification WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Ajouter un prestataire
function ajouter_prestataire($nom, $email, $telephone) {
    $connection = connectDB();

    $nom = $connection->quote($nom);
    $email = $connection->quote($email);
    $telephone = $connection->quote($telephone);

    $sql = "INSERT INTO prestataire (nom, email, telephone) VALUES ($nom, $email, $telephone)";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Modifier un prestataire
function modifier_prestataire($id, $nom, $email, $telephone) {
    $connection = connectDB();

    $id = $connection->quote($id);
    $nom = $connection->quote($nom);
    $email = $connection->quote($email);
    $telephone = $connection->quote($telephone);

    $sql = "UPDATE prestataire SET nom=$nom, email=$email, telephone=$telephone WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Supprimer un prestataire
function supprimer_prestataire($id) {
    $connection = connectDB();

    $id = $connection->quote($id);

    $sql = "DELETE FROM prestataire WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}



// Modifier une réservation
function modifier_reservation($id, $etat) {
    $connection = connectDB();

    $id = $connection->quote($id);
    $etat = $connection->quote($etat);

    $sql = "UPDATE reservation SET etat=$etat WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Supprimer une réservation
function supprimer_reservation($id) {
    $connection = connectDB();

    $id = $connection->quote($id);

    $sql = "DELETE FROM reservation WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Ajouter une salle
function ajouter_salle($nom, $capacite) {
    $connection = connectDB();

    $nom = $connection->quote($nom);
    $capacite = $connection->quote($capacite);

    $sql = "INSERT INTO salle (nom, capacite) VALUES ($nom, $capacite)";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Modifier une salle
function modifier_salle($id, $nom, $capacite) {
    $connection = connectDB();

    $id = $connection->quote($id);
    $nom = $connection->quote($nom);
    $capacite = $connection->quote($capacite);

    $sql = "UPDATE salle SET nom=$nom, capacite=$capacite WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Supprimer une salle
function supprimer_salle($id) {
    $connection = connectDB();

    $id = $connection->quote($id);

    $sql = "DELETE FROM salle WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Ajouter une vente de produit
function ajouter_vente_produit($nom, $prix, $description) {
    $connection = connectDB();

    $nom = $connection->quote($nom);
    $prix = $connection->quote($prix);
    $description = $connection->quote($description);

    $sql = "INSERT INTO vente_produit (nom, prix, description) VALUES ($nom, $prix, $description)";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Modifier une vente de produit
function modifier_vente_produit($id, $nom, $prix, $description) {
    $connection = connectDB();

    $id = $connection->quote($id);
    $nom = $connection->quote($nom);
    $prix = $connection->quote($prix);
    $description = $connection->quote($description);

    $sql = "UPDATE vente_produit SET nom=$nom, prix=$prix, description=$description WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}


// Supprimer une vente de produit
function supprimer_vente_produit($id) {
    $connection = connectDB();

    $id = $connection->quote($id);

    $sql = "DELETE FROM vente_produit WHERE id=$id";

    $result = $connection->exec($sql);
    $connection = null;

    return $result;
}



// Fonction pour obtenir un utilisateur par ID
function get_user_by_id($userId) {
    $connection = connectDB();
    
    $query = "SELECT * FROM users WHERE id = :userId";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $user;
}

// Fonction pour créer un abonnement
function create_subscription($userId, $subscriptionType) {
    $connection = connectDB();
    
    $query = "INSERT INTO subscriptions (user_id, subscription_type) VALUES (:userId, :subscriptionType)";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":subscriptionType", $subscriptionType);
    $stmt->execute();
    
    $subscriptionId = $connection->lastInsertId();
    
    return $subscriptionId;
}




// Fonction pour obtenir un produit par ID
function get_product_by_id($productId) {
    $connection = connectDB();
    
    $query = "SELECT * FROM products WHERE id = :productId";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":productId", $productId);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $product;
}

// Fonction pour créer un achat
function create_purchase($userId, $productId, $quantity) {
    $connection = connectDB();
    
    $query = "INSERT INTO purchases (user_id, product_id, quantity) VALUES (:userId, :productId, :quantity)";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":productId", $productId);
    $stmt->bindParam(":quantity", $quantity);
    $stmt->execute();
    
    $purchaseId = $connection->lastInsertId();
    
    return $purchaseId;
}


// Fonction pour récupérer un utilisateur par son email
function get_user_by_email($email) {
    $connection = connectDB();

    $email = $connection->quote($email);
    $sql = "SELECT * FROM users WHERE email = $email";
    $result = $connection->query($sql);

    if (!$result || $result->rowCount() === 0) {
        return null;
    }

    $user = $result->fetch(PDO::FETCH_ASSOC);
    $result->closeCursor();
    $connection = null;

    return $user;
}



// Fonction pour générer un token bearer pour un utilisateur
function generate_token($userId) {
    // Génération du token (vous pouvez utiliser une logique spécifique ici)
    $token = "Bearer " . bin2hex(random_bytes(16));
    return $token;
}


// Fonction pour enregistrer le token dans la base de données pour un utilisateur
function save_token($userId, $token) {
    $connection = connectDB();

    $userId = $connection->quote($userId);
    $token = $connection->quote($token);

    $sql = "UPDATE users SET token = $token WHERE id = $userId";
    $result = $connection->exec($sql);

    $connection = null;

    return $result;
}






// Fonction pour récupérer un événement par son ID
function get_event_by_id($eventId) {
    $connection = connectDB();

    $eventId = $connection->quote($eventId);
    $sql = "SELECT * FROM events WHERE id = $eventId";
    $result = $connection->query($sql);

    if (!$result || $result->rowCount() === 0) {
        return null;
    }

    $event = $result->fetch(PDO::FETCH_ASSOC);
    $result->closeCursor();
    $connection = null;

    return $event;
}


// Fonction pour créer une réservation
function create_reservation($userId, $eventId) {
    $connection = connectDB();

    $userId = $connection->quote($userId);
    $eventId = $connection->quote($eventId);

    $sql = "INSERT INTO reservations (user_id, event_id) VALUES ($userId, $eventId)";
    $result = $connection->exec($sql);

    if ($result) {
        $reservationId = $connection->lastInsertId();
    } else {
        $reservationId = null;
    }

    $connection = null;

    return $reservationId;
}





// Fonction pour créer un nouvel utilisateur
function create_user($name, $email, $password) {
    $connection = connectDB();

    $name = $connection->quote($name);
    $email = $connection->quote($email);
    $password = $connection->quote($password);

    $query = "INSERT INTO users (name, email, password) VALUES ($name, $email, $password)";
    $stmt = $connection->prepare($query);
    $result = $stmt->execute();

    if ($result) {
        $userId = $connection->lastInsertId();
    } else {
        $userId = null;
    }

    return $userId;
}



// Fonction pour récupérer la liste des ateliers depuis la base de données
function getAteliers() {
    try {
        // Connexion à la base de données
        $connection = connectDB();

        // Requête SQL pour récupérer les ateliers
        $query = "SELECT * FROM ateliers";

        // Préparation de la requête
        $statement = $connection->prepare($query);

        // Exécution de la requête
        $statement->execute();

        // Récupération des résultats de la requête sous forme de tableau associatif
        $ateliers = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Fermeture de la connexion à la base de données
        $connection = null;

        // Retourne la liste des ateliers
        return $ateliers;
    } catch (PDOException $e) {
        die("Erreur lors de la récupération des ateliers : " . $e->getMessage());
    }
}

// Fonction pour récupérer tous les produits depuis la base de données
function getProduits()
{
    try {
        // Établissement de la connexion à la base de données
        $connection = connectDB();

        // Requête pour récupérer tous les produits
        $query = "SELECT * FROM produits";

        // Préparation de la requête
        $stmt = $connection->prepare($query);

        // Exécution de la requête
        $stmt->execute();

        // Récupération des résultats
        $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fermeture de la connexion à la base de données
        $connection = null;

        // Retourne le tableau des produits
        return $produits;
    } catch (PDOException $e) {
        die("Erreur lors de la récupération des produits : " . $e->getMessage());
    }
}


// Fonction pour récupérer les cours à domicile depuis la base de données
function getCoursDomicile()
{
    // Connexion à la base de données
    $connection = connectDB();
    
    // Requête pour récupérer les cours à domicile
    $query = "SELECT * FROM cours_domicile";
    
    // Préparation de la requête
    $stmt = $connection->prepare($query);
    
    // Exécution de la requête
    $stmt->execute();
    
    // Récupération des résultats
    $coursDomicile = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Fermeture de la connexion à la base de données
    $connection = null;
    
    // Retourner les cours à domicile
    return $coursDomicile;
}

// Fonction pour récupérer les dégustations depuis la base de données
function getDegustations()
{
    // Connexion à la base de données
    $connection = connectDB();

    // Requête pour récupérer les dégustations
    $query = "SELECT * FROM degustations";
    $stmt = $connection->query($query);

    // Tableau pour stocker les dégustations
    $degustations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fermeture de la connexion à la base de données
    $connection = null;

    // Retourne les dégustations
    return $degustations;
}

// Fonction pour récupérer les informations sur la location de cuisine depuis la base de données
function getLocationsCuisine() {
    try {
        // Connexion à la base de données
        $connection = connectDB();

        // Requête SQL pour récupérer les locations de cuisine
        $query = "SELECT * FROM locations_cuisine";
        $stmt = $connection->prepare($query);
        $stmt->execute();

        // Récupérer les résultats
        $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fermer la connexion à la base de données
        $connection = null;

        // Retourner les locations de cuisine
        return $locations;
    } catch (PDOException $e) {
        // Gérer les erreurs de connexion à la base de données
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        die();
    }
}

?>
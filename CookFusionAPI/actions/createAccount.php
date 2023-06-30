<?php

header('Content-Type: application/json');
include_once '../config/database.php';
$json = json_decode(file_get_contents('php://input'), true);

if (isset($json['username']) and isset($json['password'])) {
    $username = htmlspecialchars($json["username"]); //permet de sécuriser en cas d'injection de code
    $password = htmlspecialchars($json["password"]);
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    if ($username == "" or $password == "") {
        $result["success"] = false;
        $result["error"] = "Le mot de passe ou le nom d'utilisateur est vide";
    } else {
        $checkIfUsernameExists = $bdd->prepare('SELECT * FROM users WHERE username = ?');
        $checkIfUsernameExists->execute(array($username));

        if ($checkIfUsernameExists->rowCount() > 0) {
            $result["success"] = false;
            $result["error"] = "Cet utilisateur existe déjà";
        } else {

            try {
                $createAccount = $bdd->prepare("INSERT INTO `users` (`id`, `username`, `userPassword`) VALUES (NULL, ?, ?);");
                $createAccount->execute(array($username, $passwordHashed));
                $result["success"] = true;
            } catch (Exception $e) {
                $result["success"] = false;
                $result["error"] = "erreur lors de la création du compte";
            }
        }   
    }
} else {
    $result["success"] = false; 
    $result["error"] = "Veuiilez remplir tous les champs";
}

echo json_encode($result);

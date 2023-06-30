<?php

header('Content-Type: application/json');
include_once '../config/database.php';
$json = json_decode(file_get_contents('php://input'), true);

if (isset($json['username']) and isset($json['password'])) {
    $username = htmlspecialchars($json['username']); //permet de sécuriser en cas d'injection de code
    $password = htmlspecialchars($json['password']);

    $getUser = $bdd->prepare("SELECT * FROM users WHERE username = ?");
    $getUser->execute(array($username));

    # vérifier si l'utilisateur existe
    if ($getUser->rowCount() > 0) {
        $user = $getUser->fetch();
       
        if (password_verify($password, $user['userPassword'])) {  //password_verify permet de vérifier si le message entré correspond au hash
            $result["success"] = true;
        } else {
            $result["success"] = false;
            $result["error"] = "Le mot de passe est incorrect";
        }
    } else {
        $result["success"] = false;
        $result["error"] = "L'utilisateur n'existe pas";
    }
} else {
    $result["success"] = false;
    $result["error"] = "Veuillez remplir tous les champs";
}

echo json_encode($result);
<?php
require 'db_connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];
    // Requête SQL pour récupérer l'utilisateur avec le nom d'utilisateur donné
    $query = "SELECT * FROM Utilisateurs WHERE nom_utilisateur = :nom_utilisateur AND mot_de_passe = :password";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':nom_utilisateur' => $username,':password' =>$password ));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        if ($user["nom_utilisateur"] === $username AND $user['mot_de_passe']===$password) {
            // Si les informations sont correctes, créer une session pour l'utilisateur
            $_SESSION["user_id"] = $user["id_utilisateurs"];
            $_SESSION["nom_utilisateur"] = $user["nom_utilisateur"];
            //header("Location: index.php");
            // Si les informations sont incorrectes, afficher un message d'erreur
            $message = "valid";
        }
    }
    else {
        // Si les informations sont incorrectes, afficher un message d'erreur
        $message = "error";
    }
    
    
}


echo json_encode($message);
?>

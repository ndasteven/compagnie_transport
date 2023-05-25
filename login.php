<?php
require 'db_connection.php';
$message='';
if (isset($_POST["username"]) && isset($_POST["password"])) {
    // Récupération des données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];
    // Requête SQL pour récupérer l'utilisateur avec le nom d'utilisateur donné
    $query = "SELECT * FROM Utilisateurs WHERE login_Utilisateurs = :nom_utilisateur AND password_Utilisateurs = :password";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':nom_utilisateur' => $username,':password' =>$password ));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        if ($user["login_Utilisateurs"] === $username AND $user['password_Utilisateurs']===$password) {
            // Si les informations sont correctes, créer une session pour l'utilisateur
            $_SESSION["user_id"] = $user["id_utilisateurs"];
            $_SESSION["nom_utilisateur"] = $user["nom_Utilisateurs"];
            //header("Location: index.php");
            // Si les informations sont incorrectes, afficher un message d'erreur
            $message = array(
                'status'=>'valid'
            );
        }
    }
    else {
        // Si les informations sont incorrectes, afficher un message d'erreur
        $message = array(
            'status'=>'error'
        );
    }
    
    
}
if (isset($_SESSION["user_id"])) {
    $message = array(
        'status'=>'valid'
    );
}

if (isset($_POST["logout"])) {
    session_destroy();
    $message = array(
        'status'=>'detruite'
    );
}


echo json_encode($message);
?>

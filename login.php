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
        //requete pour selectionner toute les Utilisateurs
        $sql = "SELECT Utilisateurs.*, Gare.nom_Gare, COUNT(Ticket.id_ticket) as nbre_ticket, SUM(Ticket.prix_Ticket) as total_ticket
        FROM Utilisateurs LEFT JOIN Gare ON Utilisateurs.id_gare = Gare.id_gare
        LEFT JOIN Ticket ON Utilisateurs.id_utilisateurs = Ticket.id_utilisateurs 
        WHERE Utilisateurs.id_utilisateurs =:id_user";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            'id_user'=>$_SESSION["user_id"]
        ));
        $USERS = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $message = array(
            'status'=>'valid',
            'user'=>$USERS
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

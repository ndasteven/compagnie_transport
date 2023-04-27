<?php
require 'db_connection.php';
$message = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["nom"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $re_password = $_POST["re_password"];

    if(!empty($nom) && !empty($prenom) && !empty($username) && !empty($password) && !empty($re_password)){
        

        if(strlen($nom) >= 2 && strlen($prenom) >= 2 && strlen($username) >= 4 && strlen($password) >=6){
            
        //verifie si les mots de passe saisi sont identiques
        if ($re_password !== $password) {
            $message['samepasse'] = 'error';
            $message['valid'] = 'error';
        }else{
            $message['samepasse'] = 'valid';
            $message['valid'] = 'valid';
        }
        //verifie la taille des elments renseignés
            $message['valid'] = 'valid'; 
        }else{
            $message['valid'] = 'error';
        }
    }else {
        $message['valid'] = 'error';
    }
    //verifie si le nom d'utilisateur existe déjà
    if ($message['valid'] = 'valid') {
        $query = "SELECT * FROM Utilisateurs WHERE nom_utilisateur = :nom_utilisateur";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':nom_utilisateur' => $username));
        if ($stmt->rowCount() > 0) {
            $message['user'] = 'error';
            $message['valid'] = 'error';
        }else{
            $query = "INSERT INTO utilisateurs (nom, prenom, nom_utilisateur, mot_de_passe, statut_update) VALUES (:nom, :prenom, :nom_utilisateur, :mot_de_passe,'0')";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':nom'=>$nom,
                ':prenom'=>$prenom,
                ':nom_utilisateur'=>$username,
                ':mot_de_passe'=>$password
            ));
        }
    }
    
 }
 echo json_encode($message);
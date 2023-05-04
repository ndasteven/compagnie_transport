<?php

require 'db_connection.php';

//insertion d'une Gare
if (isset($_POST['gare_name']) && isset($_POST['gare_position'])) {
// Préparation de la requête d'insertion
$sql = "INSERT INTO Gare (nom_Gare, situation_geographique_Gare ) VALUES (:nom, :position)";
$stmt = $pdo->prepare($sql);

if ($stmt->execute(array(
':nom'=>$_POST['gare_name'],
':position'=>$_POST['gare_position']
))) {
    $message = 'la GARE à été Enregistrée';
}else{
    $message = 'la GARE n\'a pas été Enregistrée';
}
echo json_encode($message);
}
//insertion d'un utilisateur
if (isset($_POST['user_nom']) && isset($_POST['user_prenom']) && isset($_POST['user_date_naissance']) && isset($_POST['user_pseudo'])
&& isset($_POST['user_password']) && isset($_POST['user_gare']) && isset($_POST['user_tel'])
) {
    // Préparation de la requête d'insertion
    $sql = "INSERT INTO Utilisateurs (nom_Utilisateurs, prenom_Utilisateurs, date_naissance_Utilisateurs, login_Utilisateurs, password_Utilisateurs,tel_Utilisateurs, id_gare )
     VALUES (:nom_Utilisateurs, :prenom_Utilisateurs, :date_naissance_Utilisateurs, :login_Utilisateurs, :password_Utilisateurs,:tel_Utilisateurs, :id_gare)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute(array(
    ':nom_Utilisateurs'=>$_POST['user_nom'],
    ':prenom_Utilisateurs'=>$_POST['user_prenom'],
    ':date_naissance_Utilisateurs'=>$_POST['user_date_naissance'],
    ':login_Utilisateurs'=>$_POST['user_pseudo'],
    ':password_Utilisateurs'=>$_POST['user_password'],
    ':id_gare'=>$_POST['user_gare'],
    ':tel_Utilisateurs'=>$_POST['user_tel']

    ))) {
        $message = 'l\'utilisateur  à été Enregistrée';
    }else{
        $message = 'l\'utilisateur n\'a pas été Enregistrée';
    }
    echo json_encode($message);
    }

<?php

require 'db_connection.php';

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

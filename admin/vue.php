<?php
require 'db_connection.php';


    //requete pour selectionner toute les gares
    $sql = "SELECT * FROM GARE";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $GARES = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //requete pour selectionner toute les Utilisateurs
    $sql = "SELECT * FROM Utilisateurs";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $USERS = $stmt->fetchAll(PDO::FETCH_ASSOC);



    $json_data = array(
    'gare'=>$GARES,
    'user'=>$USERS
    );
        
    

    
    echo json_encode($json_data);



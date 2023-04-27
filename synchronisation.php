<?php
require 'db_connection.php';
$reponse = [];
// Connexion à la base de données
$serveur = 'mysql5043.site4now.net';
$username = 'a969e8_db';
$password = 'Steven05@';
$dsn = 'mysql:host='.$serveur.';dbname=db_a969e8_db;charset=utf8';

try {
    $pdo_sychrone = new PDO($dsn, $username, $password);
    // Utilisation de la méthode getAttribute pour vérifier la connexion
    $pdo_status = $pdo_sychrone->getAttribute(PDO::ATTR_CONNECTION_STATUS);

    if ($pdo_status == 'mysql5043.site4now.net via TCP/IP' // mysql5043.site4now.net via TCP/IP varie en fonction te ton hebergeur
    ) {
        $reponse['connexion'] = 'valid';
    }else{
        $reponse['connexion']= 'error';
    }
   
} catch (PDOException $e) {
    $reponse['connexion_error']= 'Erreur de connexion : ' . $e->getMessage();
}



$query = "SELECT * FROM Utilisateurs WHERE statut_update = '0'";
$stmt = $pdo->query($query);




if($stmt->rowCount() > 0 ){
$reponse['statut_mise_ajour']='error';
foreach ($stmt as $user) {
    
    //importe les données vers la base de données distante
    $query = "INSERT INTO utilisateurs (id_utilisateurs, nom, prenom, nom_utilisateur, mot_de_passe, statut_update) VALUES (:id_utilisateurs,:nom, :prenom, :nom_utilisateur, :mot_de_passe,'1')";
            $stmt = $pdo_sychrone->prepare($query);
            $stmt->execute(array(
                'id_utilisateurs'=>$user['id_utilisateurs'],
                ':nom'=>$user['nom'],
                ':prenom'=>$user['prenom'],
                ':nom_utilisateur'=>$user['nom_utilisateur'],
                ':mot_de_passe'=>$user['mot_de_passe']
));
//fin code d'importation de donnees base de distante

//pour la mise a jour du statut vers la base de données local
$sql = 'UPDATE Utilisateurs SET statut_update = :statut_update WHERE id_utilisateurs = :id';
$stmtsynchrone = $pdo->prepare($sql);
$stmtsynchrone->execute(array(
    ':statut_update'=>'1',
    ':id'=>$user['id_utilisateurs']
));
//fin pour la mise a jour du statut vers la base de données local
}
}else{
    $reponse['statut_mise_ajour']='valid';
}

echo json_encode($reponse);





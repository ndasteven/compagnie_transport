<?php
require 'db_connection.php';

    //requete pour le montant total des ticket vendu de la journee

    $sql = "SELECT SUM(prix_ticket) as montant_total_ticket  FROM Ticket";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $montant_total_ticket = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //requete pour selectionner toute les gares
    $sql = "SELECT * FROM GARE";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $GARES = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //requete pour selectionner toute les Utilisateurs
    $sql = "SELECT *, Gare.nom_Gare, COUNT(Ticket.id_ticket) as nbre_ticket, SUM(Ticket.prix_Ticket) as total_ticket
            FROM Utilisateurs LEFT JOIN Gare ON Utilisateurs.id_gare = Gare.id_gare
            LEFT JOIN Ticket ON Utilisateurs.id_utilisateurs = Ticket.id_utilisateurs GROUP BY Utilisateurs.id_utilisateurs
            ORDER BY  total_ticket DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $USERS = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //requete pour selectionner le nombre ticket vendu appenant a une gare

    $sql = "SELECT Gare.nom_Gare, COUNT(Ticket.id_ticket) as nbre_ticket
            FROM Gare 
            LEFT JOIN Utilisateurs ON Gare.id_gare = Utilisateurs.id_gare
            LEFT JOIN Ticket ON Ticket.id_utilisateurs = Utilisateurs.id_utilisateurs 
            GROUP BY Gare.nom_Gare ORDER BY nbre_ticket DESC;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $NBRE_TICKET_GARE = $stmt->fetchAll(PDO::FETCH_ASSOC);



    $json_data = array(
    'gare'=>$GARES,
    'user'=>$USERS,
    'TOTAL_PRIX_TICKET'=>$montant_total_ticket,
    'nbre_ticket_gare'=>$NBRE_TICKET_GARE
    );
        
    

    
    echo json_encode($json_data);



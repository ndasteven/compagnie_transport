<?php
require 'db_connection.php';

$sql = "SELECT * FROM GARE";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($results);
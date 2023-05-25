<?php
session_start();

// Connexion à la base de données
$data_base = 'compagnie_TPs';
$serveur = 'localhost';
$username = 'root';
$password = '';
$dsn = 'mysql:host='.$serveur.';dbname='.$data_base.';charset=utf8';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
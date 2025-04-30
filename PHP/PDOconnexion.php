<?php

$host = 'localhost';
$dbname = 'library';
$username = 'root';
$port = 3306;
$password = '';

try {//tente d'executer le code
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password); //creation d'un objet pdo avec en paramettre le host,le port et puis le compte de connexion a phpmyadmin
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {//si y a une erreur  lié a la connexion PDO
    die("Erreur de connexion : " . $e->getMessage());//on stop le code et affiche l'erreur 
}
?> 
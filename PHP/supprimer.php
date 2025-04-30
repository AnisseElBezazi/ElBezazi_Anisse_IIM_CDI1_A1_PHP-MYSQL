<?php
session_start();
require_once("PDOconnexion.php");

if (!isset($_SESSION['user'])) {
    header('Location: formulaire.php');
    exit;
}

if (isset($_POST['id_carte'])) {// si il existe un post avec l'id de la carte 
    $id_carte = $_POST['id_carte'];
    $id_user = $_SESSION['user']['iduser'];

    // supprime la carte si elle appartient à l'utilisateur connecté
    $stmt = $pdo->prepare("DELETE FROM user_cartes WHERE id = :id AND id_user = :id_user");
    $stmt->execute([
        'id' => $id_carte,
        'id_user' => $id_user
    ]);
}

// Redirige vers la page MaCollection après avoir supprimer la donnée 
header('Location: MaCollection.php');
exit;
?>

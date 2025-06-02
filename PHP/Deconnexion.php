<?php
session_start();
unset($_SESSION['user']);// supprime la session user
header('Location: formulaire.php');
exit;
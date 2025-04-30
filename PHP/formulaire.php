<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Pokemon</title>
    <link rel="stylesheet" href="../CSS/style.css"/>
    <script src="../JS/scriptformulaire.js" defer></script>
</head>
<body>
        <div class="formulaire">
            
<form class="inscription" method="POST" enctype="multipart/form-data">
    <div class="images-map">

    <div class="formulaire_droite">
        <div class="Enregistrement"><h1>Enregistrez-vous</h1></div>
<div class="input-form">

<img src="../image/Compte.gif"><input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
</div>

<div class="input-form">

<img src="../image/Mail.gif"><input type="email" name="email" id="email"placeholder="Email">
</div>
    
<div class="input-form">

<img src="../image/arrow.gif"><input type="password" name="password" id="password" placeholder="Mot de passe">
</div>
<div class="input-form">

<img src="../image/Check.gif"><input type="password" name="password2" id="password2" placeholder="Entrer à nouveau le mot de passes">
</div>
<div class = message>
<div class="message-error">
    <ul></ul>
</div>
<div class="message-succes">
    <ul></ul>
</div>
</div>
<div class="lien-connxion">
<?php 

require 'vendor/autoload.php';

$client = new Google_Client();// crée un objet avec la class Google_Client
$client->setClientId('81770474473-n3jsva7qhgdoblhoudmsjvi4v2ati7kj.apps.googleusercontent.com'); //Id donner sur le site de google
$client->setClientSecret('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');// code secret donner sur le site de google 
$client->setRedirectUri('http://localhost/Site-web-pokemon--main/Site-pokemon--page-2-et-filtre-/ElBezazi_Anisse_CDI1A1_IIM/callback2.php'); //redirige la personne vers la page callback
$client->addScope('email');//demande a google l'accés au mail 
$client->addScope('profile');//demande a google l'accés au profil cad pseudo et pp

$authUrl = $client->createAuthUrl(); //crée un url qui mennent vers google avec tout les 



require_once("PDOconnexion.php");

if($_POST){
try{


    $email = $_POST["email"];
    $password = $_POST["password"];
    $pseudo =$_POST["pseudo"];

    $sql = "INSERT INTO user (email, password,pseudo) VALUES(:email, :password, :pseudo)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'pseudo' => $pseudo,
    ]);

   
}
catch(Exception $e){
    die("Erreur de connexion");
}
}

?>

<div class = bouton_GOOGLE>
    <img src="../image/google-37.png" alt="logo google">
<a href="<?= htmlspecialchars($authUrl) ?>">Se connecter avec Google</a><!--html qui permet de rediriger vers l'url crée avant  -->
<!-- htmlspecialchars sert a transfomer les caractere speciaux -->
</div>
</div>
<a href="connexion.php"><p id="connexion">vous avez déja un compte ?</p></a>
<button type="submit" class="inscription-boutton">s'inscrire</button>
</div>

</div>
</form>
</div>
</body>
</html>
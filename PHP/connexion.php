
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
session_start();

if ($_POST) {
    try {
        $email = $_POST["email"]; //stock l'email entrer dans le formulaitre dans une varaible 
        $password = $_POST["password"];//pareille pour le mots de passe  
        $sql = "SELECT * FROM user WHERE email = :email"; //selectionne dans ma table user l'email qui est pareille 
        $stmt = $pdo->prepare($sql);//prepare une requete sql qui sera stocker dans la variable stmt
        $stmt->execute(['email' => $email]);// execute la requete  
        $user = $stmt->fetch(PDO::FETCH_ASSOC);//recupere la ligne correspondant a l'email dans la table user

        if ($user && password_verify($password, $user['password'])) {// si on a un email et que les mots de passe de la base de donné et du form correspondes 
            $_SESSION['user'] = [ //Creé une session user sous forme de tableau ou on stock les info utillisateur  
                'iduser' => $user['iduser'],
                'email' => $user['email'],
                'pseudo' => $user['pseudo'],
                'picture' => "../image/profil-amis.jpg"
            ];  
            header('Location: Page1.php');//Rediriqe vers la landing page 
            exit();
        } else {//Si la condition est fausse 
            echo "Identifiants incorrects.";
        }

    } catch (Exception $e) { //Si y a une erreur on stop tout
        die("Erreur de connexion : " . $e->getMessage());
    }
}

?>

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
        <div class="Enregistrement"><h1>Connexion</h1></div>

<div class="input-form">

<img src="../image/Mail.gif"><input type="email" name="email" id="email"placeholder="Email">
</div>
    
<div class="input-form">

<img src="../image/arrow.gif"><input type="password" name="password" id="password" placeholder="Mot de passe">
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

<div class = bouton_GOOGLE>
    <img src="../image/google-37.png" alt="logo google">
<a href="<?= htmlspecialchars($authUrl) ?>">Se connecter avec Google</a><!--html qui permet de rediriger vers l'url crée avant  -->

</div>
</div>
<button type="submit" class="inscription-boutton">s'inscrire</button>
</div>

</div>
</form>
</div>
</body>
</html>
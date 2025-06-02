<?php

require 'vendor/autoload.php'; // charge les classe des bibiliothèque installées

session_start(); //crée une session coter serveur 
$client = new Google_Client(); //recrée l'objet avec la class Google_Client
$client->setClientId('81770474473-n3jsva7qhgdoblhoudmsjvi4v2ati7kj.apps.googleusercontent.com'); //identifient donner sur le site de google
$client->setClientSecret('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');//code secret fournit par google
$client->setRedirectUri('http://localhost/SITE-web-pokemon--main/Site-pokemon--page-2-et-filtre-/ElBezazi_Anisse_CDI1A1_IIM/ElBezazi_Anisse_IIM_CDI1_A1_PHP-MYSQL/PHP/Callback2.php');//permet a google de vérifier qu'on a été rediriger vers la bonne page

if (isset($_GET['code'])) { //verifie l'existance d'un code dans l'url 
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']); //echange le code avec un token 

    if (!isset($token['error'])) {//si le token n'est pas une erreur 
        $client->setAccessToken($token);// met le token dans l'objet client 
        $oauth2 = new Google_Service_Oauth2($client);//crée un nouvel objet pour recup les info du client
        $userInfo = $oauth2->userinfo->get(); //recupere les info du client 

        $_SESSION['user'] = [
            'name' => $userInfo->name,
            'email' => $userInfo->email,
            'picture' => $userInfo->picture
        ];
        header('Location: Page1.php');
        exit;

    } else {
        echo "Erreur lors de la récupération du token.";
        
    }
} else {
    echo "Sa marche pas zebi";
}


//https://www.youtube.com/watch?v=yi2b9U1kQyc source video de l'utilisation de l'api google
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: formulaire.php');
    exit;
 }

$user = $_SESSION['user'];
require_once('PDOconnexion.php');
require_once("Top-page.php");
?>
<div class="landing-top">
  <h1>Collectionnez et ouvrez !</h1>
  <h2>La plateforme ultime pour tous les passionné <br>de cartes Pokemon !  
Ici ouvrez des boosters en direct, <br>enrichissez votre collection en directe et partager votre passion <br>avec vos amis !</h2>
<div class="boutonl">
    <a href="Booster.php">Commencer à collectionner !</a>
  </div>
</div>

<div class="landing2">
    
    <div class="titre">
        <h1>Echangez Vos Cartes !</h1>
        <h2>Vous avez des cartes en double ou que vous n’utilisez plus ? Trouvez facilement des joueurs avec qui échanger et complétez votre collection en un rien de temps !</h3>
    <div class="boutonl2"><a href="Booster.php">Commencer à collectionner !</a></div>
      </div>
    <div class="column">
    <main class="main1">

    <button class="arrow left" onclick="moveSlide(-1)"><</button>
<div class="slider contenu contenu1 contenu-active">
<div class="cartes">
        
<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
$client = new Client();
$response = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon?limit=20');//requete de de l'url grace a guzzle
$data = json_decode($response->getBody(), true);//decode la reponse 

foreach ($data['results'] as $pokemon) { //pour chaque element de la liste results dans la reponse 
    $detailsResponse = $client->request('GET', $pokemon['url']); //je vait chercher l'url du pokemon (2emeAPI)
    $details = json_decode($detailsResponse->getBody(), true);//je redecode
    $image = $details['sprites']['versions']['generation-v']['black-white']['animated']['front_default'];//puis je vais chercher chaque élément dont j'ai besoin et les stock dans une variable (sa marche comme un chemin d'acces)
    $imagesDeSecours = $details['sprites']['other']['official-artwork']['front_default'];
    $type = $details['types'][0]['type']['name'];//pareil pour tout le 0 est la car types est une liste et type et name sont des objets
    $pv = $details['stats'][0]['base_stat'];


    $capacité1 = $details['abilities'][0]['ability']['name'];
    
    $url_capacite1 = $details['abilities'][0]['ability']['url'];
    $capResponse1 = $client->request('GET', $url_capacite1);//3eme Api dans le pokemon  avec la description de la capacité 
    $capDetails1 = json_decode($capResponse1->getBody(), true);
    $DetCapacité1 = $capDetails1['effect_entries'][0]['short_effect'];   
    $DetCapacité2 = '';// je vide la capacité du pokemon precédent 
       
    if (isset($details['abilities'][1]['ability']['name'])) { //je verifie si y a une deuxieme capa 
        $capacité2 = $details['abilities'][1]['ability']['name'];
        $url_capacite2 = $details['abilities'][1]['ability']['url'];
        $capResponse2 = $client->request('GET', $url_capacite2);//si oui je refait la requete avec l'url de la 2eme capacité 
        $capDetails2 = json_decode($capResponse2->getBody(), true);
          
          
    foreach ($capDetails2['effect_entries'] as $entry) {// je verifie ici si l'objet name dans language dans l'api du detail de ma capacité contient bien en 
        if ($entry['language']['name'] === 'en') {
            $DetCapacité2 = $entry['short_effect'];
            break;
        }
    }
    } else {
        $capacité2 = "";
     }
    
    $blaze = $details['name'];
    
    echo "<div class='$type carte'>";//Mise en forme html de ma carte avec tout les donnés stocké dans les variable 
    echo "<div class = vie> $pv PV </div>";
    echo " <div class = blaze> $blaze </div>"; 
        
    
    if (isset($image)){
        echo "<div class = PokeGif><img src='$image' ></div>";//je verifie si j'ai bien un gif sinon je met une image de secour
    }
    else{
        echo "<img src='$imagesDeSecours' >";
        }
        echo "<div class = Type>Type : $type</div>";
        echo "<div class = abilities> <strong>$capacité1</strong> </div>";
        echo "<div class = Detabilities>$DetCapacité1</div>";
    
        if (isset($capacité2)){//je verifie si j'ai une capacité 2
            echo "<div class = abilities> <strong>$capacité2</strong> </div>";
            echo "<div class = Detabilities> $DetCapacité2 </div>";
        }

        echo "</div>";
    }
    ?>
        </div>
 </div>
 <button class="arrow right" onclick="moveSlide(1)">></button>
</main>

</div>

</div>

<div class="white-tabs"> 
    <div class="white-tab"> 
        <h1>Echanger Vos Cartes</h1>
        <img src="../image/Fleche.png" alt="">
        <h2>Jouez avec vos amis et échangez en toute sécurité !</h2>
    </div>

    <div class="white-tab"> 
        <h1>Collectionnez et ouvrez !</h1>
        <img src="../image/boost.png" alt="">
        <h2>Découvre plein de cartes, trouve des Pokémon rares et complète ta collection !</h2>
    </div>

    <div class="white-tab"> 
        <h1>Attrapez-les tous !</h1>
        <img src="../image/POKEBALL.png" alt="">
        <h2>Choisis tes cartes préférées et deviens un vrai dresseur Pokémon !</h2>
    </div>

</div>


<div class="landing">
    <img src="../image/pickachu-fond-jaune.png" alt="image de pickachu fond jaune" >
    <div class="titre">
        <div class="collectionnez">
            <h1>L’aventure Pokémon commence ici !</h1>
        </div>
        <h2> Rejoins la plateforme dédiée à tous les fans de cartes <a href="https://www.pokemon.com/fr">Pokemon ! </a>   <br>Ouvre tes boosters en direct, découvre des cartes rares, et complète ta collection avec tes amis !</h2>
    </div> 
</div>
<?php 
require_once("Bot-page.php");
?>
<script src="../JS/scriptPage1.js"></script>
</body>
</html>
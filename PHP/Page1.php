<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: formulaire.php');
    exit;
 }

$user = $_SESSION['user'];

require_once("Top-page.php");
?>



<div class="landing">
    <img src="../image/pickachu-fond-jaune.png" alt="image de pickachu fond jaune" >
    <div class="titre">
        <div class="collectionnez">
            <h1>Collectionnez <br>
                et ouvrez !</h1>
        </div>
        
        <h2> La plateforme ultime pour tous les passionné de cartes <a href="https://www.pokemon.com/fr">Pokemon ! </a>   <br> Ici ouvrez des boosters en direct, enrichissez votre collection en directe et partager votre passion avec vos amis ! </h2>
    </div>
    
</div>
<div class="filtre disapear">
<div class="bouton tab1 tab active-filtre" data-type="all">
    <p>All</p>
  </div>
  <div class="bouton tab2 tab" data-type="fire">
    <p>Fire</p>
  </div>
  <div class="bouton tab3 tab" data-type="grass">
    <p>Grass</p>
  </div>
  <div class="bouton tab4 tab" data-type="water">
    <p>Water</p>
  </div>
  <div class="bouton tab5 tab" data-type="normal">
    <p>Normal</p>
  </div>
  <div class="bouton tab5 tab" data-type="bug">
    <p>Bug</p>
  </div>
  <div class="bouton tab5 tab" data-type="poison">
    <p>Poison</p>
  </div>
  <div class="bouton tab5 tab" data-type="ground">
    <p>Ground</p>
  </div>
  <div class="bouton tab5 tab" data-type="fairy">
    <p>Fairy</p>
  </div>
  <div class="bouton tab5 tab" data-type="fighting">
    <p>Fighting</p>
  </div>
  <div class="bouton tab5 tab" data-type="psychic">
    <p>Psychic</p>
  </div>
  <div class="bouton tab5 tab" data-type="rock">
    <p>Rock</p>
  </div>
  <div class="bouton tab5 tab" data-type="ghost">
    <p>Ghost</p>
  </div>
  <div class="bouton tab5 tab" data-type="ice">
    <p>Ice</p>
  </div>
  <div class="bouton tab5 tab" data-type="dragon">
    <p>dragon</p>
  </div>
  <div class="bouton tab5 tab" data-type="dark">
    <p>Dark</p>
  </div>
  <div class="bouton tab5 tab" data-type="steel">
    <p>Steel</p>
  </div>
  <div class="bouton tab5 tab" data-type="flying">
    <p>Flying</p>
  </div>
  
  
</div>
<main class="main1">

    <button class="arrow left" onclick="moveSlide(-1)"><</button>
<div class="slider contenu contenu1 contenu-active">
<div class="cartes">
        
        <?php
    require 'vendor/autoload.php';
    use GuzzleHttp\Client;
    
    $client = new Client();
    
    $response = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon?limit=20');
    $data = json_decode($response->getBody(), true);
    
    foreach ($data['results'] as $pokemon) {
        
        $detailsResponse = $client->request('GET', $pokemon['url']);
        $details = json_decode($detailsResponse->getBody(), true);
        $image = $details['sprites']['versions']['generation-v']['black-white']['animated']['front_default'];
        $imagesDeSecours = $details['sprites']['other']['official-artwork']['front_default'];
        $type = $details['types'][0]['type']['name'];
        $pv = $details['stats'][0]['base_stat'];
    
        $capacité1 = $details['abilities'][0]['ability']['name'];
    
        $url_capacite1 = $details['abilities'][0]['ability']['url'];
        $capResponse1 = $client->request('GET', $url_capacite1);
        $capDetails1 = json_decode($capResponse1->getBody(), true);
        $DetCapacité1 = $capDetails1['effect_entries'][0]['short_effect']; 
        
        
       
        if (isset($details['abilities'][1]['ability']['name'])) {
            $capacité2 = $details['abilities'][1]['ability']['name'];
            $url_capacite2 = $details['abilities'][1]['ability']['url'];
        $capResponse2 = $client->request('GET', $url_capacite2);
        $capDetails2 = json_decode($capResponse2->getBody(), true);
        $DetCapacité2 = '';
    foreach ($capDetails2['effect_entries'] as $entry) {
        if ($entry['language']['name'] === 'en') {
            $DetCapacité2 = $entry['short_effect'];
            break;
        }
    }
        } else {
            $capacité2 = null;
        }
    
        $blaze = $details['name'];
    
        echo "<div class='$type carte2'>";
        echo "<div class = vie> $pv PV </div>";
        echo " <div class = blaze> $blaze </div>"; 
        
    
        if (isset($image)){
            echo "<div class = PokeGif><img src='$image' ></div>";
        }
        else{
            echo "<img src='$imagesDeSecours' >";
        }
        echo "<div class = Type>Type : $type</div>";
        echo "<div class = abilities> <strong>$capacité1</strong> </div>";
        echo "<div class = Detabilities>$DetCapacité1</div>";
    
        if (isset($capacité2)){
            echo "<div class = abilities> <strong>$capacité2</strong> </div>";
            echo "<div class = Detabilities> $DetCapacité2 </div>";
        }
        echo "<div class='non-favoris'><img src='../image/coeur-vide.png' alt='coeur-vide'></div>";
        echo "</div>";
    }
    ?>
        </div>
 </div>
 <button class="arrow right" onclick="moveSlide(1)">></button>
 <!-- met le parametre direction de la fonction moveSlide a 1 (droite) -->
</main>
<div class="landing2">
    
    <div class="titre">
        <h1>Echangez Vos Cartes !</h1>
        <h2>Vous avez des cartes en double ou que vous n’utilisez plus ? Trouvez facilement des joueurs avec qui échanger et complétez votre collection en un rien de temps !</h3>
    </div>
    <img src="../image/landing-images.png" alt="landing-images" >
</div>
<?php 
require_once("Bot-page.php");
?>
<script src="../JS/scriptPage1.js"></script>
</body>
</html>
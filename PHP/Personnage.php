
<?php
session_start();
if (!isset($_SESSION['user'])) {
   header('Location: formulaire.php');
    exit;
}

$user = $_SESSION['user'];
require_once("PDOconnexion.php");
require_once("Top-page.php");
?>


    
<div class="filtre">
<div class="bouton tab1 tab active-filtre" type="All">
    <p>All</p>
  </div>
  <div class="bouton tab2 tab" type="fire">
    <p>Fire</p>
  </div>
  <div class="bouton tab3 tab" type="grass">
    <p>Grass</p>
  </div>
  <div class="bouton tab4 tab" type="water">
    <p>Water</p>
  </div>
  <div class="bouton tab5 tab" type="electric">
    <p>Electric</p>
  </div>
  <div class="bouton tab5 tab" type="normal">
    <p>Normal</p>
  </div>
  <div class="bouton tab5 tab" type="bug">
    <p>Bug</p>
  </div>
  <div class="bouton tab5 tab" type="poison">
    <p>Poison</p>
  </div>
  <div class="bouton tab5 tab" type="ground">
    <p>Ground</p>
  </div>
  <div class="bouton tab5 tab" type="fairy">
    <p>Fairy</p>
  </div>
  <div class="bouton tab5 tab" type="fighting">
    <p>Fighting</p>
  </div>
  <div class="bouton tab5 tab" type="psychic">
    <p>Psychic</p>
  </div>
  <div class="bouton tab5 tab" type="rock">
    <p>Rock</p>
  </div>
  <div class="bouton tab5 tab" type="ghost">
    <p>Ghost</p>
  </div>
  <div class="bouton tab5 tab" type="ice">
    <p>Ice</p>
  </div>
  <div class="bouton tab5 tab" type="dragon">
    <p>dragon</p>
  </div>
  <div class="bouton tab5 tab" type="dark">
    <p>Dark</p>
  </div>
  <div class="bouton tab5 tab" type="steel">
    <p>Steel</p>
  </div>
  <div class="bouton tab5 tab" type="flying">
    <p>Flying</p>
  </div>
  <input type="text" id="searchBar" class ="Search" placeholder="Rechercher un Pokémon..." />
  
</div>

<main>
    

    <div class="cartes2">
        
   
    </div>

 
 
</main>
<?php require_once("Bot-page.php");?>

<div class="popup disapear" id="popup">
<div class="cartes2">
  <div class="popup-content " id="popup-content">
    
  </div>
  </div>
</div>
<script src="../JS/script.js"></script>
</body>
</html>
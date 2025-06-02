
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: formulaire.php');
    exit;
}

$user = $_SESSION['user'];
require_once("Top-page.php");
?>

</div>
<div class="page-booster">
    <div class="booster">
        <div class="collection-image">
        <img src="../image/damxfcm.png" alt="">
        
        
    </div>
        <div class="titre-booster"><h4>Pack Suprême</h4></div>
        <div class="description-booster">Tous les Pokémon sont dans ce booster !
Le pack parfait pour les fans</div>
        <div class="ouverture-booster"> 
    <form action="ouvrir-pack.php" method="POST">
        <button type="submit"  class="booster-bouton">
            <div class="bouton-ouverture-booster">
                <img src="../image/logo-pokemon-blanc.png" alt="" width="50px">
                <h4>Ouvrir le booster</h4>
            </div>
        </button>
    </form>
</div>
    </div>

    
</div>
<?php 
require_once("Bot-page.php");
?>
<script src="../JS/scriptbooster.js"></script>
</body>
</html>
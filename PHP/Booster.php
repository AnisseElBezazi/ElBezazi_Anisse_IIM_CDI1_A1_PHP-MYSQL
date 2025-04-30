
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
        <img src="../image/ecarlate-et-violet.jpg" alt="">
        
        
    </div>
        <div class="titre-booster"><h4>Écarlate & Violet</h4></div>
        <div class="description-booster">La dernière extension Pokémon sortie à ce jour.</div>
        <div class="ouverture-booster"> 
            <!-- Bouton qui va me rediriger vers la page qui a le code pour generer des cartes aleatoire -->
    <form action="ouvrir-pack.php" method="POST">
        <button type="submit" style="width: 100%; border: none; background: none;">
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
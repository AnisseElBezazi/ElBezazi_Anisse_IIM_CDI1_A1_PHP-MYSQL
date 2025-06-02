<?php
session_start();

if (!isset($_SESSION['cartes_tirees'])) {// verifie si y a une session cartes tirees qui existe 
    header('Location: booster.php');//sinon on renvoie a la page booster permet d'eviter de glitché en rechargent la page booster a l'infinie 
    exit();
}

$cartes = $_SESSION['cartes_tirees'];//on met se que contient la sesion dans une variable ici les 3 cartes
unset($_SESSION['cartes_tirees']);//puis on supprime la session
?>

<?php 
require_once("Top-page.php");
?>
<div class="tit">
<h1>Voici les cartes que tu as obtenues :</h1>
</div>


<div class="cartes3">
    <!-- boucle foreach ou je vais mettre les 3 cartes stocké dans $cartes dans du html 
     je pense que j'ai pas besoin de commenté plus le html :) -->
    <?php 

      foreach ($cartes as $carte) {//pour chaque cartes de qui ont ducoup l'id de mon utillisateur j'affiche les données
        
        echo '<div class="'.$carte['type'].' carte">';//je met les donnés de la carte grace a de la concatenation 
        echo '<div class="vie">'. $carte['pv'] . ' PV</div>';//pareil
        echo '<div class="blaze">'. $carte['nom'] . '</div>';//pareil
        echo '<div class="PokeGif">';
        echo '<img src="'.$carte['image'].'">';//pareil
        echo '</div>';
        echo '<div class="Type">Type :'. $carte['type'] . '</div>';//pareil
        echo '<div class="abilities"><strong>' . $carte['capacite1'] . '</strong></div>';//pareil
        echo '<div class="Detabilities">' . $carte['description1'] . '</div>';//pareil

        if (isset($carte['capacite2'])) {//je verifie si j'ai bien une deuxieme  capacité 
            echo '<div class="abilities"><strong>' . $carte['capacite2'] . '</strong></div>';//pareil
            echo '<div class="Detabilities">' . $carte['description2'] . '</div></div>';//pareil
        }}?>
     
</div>


<?php 
require_once("Bot-page.php");
?>
</body>
</html>

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
    <?php foreach ($cartes as $carte): ?> 
        <div class="<?= $carte['type'] ?> carte">
            <div class="vie"><?= $carte['pv'] ?> PV</div>
            <div class="blaze"><?= $carte['nom'] ?></div>

            <div class="PokeGif">
                <img src="<?= $carte['image'] ?>" alt="<?= $carte['nom'] ?>">
            </div>

            <div class="Type">Type : <?= $carte['type'] ?></div>
            <div class="abilities"><strong><?= $carte['capacite1'] ?></strong></div>
            <div class="Detabilities"><?= $carte['description1'] ?></div>
            <!--Ici je verifie si se qui est censé contenir ma capacité 2 n'est pas vide -->
            <?php if (!empty($carte['capacite2'])): ?>
                <div class="abilities"><strong><?= $carte['capacite2'] ?></strong></div>
                <div class="Detabilities"><?= $carte['description2'] ?></div>
            <?php endif; ?><!-- je ferme la condition -->
        </div>
    <?php endforeach; ?>
    <!-- je ferme la boucle Foreach -->
</div>


<?php 
require_once("Bot-page.php");
?>
</body>
</html>

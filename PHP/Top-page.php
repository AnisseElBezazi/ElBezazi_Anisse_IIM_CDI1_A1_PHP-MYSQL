
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Collectionnez des cartes Pokémon, ouvrez des boosters et échangez avec d'autres joueurs ! Rejoignez la communauté et agrandissez votre collection dès maintenant.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartes Pokémon rares : Ouvrez des boosters et complétez votre deck</title>
    <link rel="stylesheet" href="../CSS/style.css"/>
</head>
<body class="body1">
    <!-- division pour le header de mon site suivie de division qui vont servir pour le menu-->
    <header> 
        <div class="traits">
            <div class="tra">
                <img src="../image/3barre.png" alt="dragon ball 1" width="70px"  >
            </div>
            <div class=" menu-text">
            <a href="Page1.php"><p id="Accueil">Accueil</p></a>
            <a href="Personnage.php"><p id="Accueil">Pokemon</p></a>
            <a href="Booster.php"><p> Booster</p></a>
            <a href="MaCollection.php"><p>Collection</p></a>
        </div>
        </div>
        <div class="logo-site">
            <img src="../image/pokemon-&-Co.png" alt="Logo pokemon & co" width="300px">
        </div>
        
<div class="haut-droit">
    <div class="darkmode" id="dark">
        <img src="../image/blue-moon.png" alt="moon" width="40px" height="40px" >
    </div>
    <div class="pp">
      <img src="<?= $_SESSION['user']['picture'] ?>" alt="profilpicture">
  </div>
<div class="compte">
    <a href="Deconnexion.php"><p id="connexion">Profil</p></a>

</div>
</div>
</header> 

<div class="Depliable">
    <div class= Acceuil>
    <a href="Page1.php"><p id="Accueil">Accueil</p></a>
   </div>
   <div class= Pokemon>
    <a href="Personnage.php"><p id="Accueil">Pokemon</p></a>
</div>
<div class= Booster>
    <a href="Booster.php"><p> Booster</p></a>
</div>
<div class= Echange>
    <a href="MaCollection.php"><p>Collection</p></a>
</div>
</div>
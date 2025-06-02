<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: formulaire.php');
    exit;
}

require_once("Top-page.php");
require_once("PDOconnexion.php");




if (isset($_POST['id'], $_POST['favori'])) {//si j'ai un post avec id et et favoris 
    $id = $_POST['id'];// je stock l'id de la carte responsable du post 
    $favori = $_POST['favori'];//je stock la valeur favoris de la carte responsable du post (1 ou 0)
    $id_user = $_SESSION['user']['iduser'];//je stock l'id de l'utillisateur 

    $stmt = $pdo->prepare("UPDATE user_cartes SET favori = :favori WHERE id = :id AND id_user = :id_user");//on met a jour favoris avec la valeur qui a été preparé avant 
    $stmt->execute([
        ':favori' => $favori,
        ':id' => $id,
        ':id_user' => $id_user
    ]);
}


//Bouton supprimer

if (isset($_POST['idCarte'])) {//si j'ai un post avec id et et favoris 
    $id = $_POST['idCarte'];// je stock l'id de la carte responsable du post 
    $id_user = $_SESSION['user']['iduser'];//je stock l'id de l'utillisateur 

    $stmt = $pdo->prepare("DELETE FROM user_cartes WHERE id = :id AND id_user = :id_user");//on met a jour favoris avec la valeur qui a été preparé avant 
    $stmt->execute([
        ':id' => $id,
        ':id_user' => $id_user
    ]);
}




$id_user = $_SESSION['user']['iduser'];//je stock l'id de l'utillisateur 
$sql = "SELECT * FROM user_cartes WHERE id_user = :id_user"; //je met ma requete sql dans une variable 
$stmt = $pdo->prepare($sql);//je prepare ma requete sql
$stmt->execute(['id_user' => $id_user]); //j'execute ma requete pour l'id utillisateur 
$cartes = $stmt->fetchAll(PDO::FETCH_ASSOC);//je prend tout les ligne qui ont l'id utillisateur (toutes les cartes) que je met dans un tableau cartes
?>


<div class="tit">
<h1>Mes Favoris</h1>
</div>

<input type="text" id="searchBar" class ="Search coSearch"  placeholder="Rechercher un Pokémon..." />
<div class="cartes2">

  <?php 
if (count($cartes) > 0) {
    foreach ($cartes as $carte) {//pour chaque cartes de qui ont ducoup l'id de mon utillisateur j'affiche les données
        if ($carte['favori']) {

        echo '<div class="'.$carte['type'].' carte">';//je met les donnés de la carte grace a de la concatenation 
        echo '<div class="vie">'. $carte['pv'] . ' PV</div>';//pareille
        echo '<div class="blaze">'. $carte['nom'] . '</div>';//pareille
        echo '<div class="PokeGif">';
        echo '<img src="'.$carte['image'].'">';//pareille
        echo '</div>';
        echo '<div class="Type">Type :'. $carte['type'] . '</div>';//pareille
        echo '<div class="abilities"><strong>' . $carte['capacite1'] . '</strong></div>';//pareille
        echo '<div class="Detabilities">' . $carte['description1'] . '</div>';//pareille

        if (isset($carte['capacite2'])) {//je verifie si j'ai bien une deuxieme  capacité 
            echo '<div class="abilities"><strong>' . $carte['capacite2'] . '</strong></div>';//pareille
            echo '<div class="Detabilities">' . $carte['description2'] . '</div>';//pareille
        }


        // Bouton Supprimer
        echo '<form method="POST">';//met sur ma carte le formulaire pour supprimer la carte
        echo '<input type="hidden" name="idCarte" value="' . $carte['id'] . '">';//boutton invisible qui set a envoyer l'id de la carte
        echo '<button type="submit" class="sup"><img src="../image/croix-jaune.png"></button>';//bouton qui permet de soumettre le formulaire
        echo '</form>';


       //bouton favoris
        $id = $carte['id'];// prends id de la carte 
        $favori = $carte['favori'];//prend l'etat de la carte (si elle est favoris ou pas)

        if ($favori == 1) {//si oui on prepare une variable pour inverser mettre en non favoris
            $valeur_favori = 0;
            $image = "../image/coeur-plein.png";//on stock dans une variable le texte d'un img src pour avoir l'image d'un coeur plein
            $classe = "opaciterMax";//class qui permet d'annuler l'effet de l'over en mettant opaciter a 1
        } else {
            $valeur_favori = 1;//si non on prepare les donnés d'une catre favoris pour le formulaire
            $image = "../image/coeur-vide.png";//
            $classe = "";
        }

        echo '<form method="POST">';//formulaire favoris
        echo '<input type="hidden" name="id" value="' .$id. '">';//boutton invisible qui permet de donner l'id de la carte a la soumission du formulaire
        echo '<input type="hidden" name="favori" value="' .$valeur_favori. '">';//pareille mais pour la valeur preparé 
        echo '<button type="submit" class="non-favoris">';//soummet le formulaire
        echo '<img src="' .$image. '" class="' .$classe. '" alt="Favori"></button>';//met la 
        echo '</form>';
        echo '</div>'; 
    }
}
}
else{
    echo '<div class="msg-vide">Aucune carte en Favoris </div>';
}
?>

</div>



<div class="tit">
<h1>Ma Collection de Cartes</h1>
</div>

<div class="cartes2">

    <?php 
    //meme code que en haut mais pour les cartes non favoris
if (count($cartes) > 0) {
    foreach ($cartes as $carte) {//pour chaque cartes de qui ont ducoup l'id de mon utillisateur j'affiche les données
        if (!$carte['favori']) {
         echo '<div class="'.$carte['type'].' carte">';//je met les donnés de la carte grace a de la concatenation 
        echo '<div class="vie">'. $carte['pv'] . ' PV</div>';//pareille
        echo '<div class="blaze">'. $carte['nom'] . '</div>';//pareille
        echo '<div class="PokeGif">';
        echo '<img src="'.$carte['image'].'">';//pareille
        echo '</div>';
        echo '<div class="Type">Type :'. $carte['type'] . '</div>';//pareille
        echo '<div class="abilities"><strong>' . $carte['capacite1'] . '</strong></div>';//pareille
        echo '<div class="Detabilities">' . $carte['description1'] . '</div>';//pareille

        if (isset($carte['capacite2'])) {//je verifie si j'ai bien une deuxieme  capacité 
            echo '<div class="abilities"><strong>' . $carte['capacite2'] . '</strong></div>';//pareille
            echo '<div class="Detabilities">' . $carte['description2'] . '</div>';//pareille
        }


        // Bouton Supprimer
        echo '<form method="POST">';//met sur ma carte le formulaire pour supprimer la carte
        echo '<input type="hidden" name="idCarte" value="' . $carte['id'] . '">';//boutton invisible qui set a envoyer l'id de la carte
        echo '<button type="submit" class="sup"><img src="../image/croix-jaune.png"></button>';//bouton qui permet de soumettre le formulaire
        echo '</form>';


       //bouton favoris
        $id = $carte['id'];// prends id de la carte 
        $favori = $carte['favori'];//prend l'etat de la carte (si elle est favoris ou pas)

        if ($favori == 1) {//si oui on prepare une variable pour inverser mettre en non favoris
            $valeur_favori = 0;
            $image = "../image/coeur-plein.png";//on stock dans une variable le texte d'un img src pour avoir l'image d'un coeur plein
            $classe = "opaciterMax";//class qui permet d'annuler l'effet de l'over en mettant opaciter a 1
        } else {
            $valeur_favori = 1;//si non on prepare les donnés d'une catre favoris pour le formulaire
            $image = "../image/coeur-vide.png";//
            $classe = "";
        }

        echo '<form method="POST">';//formulaire favoris
        echo '<input type="hidden" name="id" value="' .$id. '">';//boutton invisible qui permet de donner l'id de la carte a la soumission du formulaire
        echo '<input type="hidden" name="favori" value="' .$valeur_favori. '">';//pareille mais pour la valeur preparé 
        echo '<button type="submit" class="non-favoris">';//soummet le formulaire
        echo '<img src="' .$image. '" class="' .$classe. '" alt="Favori"></button>';//met la 
        echo '</form>';
        echo '</div>'; 
    }
}
}
else{
    echo '<div class="msg-vide">Aucune carte en Favoris </div>';
}
?>
    </div>
</div>

<?php require_once("Bot-page.php"); ?>
<script src="../JS/scriptPage1.js"></script>
<script src="../JS/search.js"></script>
</body>
</html>

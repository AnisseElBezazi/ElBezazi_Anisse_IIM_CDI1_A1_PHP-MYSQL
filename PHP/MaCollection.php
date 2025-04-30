<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: formulaire.php');
    exit;
}

require_once("Top-page.php");
require_once("PDOconnexion.php");


// Bouton favoris

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


$id_user = $_SESSION['user']['iduser'];//je stock l'id de l'utillisateur 
$sql = "SELECT * FROM user_cartes WHERE id_user = :id_user"; //je met ma requete sql dans une variable 
$stmt = $pdo->prepare($sql);//je prepare ma requete sql
$stmt->execute(['id_user' => $id_user]); //j'execute ma requete pour l'id utillisateur 
$cartes = $stmt->fetchAll(PDO::FETCH_ASSOC);//je prend tout les ligne qui ont l'id utillisateur (toutes les cartes) que je met dans un tableau cartes
?>
<div class="tit">
<h1>📚 Ma Collection de Cartes</h1>
</div>

<div class="cartes2">
<!-- La je verifie si j'ai bien au moins une cartes pour mon utillisateur -->
    <?php if (count($cartes) > 0): ?>




        <!--Pour chaque cartes j'affiche en html avec les donné de la cartes -->
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






            <!-- Bouton de supprimer -->

            <form action="supprimer.php" method="POST" style="margin-top: 10px; text-align: center;"> 
                    <input type="hidden" name="id_carte" value="<?=$carte['id']?>">
                    <button type="submit" class = "sup">Supprimer cette carte</button>
                </form>





               <!-- Bouton favoris-->
            <?php
            
                $id = $carte['id'];//stock l'id de la carte
                $favori = $carte['favori'];//prend la valeur favoris actuel de la carte 

                if ($favori == 1) {// si la valeur est 1  
                    $valeur_favori = 0; //on met valeur favoris a 0 pour quand il sera envoyer lors du post 
                    $image = "../image/coeur-plein.png";//on met l'img de coeur plein 
                    $classe = "opaciterMax";//et on met cette class qui garde l'opacité a 1 pour empecher le hover
                } else {
                    $valeur_favori = 1; // Sinon, on l'ajoute
                    $image = "../image/coeur-vide.png";//on met l'img de coeur vide
                    $classe = "";//on met pas de class
                }
            ?>
               <form method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="favori" value="<?= $valeur_favori ?>">
                <button type="submit" class="non-favoris">
                    <img src="<?= $image ?>" class="<?= $classe ?>" alt="Favori">
                </button>
</form>




        </div>
   
    <?php endforeach; //je ferme la boucle Foreach?>
    
    <!-- Si il a pas de carte j'affiche un msg -->
    <?php else: ?>
        <div class="msg-vide">
      😥 Vous n'avez encore aucune carte... Allez ouvrir un booster !
      </div>
      <?php endif; ?>
</div>

<?php require_once("Bot-page.php"); ?>
<script src="../JS/scriptPage1.js"></script>
</body>
</html>

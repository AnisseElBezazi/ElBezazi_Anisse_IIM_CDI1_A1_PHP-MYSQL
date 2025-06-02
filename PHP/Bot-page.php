<?php
$id_user = $_SESSION['user']['iduser'];

if (isset($_POST['personne'], $_POST['cartes'])) {//si j'ai un post avec personne et cartes qui existe alors 
    $id_destinataire = $_POST['personne']; // stock le destinataire dans une variable 
    $id_carte = $_POST['cartes'];//pareil pour la carte

        $stmt = $pdo->prepare("UPDATE user_cartes SET id_user = :personne WHERE id = :cartes");
        $stmt->execute([
            'personne' => $id_destinataire,
            'cartes' => $id_carte]);
}

//on selectionne tout les utillisateur pour les mettre dans le select
$users = $pdo->prepare("SELECT iduser, pseudo FROM user WHERE iduser != :id");
$users->execute(['id' => $id_user]);//lie le paramettre id a ma variable id_user
$users = $users->fetchAll(PDO::FETCH_ASSOC);
$cartes = $pdo->prepare("SELECT id, nom FROM user_cartes WHERE id_user = :id");//pareil pour les cartes de l'utilisateur 
$cartes->execute(['id' => $id_user]);
$cartes = $cartes->fetchAll(PDO::FETCH_ASSOC);
?>

<footer>
    <div class="nous">
        <h5>À propos de nous</h5>
        <p>Je suis un jeune étudiant à l'IIM Digital School <br>cherchant à se surpasser tous les jours</p>
    </div>
    <div class="link">
        <h5>Liens rapides</h5>
        <p>Mentions légales<br><br>Politique de confidentialité<br><br>Conditions d'utilisation</p>
    </div>
    <div class="Follow">
        <h5>Suivez-nous</h5>
        <img src="../image/insta-grey.png" alt="insta" width="50px">
        <img src="../image/X-grey.png" alt="X" width="50px">
    </div>

    <button class="echange-bouton">Échanger</button>

    <div class="echange-body" id="modal">
        <div class="contenu-echange">
        <span class="croix">x</span>
        <h2>Échange de cartes</h2>
        <form class="page-echange" method="POST">
            <label for="personne">Choix de la personne :</label>
            <select id="personne" name="personne" required>
                 <?php
                foreach ($users as $user) {
                    echo '<option value="' .$user['iduser']. '">' . $user['pseudo']. '</option>';//pour chaque élement de ma base de ma table user j'affiche dans le select l'utillisateur 
                }
                ?>
            </select>

        <label for="cartes">Choix de la carte :</label>
        <select id="cartes" name="cartes" required>
            <?php
            foreach ($cartes as $carte) {
                echo '<option value="' .$carte['id']. '">' .$carte['nom']. '</option>';//pareille pour les cartes
            }
             ?>
        </select>
                <button type="submit" class="ech">Envoyer</button>
            </form>
        </div>
    </div>
</footer>
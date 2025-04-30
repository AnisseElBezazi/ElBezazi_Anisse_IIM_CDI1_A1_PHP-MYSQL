<?php

require_once("PDOconnexion.php"); // me permet de récupérer ma connexion

if ($_POST) {

    // var_dump($_POST);
    $title = $_POST["title"];
    $author = $_POST["author"];
    $date_publication = $_POST["date_publication"];

    try {
        $stmt = $pdo->prepare("INSERT INTO book (title, author, date_publication, category_idcategory) 
    VALUES( :title, :author, :date_publication, :category )");

        $stmt->execute([
            "title" => $title,
            "author" => $author,
            "date_publication" => $date_publication,
            "category" => 1,
        ]);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

if(isset($_GET['action']) && $_GET['action'] == 'delete') {

    $idbook = $_GET['id_book'];

    try {
        $stmt = $pdo->prepare("DELETE FROM book WHERE idbook = :idbook");

        $stmt->execute([
            "idbook" => $idbook,
        ]);

        echo "Le livre a bien été supprimé !";

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

///// 
///// SELECT
/////



if (isset($_GET['filtre']) && $_GET['filtre'] === 'apres2000') {//si on a en parametre dans l'url filter et que il est a =apres2000 

    $stmt = $pdo->query("SELECT * FROM book WHERE date_publication > '2000-01-01'");//alors on selectionne les livres sortie apres 2000 dans la base de donné
} else {
    $stmt = $pdo->query("SELECT * FROM book");
}

$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Mes livres en BDD</h1>


    <h2>Filtres :</h2>
<a href="?">Afficher tous les livres</a>  
<a href="?filtre=apres2000">Afficher les livres publiés après 2000</a>
<br><br>

    <table border="1">
        <thead>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Date</th>
            <th>Catégorie</th>
            <th>disponible</th>
            <th>Action</th>
        </thead>

        <tbody>

            <?php

            foreach ($books as $key => $book) {
                echo "<tr>";
                echo "<td>" . $book["title"] . "</td>";
                echo "<td>" . $book["author"] . "</td>";
                echo "<td>" . $book["date_publication"] . "</td>";
                echo "<td>" . $book["category_idcategory"] . "</td>";
                echo "<td>" . $book["disponible"] . "</td>";
                echo "<td> <a href='?id_book=". $book["idbook"] . "&action=delete'> Supprimer </a> </td>";
                echo "</tr>";
            }

            ?>

        </tbody>
    </table>

    <br>
    <br>
    <form method="POST">

        <label for="title">Titre:</label>
        <input type="text" name="title" id="title" placeholder="Titre">


        <label for="author">Auteur:</label>
        <input type="text" name="author" id="author" placeholder="Auteur">


        <label for="date_publication">Titre:</label>
        <input type="date" name="date_publication" id="date_publication">

        <input type="submit" value="Créer livre">

    </form>

</body>

</html>
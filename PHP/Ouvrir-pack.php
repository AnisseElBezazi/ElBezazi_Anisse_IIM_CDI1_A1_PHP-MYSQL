<?php
session_start();
require_once("PDOconnexion.php");
require 'vendor/autoload.php';

use GuzzleHttp\Client;

if (!isset($_SESSION['user'])) {
    header("Location: formulaire.php");
    exit();
}

$id_user = $_SESSION['user']['iduser'];
$client = new Client();
$cartesTirees = [];//crée un tableau qui contiendra les cartes tirée

for ($i = 0; $i < 3; ) { //Tant que i est inferieur a 3 bah on continue a tirer des cartes (permet de tirer donc 3 cartes )
    $id_random = rand(1, 900); //stock dans une variable un nombre entre 1 et 1300
    $url = "https://pokeapi.co/api/v2/pokemon/$id_random";//on met dans l'url le nombre apres pokemon pour avoir le pokemon correspondant a  l'url.

    try {
        $i++;//incremente
        $response = $client->request('GET', $url);//requete de de l'url grace a guzzle
        $details = json_decode($response->getBody(), true);//decode la reponse 

        $nom = $details['name'];// on prend dans l'api le nom du pokemon  et on le stock dans une variable 
        $image = $details['sprites']['versions']['generation-v']['black-white']['animated']['front_default']?? $details['sprites']['other']['official-artwork']['front_default'];
        $type = $details['types'][0]['type']['name'];//pareille pour le type 
        $pv = $details['stats'][0]['base_stat'];

        // Capacité 1
        $capacite1 = $details['abilities'][0]['ability']['name'];
        $url_capacite1 = $details['abilities'][0]['ability']['url'];//2eme api pour la capacité 
        $capResponse1 = $client->request('GET', $url_capacite1);//requete de l'api 
        $capDetails1 = json_decode($capResponse1->getBody(), true);// decode la reponse

        $description1 = '';
        //permet d'avoir la description en anglais
        foreach ($capDetails1['effect_entries'] as $entry) {
            if ($entry['language']['name'] === 'en') {//On verifie si dans l'objet language, l'objet name contient "en"  
                $description1 = $entry['short_effect'];
                break;
            }
        }

        // Capacité 2 (si elle existe)
        $capacite2 = '';
        $description2 = '';
        
        if (isset($details['abilities'][1]['ability']['name'])) {//on verifie si la capacité2 existe avant de faire une requete 
            $capacite2 = $details['abilities'][1]['ability']['name'];
            $url_capacite2 = $details['abilities'][1]['ability']['url'];//api pour la description de la deuxieme capacité 
            $capResponse2 = $client->request('GET', $url_capacite2);
            $capDetails2 = json_decode($capResponse2->getBody(), true);

            foreach ($capDetails2['effect_entries'] as $entry) {//pareille que pour la capacité 1
                if ($entry['language']['name'] === 'en') {
                    $description2 = $entry['short_effect'];
                    break;
                }
            }
        }

       
        $sql="INSERT INTO user_cartes (id_user, nom, image, type, pv, capacite1, description1, capacite2, description2) VALUES (:id_user, :nom, :image, :type, :pv, :capacite1, :description1, :capacite2, :description2)";
        $stmt = $pdo->prepare($sql);//prepare la requete sql
        $stmt->execute([//execute la requete et stock dans leur endroit respectif chaque élément de la cartes  
            'id_user' => $id_user,
            'nom' => $nom,
            'image' => $image,
            'type' => $type,
            'pv' => $pv,
            'capacite1' => $capacite1,
            'description1' => $description1,
            'capacite2' => $capacite2,
            'description2' => $description2
        ]);

        $cartesTirees[] = //puis on stock celle ci dans une liste contenant des tableau associatif  pour pouvoir les afficher
        [
            'nom' => $nom,
            'image' => $image,
            'type' => $type,
            'pv' => $pv,
            'capacite1' => $capacite1,
            'description1' => $description1,
            'capacite2' => $capacite2,
            'description2' => $description2
        ];

    } catch (Exception $e) {
        die("Erreur API : " . $e->getMessage());
    }
}

$_SESSION['cartes_tirees'] = $cartesTirees;//on crée une session avec les cartes tirées 
header("Location: resultat-pack.php");
exit();
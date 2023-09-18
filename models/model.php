<?php

function connect(){
    require('../models/bdd.php');
    $chaine_connexion="mysql:host=localhost;dbname=" . $db;
    try{ // à tester
        $connexion=new PDO($chaine_connexion, $login, $pass);
    }
    catch (Exception $e) // si erreur
    {
        echo "erreur: " . $e->getMessage() . ""; // écrit le message d'erreur retourné
        die;
    }
    return $connexion;
}

function getWeek($connexion){
    $week = "";
    // $requete = "SELECT * FROM repertoire WHERE sortie>(DATE_SUB(CURDATE(), INTERVAL 8 DAY))"; // choix requête
    $requete = "SELECT * FROM repertoire WHERE sortie>(DATE_SUB('2022-11-05', INTERVAL 8 DAY))"; // choix requête
    $resultats = $connexion->query($requete); // on envoit la requête 
    foreach($resultats as $ligne){
        $week .= "<img src='../assets/affiches/" . $ligne['fichier'] . "' alt='' id='" . $ligne['id'] . "'>";
    }
    return $week;
}

function getOlds($connexion){
    $olds = "";
    $requete = "SELECT * FROM repertoire WHERE YEAR(sortie)<1980"; // choix requête
    $resultats = $connexion->query($requete); // on envoit la requête 
    foreach($resultats as $ligne){
        $olds .= "<img src='../assets/affiches/" . $ligne['fichier'] . "' alt='' id='" . $ligne['id'] . "'>";
    }
    return $olds;
}

function getGenders($connexion, $gender){
    $all = "";
    $requete = "SELECT * FROM repertoire WHERE genre_id='" . $gender . "'"; // choix requête
    $resultats = $connexion->query($requete); // on envoit la requête 
    foreach($resultats as $ligne){
        $all .=  "<img src='../assets/affiches/" . $ligne['fichier'] . "' alt='' id='" . $ligne['id'] . "'>";
    }
    return $all;
}

function getMovies($connexion, $id){
    $une = "";
    $requete = "SELECT * FROM repertoire JOIN genres ON repertoire.genre_id = genres.id WHERE repertoire.id='" . $id  . "'"; // choix requête

    $resultats = $connexion->query($requete); // on envoit la requête 

    foreach($resultats as $ligne){
        $une .= "<h1>" . $ligne['titre'] . "</h1>";
        $une .= "<div>" . $ligne['genre'] . "</div>";
        $une .= "<div>" . $ligne['realisateur'] . "</div>";
        $une .= "<div>" . str_replace('-', '/', (date('d-m-Y', strtotime($ligne['sortie'])))) . "</div>";
        $une .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $ligne['lien'] . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        $une .= "<p>" . $ligne['synopsis'] . "</p>";
    }
    return $une;
}

function getError(){
    $erreur404 = "

    <p>La page que vous recherchez n'existe pas</p>
    
    ";

    return $erreur404;
}







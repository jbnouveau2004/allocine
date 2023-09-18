<?php

require('../models/bdd.php');
require('../models/model.php');
$connexion = connect($db, $login, $pass);

if(strlen($_POST['lettre'])>=2){
    $lettres = str_replace("'", "&#039;", htmlentities($_POST['lettre'])); // pas le choix sinon la requête retourne "bool(false)"
    $requete = "SELECT * FROM repertoire WHERE titre LIKE '" . $lettres  . "%';"; // choix requête
    $resultats = $connexion->query($requete); // on envoit la requête 

    $tag='<ul>';

    foreach($resultats as $ligne){
        $mot = "'" . $ligne['titre'] . "'";
        $tag = $tag . '<li onclick="choix(' . htmlentities($mot) . ')">' . $ligne['titre'] . '</li>'; // htmlentities pas le choix sinon ça beug
    }

    $tag = $tag . '</ul>';
    echo $tag;

}
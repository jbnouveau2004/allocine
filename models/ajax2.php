<?php

require('../models/bdd.php');
require('../models/model.php');
$connexion = connect($db, $login, $pass);

$requete = "SELECT * FROM repertoire WHERE titre='" . htmlentities($_POST['titre']) . "';"; // choix requête
$resultats = $connexion->query($requete); // on envoit la requête 

foreach($resultats as $ligne){
    echo $ligne['id']; // on renvoit id pour le lien en javascript à la méthode GET
}

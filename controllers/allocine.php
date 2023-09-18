<?php


require('../models/model.php');
$connexion = connect();


if(isset($_GET['p'])){
    if($_GET['p']=='m'){
    $week = getWeek($connexion);
    $olds = getOlds($connexion);
    require('../views/indexview.php');
    $content = $aLaUne;
    require('../views/homepage.php');
    }else if($_GET['p']=='g'){
        if($_GET['g']>0 && $_GET['g']<10 && $_GET['g']!=8){
            $requete = "SELECT * FROM genres WHERE id='" . $_GET['g'] . "'"; // choix requête
            $resultats = $connexion->query($requete); // on envoit la requête
            foreach($resultats as $ligne){
                $title = $ligne['genre'];
            } 
            $all = getGenders($connexion, $_GET['g']);
            require('../views/indexview.php');
            $content = $genre;
            require('../views/homepage.php');
        }else{
            $erreur404 = getError();
            require('../views/indexview.php');
            $content = $erreur;
            require('../views/homepage.php');
        }
    }else if($_GET['p']=='a'){
        $une = getMovies($connexion, $_GET['i']);
        if($une==""){
            $erreur404 = getError();
            require('../views/indexview.php');
            $content = $erreur;
            require('../views/homepage.php');
        }else{
            require('../views/indexview.php');
            $content = $films;
            require('../views/homepage.php');
        } 
    }else{
        $erreur404 = getError();
        require('../views/indexview.php');
        $content = $erreur;
        require('../views/homepage.php');
    }
}else{
    $erreur404 = getError();
    require('../views/indexview.php');
    $content = $erreur;
    require('../views/homepage.php');
}
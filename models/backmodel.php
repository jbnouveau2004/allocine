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

function identification($connexion, $utilisateur, $mdp){
    $test = false;
    $requete = "SELECT * FROM administration WHERE utilisateur='" . htmlentities($utilisateur) . "' AND mdp='" . htmlentities($mdp) . "'"; // choix requête
    $resultats = $connexion->query($requete); // on envoit la requête 
    foreach($resultats as $ligne){
        $test = true;
        // session_start();
        $_SESSION['role'] = 'administrateur';
    }
    return $test;
}

function deconnexion(){
    unset($_SESSION['role']);
}

function movies_listing($connexion){
    $listing = "";

    $requete = "SELECT * FROM repertoire"; // choix requête
    $resultats = $connexion->query($requete); // on envoit la requête 

    foreach($resultats as $ligne){
        $listing .= "<tr>";
        $listing .= "<td>" . $ligne['titre'] . "</td><td>" . $ligne['sortie'] . "</td><td>" . $ligne['lien'] . "</td><td><img src='../assets/affiches/" . $ligne['fichier'] . "' width='50px'></td>";
        $listing .= "<td><form action='../controllers/backoffice.php' method='POST'><input type='hidden' name='id' value='" . $ligne['id'] . "'><input type='submit' name='modif' value='Modifier'></form></td>";
        $listing .= "<td><form action='../controllers/backoffice.php' method='POST'><input type='hidden' name='id' value='" . $ligne['id'] . "'><input type='submit' name='supprimer' value='Supprimer'></form></td>";
        $listing .= "</tr>";
    }
    return $listing;
}

function movies_modifications($connexion, $movie_id){
    $modif_form = "";

    $requete = "SELECT * FROM repertoire WHERE id=" . $movie_id . ""; // choix requête
    $resultats = $connexion->query($requete); // on envoit la requête 
    
    foreach($resultats as $ligne){
        $modif_form .= '
        <div id="formulaire_modif">
            <form action="../controllers/backoffice.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" class="id" name="id" id="id" value="' . $ligne["id"] . '">
                <div id="division">
                <label for="titre">Titre</label>
                <input type="text" class="titre" name="titre" id="titre" size="100" value="' . $ligne["titre"] . '">
                </div>
                <div id="division">
                <label for="synopsis">Synopsis</label>
                <textarea  cols="93" rows="10" class="synopsis" name="synopsis" id="synopsis">' . $ligne["synopsis"] . '</textarea>
                </div>
                <div id="division">
                <label for="date">Date de sortie</label>
                <input type="date" class="date" name="date" id="date" value="' . $ligne["sortie"] . '">
                </div>
                <div id="division">
                <label for="genre">Genre</label>
                <select name="genre" class="genre" id="genre">
                    <option value="1" '; if($ligne["genre_id"]==1){$modif_form .= 'selected';} $modif_form .= '>Aventure – Guerre – Histoire – Action</option>
                    <option value="2" '; if($ligne["genre_id"]==2){$modif_form .= 'selected';} $modif_form .= '>Comédie</option>
                    <option value="3" '; if($ligne["genre_id"]==3){$modif_form .= 'selected';} $modif_form .= '>Drame – Comédie dramatique</option>
                    <option value="4" '; if($ligne["genre_id"]==4){$modif_form .= 'selected';} $modif_form .= '>Fiction jeunesse (film ou animation)</option>
                    <option value="5" '; if($ligne["genre_id"]==5){$modif_form .= 'selected';} $modif_form .= '>Film musical</option>
                    <option value="6" '; if($ligne["genre_id"]==6){$modif_form .= 'selected';} $modif_form .= '>Policier – espionnage</option>
                    <option value="7" '; if($ligne["genre_id"]==7){$modif_form .= 'selected';} $modif_form .= '>Science fiction – fantastique – horreur</option>
                    <option value="8" '; if($ligne["genre_id"]==8){$modif_form .= 'selected';} $modif_form .= '>Western</option>
                    <option value="9" '; if($ligne["genre_id"]==9){$modif_form .= 'selected';} $modif_form .= '>Documentaires pour adultes et enfants</option>
                </select>
                </div>
                <div id="division">
                <label for="realisateur">Réalisateur</label>
                <input type="text" class="realisateur" name="realisateur" id="realisateur" size="100" value="' . $ligne["realisateur"] . '">
                </div>
                <div id="division">
                <label for="lien">Code youtube</label>
                <input type="text" class="lien" name="lien" id="lien" size="100" value="' . $ligne["lien"] . '">
                </div>
                <div id="division">
                <label for="affiche">Choix de l\'affiche</label>
                <input type="text" id="affiche_back" name="affiche_back" class="affiche_back" value="' . $ligne["fichier"] . '" disabled>&nbsp;ou&nbsp;
                <input type="file" id="affiche2" name="affiche2" class="affiche2" accept="image/png, image/jpeg">
                </div>
                <div id="division">
                <input type="submit" value="Modifier" name="modifier" class="bouton">
                </div>
            </form>
        </div>
        ';
    }

    return $modif_form;
}
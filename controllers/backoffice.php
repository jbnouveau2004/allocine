<?php
session_start();
// var_dump($_SESSION['role']);

require('../models/backmodel.php');
$connexion = connect();

if(isset($_GET['deconnexion'])){
    deconnexion();
}

if (isset($_SESSION['role'])){
    if($_SESSION['role'] == "administrateur"){

        if(isset($_POST['supprimer'])){ // si supprimer
            $requete = "SELECT * FROM repertoire WHERE id='" . $_POST['id'] . "';"; // choix requête
            $resultats = $connexion->query($requete); // on envoit la requête 
            foreach($resultats as $ligne){ // on effface le fichier
                $dossier_cible = "../assets/affiches/";
                $nom_fichier = $ligne['fichier'];
                $fichier_cible = $dossier_cible . $nom_fichier;
                unlink($fichier_cible);
            } // on efface la ligne de la bdd
            $requete = "DELETE FROM repertoire WHERE id='" . $_POST['id'] . "' ;"; // choix requête
            $resultats = $connexion->query($requete); // on envoit la requête 
        }

        else if(isset($_POST['ajouter'])){ // si ajouter
            $dossier_cible = "../assets/affiches/";
            $nom_fichier = basename($_FILES["affiche"]["name"]);
            $fichier_cible = $dossier_cible . $nom_fichier;
            $extension_fichier = strtolower(pathinfo($fichier_cible,PATHINFO_EXTENSION));
            $nom_fichier_sans_extension = strtolower(pathinfo($fichier_cible,PATHINFO_FILENAME));
            $i = 0;

            while (file_exists($fichier_cible)) { // si le fichier existe déjà
                $i += 1; // on incrémente le nom di fichier par un chiffre à la fin
                $nom_fichier = $nom_fichier_sans_extension . $i . "." . $extension_fichier;
                $fichier_cible = $dossier_cible . $nom_fichier;
            }


            if (move_uploaded_file($_FILES["affiche"]["tmp_name"], $fichier_cible)){ // si upload de l'image effectué
                $requete = "INSERT repertoire VALUES (NULL, '" . htmlentities($_POST['titre']) . "', '" . htmlentities($_POST['synopsis']) . "', '" . $_POST['date'] . "', '" . $_POST['genre'] . "', '" . htmlentities($_POST['realisateur']) . "', '" . $_POST['lien'] . "', '" . htmlentities($nom_fichier) . "');"; // choix requête
                $resultats = $connexion->query($requete); // on envoit la requête 
            }
        }

        else if(isset($_POST['modifier'])){ // si modification
            if ($_FILES["affiche2"]["name"]){ // si un choix d'une autre image
                $requete = "SELECT * FROM repertoire WHERE id='" . $_POST['id'] . "';"; // choix requête
                $resultats = $connexion->query($requete); // on envoit la requête 
                foreach($resultats as $ligne){ // après récupération du nom de l'ancienne image, on le supprime
                    $dossier_cible = "../assets/affiches/";
                    $nom_fichier = $ligne['fichier'];
                    $fichier_cible = $dossier_cible . $nom_fichier;
                    unlink($fichier_cible);
                } // on ajoute la nouvelle image
                $dossier_cible = "../assets/affiches/";
                $nom_fichier = basename($_FILES["affiche2"]["name"]);
                $fichier_cible = $dossier_cible . $nom_fichier;
                $extension_fichier = strtolower(pathinfo($fichier_cible,PATHINFO_EXTENSION));
                $nom_fichier_sans_extension = strtolower(pathinfo($fichier_cible,PATHINFO_FILENAME));
                $i = 0;
            
                while (file_exists($fichier_cible)) { // si le fichier existe déjà
                    $i += 1; // on incrémente le nom di fichier par un chiffre à la fin
                    $nom_fichier = $nom_fichier_sans_extension . $i . "." . $extension_fichier;
                    $fichier_cible = $dossier_cible . $nom_fichier;
                }
                if (move_uploaded_file($_FILES["affiche2"]["tmp_name"], $fichier_cible)){ // si upload de l'image effectué
                    $requete = "UPDATE repertoire SET titre='" . htmlentities($_POST['titre']) . "', synopsis='" . htmlentities($_POST['synopsis']) . "', sortie='" . $_POST['date'] . "', genre_id='" . $_POST['genre'] . "', realisateur='" . htmlentities($_POST['realisateur']) . "', lien='" . $_POST['lien'] . "', fichier='" . htmlentities($nom_fichier) . "' WHERE id='" . $_POST['id'] . "';"; // choix requête
                    $resultats = $connexion->query($requete); // on envoit la requête 
                }


            }else{ // si les modifications ne comporte pas d'une nouvelle image
                $requete = "UPDATE repertoire SET titre='" . htmlentities($_POST['titre']) . "', synopsis='" . htmlentities($_POST['synopsis']) . "', sortie='" . $_POST['date'] . "', genre_id='" . $_POST['genre'] . "', realisateur='" . htmlentities($_POST['realisateur']) . "', lien='" . $_POST['lien'] . "' WHERE id='" . $_POST['id'] . "';"; // choix requête
                $resultats = $connexion->query($requete); // on envoit la requête 
            }
        }

        else if(isset($_POST['modif'])){
            require('../views/backview.php');
            $content_connect = $deconnexion;
            require('../views/backview.php');
            $modif_form = movies_modifications($connexion, $_POST['id']);
            require('../views/backview.php');
            $content_up = $modification;
            $listing = movies_listing($connexion);
            require('../views/backview.php');
            $content_down = $laliste;
            require('../views/backpage.php');
        }


        if(!isset($_POST['modif'])){
            require('../views/backview.php');
            $content_connect = $deconnexion;
            $content_up = $formulaire_vide;
            $listing = movies_listing($connexion);
            require('../views/backview.php');
            $content_down = $laliste;
            require('../views/backpage.php');
        }

    }



}else if(isset($_POST['connexion'])){
    $test = identification($connexion, $_POST['utilisateur'], $_POST['mdp']);
    if ($test == true){
        require('../views/backview.php');
        $content_connect = $deconnexion;
        $content_up = $formulaire_vide;
        $listing = movies_listing($connexion);
        require('../views/backview.php');
        $content_down = $laliste;
        require('../views/backpage.php');
    }else{
        echo "Vos identifiants ne sont pas reconnus";
    }

    }else {
            require('../views/backview.php');
            $content_connect = "";
            $content_up = $admin_connect;
            $content_down = "";
            require('../views/backpage.php');
}

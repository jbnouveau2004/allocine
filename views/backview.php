<!----------------------------Connexion Administration----------------------------------------->
<?php ob_start(); ?>

<h1>Connexion au Backoffice</h1>

<form action="../controllers/backoffice.php" method="POST" id="post_connexion">
    <label for="utilisateur">Login</label>
    <input type="text" name="utilisateur" id="utilisateur">
    <label for="mdp">Mot de passe</label>
    <input type="password" name="mdp" id="mdp">
    <input type="submit" name="connexion" value="Connexion">
</form>

<?php $admin_connect = ob_get_clean(); ?>

<!----------------------------Barre de déconnexion----------------------------------------->
<?php ob_start(); ?>

<h1>Connecté</h1>

<form action="../controllers/backoffice.php" method="GET">
    <input type="hidden" name="deconnexion">
    <input type="submit" value="Déconnexion">
</form>

<?php $deconnexion = ob_get_clean(); ?>

<!----------------------------Affichage du formulaire vide----------------------------------------->
<?php ob_start(); ?>

<h1>Ajouter un nouveau film</h1>
<div id="formulaire_vide">
        <form action="../controllers/backoffice.php" method="POST" enctype="multipart/form-data">
            <div id="division">
            <label for="titre">Titre</label>
            <input type="text" class="titre" name="titre" id="titre" size="100">
            </div>
            <div id="division">
            <label for="synopsis">Synopsis</label>
            <textarea  cols="93" rows="10" class="synopsis" name="synopsis" id="synopsis"></textarea>
            </div>
            <div id="division">
            <label for="date">Date de sortie</label>
            <input type="date" class="date" name="date" id="date">
            </div>
            <div id="division">
            <label for="genre">Genre</label>
            <select name="genre" class="genre" id="genre" required>
                <option value="0"></option>
                <option value="1">Aventure – Guerre – Histoire – Action</option>
                <option value="2">Comédie</option>
                <option value="3">Drame – Comédie dramatique</option>
                <option value="4">Fiction jeunesse (film ou animation)</option>
                <option value="5">Film musical</option>
                <option value="6">Policier – espionnage</option>
                <option value="7">Science fiction – fantastique – horreur</option>
                <option value="8">Western</option>
                <option value="9">Documentaires pour adultes et enfants</option>
            </select>
            </div>
            <div id="division">
            <label for="realisateur">Réalisateur</label>
            <input type="text" class="realisateur" name="realisateur" id="realisateur" size="100">
            </div>
            <div id="division">
            <label for="lien">Code youtube</label>
            <input type="text" class="lien" name="lien" id="lien" size="100">
            </div>
            <div id="division">
            <label for="affiche">Choix de l'affiche</label>
            <input type="file" id="affiche" name="affiche" class="affiche" accept="image/png, image/jpeg" required>
            </div>
            <input type="submit" name="ajouter" value="Ajouter" id="ajouter" class="bouton">
        </form>
    </div>

<?php $formulaire_vide = ob_get_clean(); ?>


<!----------------------------listing de tout les films----------------------------------------->
<?php ob_start(); ?>

<h1>Répertoire</h1>
<table>
<tr><th>Titre</th><th>Date de sortie</th><th>Code Youtube</th><th>Affiche</th><th></th><th></th></tr>

<?=$listing?>

<?php $laliste = ob_get_clean(); ?>

<!----------------------------Formulaire à modifer----------------------------------------->
<?php ob_start(); ?>

<h1>Modifier les informations de ce film</h1>
<?=$modif_form?>
<form action="#" method="GET">
    <input type="submit" name="annuler" value="Annuler la modification" id="annuler" class="bouton">
</form>

<?php $modification = ob_get_clean(); ?>
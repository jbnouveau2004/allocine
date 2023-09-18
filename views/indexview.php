<!--------------------------A la une-------------------------------------->
<?php ob_start(); ?>

<h1>A la une</h1>

<h3>Dernières sorties enregistrées du 28 octobre au 05 novembre 2022</h3>

<canvas id="canvas1" width="800" height="200">
    <?=$week;?>
</canvas>

<h3>Sorties avant 1980</h3>

<canvas id="canvas2" width="800" height="200">
    <?=$olds;?>
</canvas>

<h3>Recherche un film</h3>
<div class=recherche>
    <input id="recherche" placeholder="Entrer le titre"><button onclick="go()">Go</button>
    <div id="menu"></div>
</div>

<?php $aLaUne = ob_get_clean(); ?>

<!----------------------------Par genre----------------------------------------->
<?php ob_start(); ?>

<h1><?=$title?></h1>

<h3>A l'affiche</h3>

<canvas id="canvas1" width="<?php if($_GET['g']==5){echo '500';}else{echo '800';} ?>" height="200">
    <?=$all?>
</canvas>

<?php $genre = ob_get_clean(); ?>

<!----------------------------Par film----------------------------------------->
<?php ob_start(); ?>

<?=$une?>

<?php $films = ob_get_clean(); ?>

<!----------------------------Page 404----------------------------------------->
<?php ob_start(); ?>

<h1>Erreur 404</h1>

<?=$erreur404?>

<?php $erreur = ob_get_clean(); ?>
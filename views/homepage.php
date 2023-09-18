<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/jquery-3.6.0.js"></script>
    <script src="../assets/js/main.js" defer></script>
    <script src="../assets/js/main_1.js" defer></script>
    <script src="../assets/js/main_2.js" defer></script>
    <script src="../assets/js/genres.js" defer></script>
    <title>Document</title>
</head>
<body>

    <div class="header">
        <div class="gauche">
            <a href="../controllers/allocine.php?p=m" class="lien">A LA UNE</a>
        </div>
        <div class="droite">
            <a href="../controllers/allocine.php?p=g&g=1" class="lien"><div>Aventure</div><div>Guerre</div><div>Action</div></a>
            <a href="../controllers/allocine.php?p=g&g=2" class="lien">Comédie</a>
            <a href="../controllers/allocine.php?p=g&g=3" class="lien"><div>Drame</div></a>
            <a href="../controllers/allocine.php?p=g&g=4" class="lien">Jeunesse</a>
            <a href="../controllers/allocine.php?p=g&g=5" class="lien">Film musical</a>
            <a href="../controllers/allocine.php?p=g&g=6" class="lien"><div>Policier</div></a>
            <a href="../controllers/allocine.php?p=g&g=7" class="lien"><div>Fiction</div><div>fantastique</div><div>horreur</div></a>
            <a href="../controllers/allocine.php?p=g&g=9" class="lien">Documentaires</a>
        </div>
    </div>
    
    <div class="container">

    <?=$content?>

    </div>

    <div class="footer">

    <img src="../assets/img/réseaux.png" alt="Réseaux soxiaux">
    <div>© 2023 Allociné Tous droits réservés.</div>
        
    </div>

</body>
</html>
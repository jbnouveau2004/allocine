<?php

if(isset($_GET['admin'])){
    header('Location: ./controllers/backoffice.php');
    // header('Location: ./admin/homepage.php');
    exit();
}else{
    header('Location: ./controllers/allocine.php?p=m');
    exit();
}




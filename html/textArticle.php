<?php
    include '../database/connectDB.php';
    include '../database/selectDB.php';
    include 'affichage.php';    

        $connect = connectBDD();

        $stmt = textArticle($connect, $idCategorie);
        afficherTextArticle($stmt); 
?>
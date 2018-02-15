<?php
    include '../database/connectDB1.php';
    include '../database/selectDB.php';
    include 'affichage.php';

        $connect = connectBDD();

        if(isset($_GET['id'])){
            $idArticle = $_GET['id'];

            $stmt = textArticle($connect, $idArticle);
            afficherTextArticle($stmt);
        }
?>

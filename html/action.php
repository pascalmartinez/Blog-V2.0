<?php
    include '../database/connectDB1.php';
    include '../database/selectDB.php';
    include 'affichage.php';

    if(isset($_GET['idc'])){
        $idCategorie = $_GET['idc'];

        $connect = connectBDD();
        $stmt = selectCard($connect, $idCategorie);
        afficherCard($stmt);
    }

?>

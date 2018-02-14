<?php
    include '../database/connectDB.php';
    include '../database/selectDB.php';
    include 'affichage.php';

    echo "ygkvbhnmjobv hjbklm:";

    if(isset($_GET['idc'])){
        $idCategorie = $_GET['idc'];

        $connect = connectBDD();
        $stmt = selectCard($connect, $idCategorie);
        afficherCard($stmt);
    }

?>
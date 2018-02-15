<?php
    include '../database/connectDB.php';
    include '../database/selectDB.php';
    include 'uploadFile.php' ;

    $connect=connectBDD();

    //récupération des valeurs des champs:
    $nom = $_POST["nom"];
    $email = strtolower($_POST["email"]);
    $titremessage = $_POST["titremessage"];
    $message = $_POST["message"];
    $categorie = $_POST["categorie"];

    if(isset($_FILES['fichier']['name'])){
        $fichier = $_FILES['fichier']['name'];
    }
    else{
        $fichier = "";
    }

    if (isset($_POST["nom"])) {
        echo 'Cette variable existe, donc je peux l\'afficher.';
    }
        
    formulaire($connect, $nom, $email, $categorie, $titremessage, $message, $fichier);
    fichier();
?>

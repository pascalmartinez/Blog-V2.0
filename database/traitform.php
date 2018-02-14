<?php
    include 'connectDB.php';

    function formulaire($connect){

    //récupération des valeurs des champs:
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $titremessage = $_POST["titremessage"];
        $message = $_POST["message"];
        $categorie = $_POST["categorie"];

        if(isset($_POST['customFile'])){
            $fichier = $_POST["customFile"];
        }
        else{
            $fichier = "";
        }

        if (isset($_POST["nom"])) {
            echo 'Cette variable existe, donc je peux l\'afficher.';
        }

        try{
            $sql = "INSERT INTO auteur (nom_auteur, mail)
                VALUES ('$nom', '$email')";
                // use exec() because no results are returned
            $connect->query($sql);            
            echo "Nouvel auteur enregistré";
            
            $sql = "SELECT id_auteur FROM auteur WHERE mail='$email'"; 
            $resultat = $connect->query($sql);  
            $row=$resultat->fetch();
 
            $sql = "INSERT INTO article (id_auteur, id_categorie, date, titre, texte, url_img)
            VALUES ('".$row['id_auteur']."', '$categorie', NOW(), '$titremessage','$message','$fichier')";
            // use exec() because no results are returned
            $connect->exec($sql);            
            echo "Nouveau post enregistré";            
            }
        catch(PDOException $e){
            echo "Request failed : " . $e->getMessage();
            }
    }

        $connect=connectBDD();
        formulaire($connect);

        header("Location: ../index.php");
?>

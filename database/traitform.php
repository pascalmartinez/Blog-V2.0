<?php
    include 'connectDB.php';

    function formulaire($connect){

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


    function fichier(){

            $target_dir = "../sources/images/";
            $target_file = $target_dir .basename ($_FILES["fichier"]["name"]);

            // move_uploaded_file(($_FILES["img"]["tmp_name"],$target_dir,$target_file);
        try {

            if (file_exists($target_file)) {
                $err= "Ce nom de fichier est déjà dans la base.";
                return $err;

            }

            if(move_uploaded_file($_FILES['fichier']['tmp_name'], $target_file)) {
                echo "L'image ".  basename( $_FILES['fichier']['name']).
                "a bien été chargé!";
            } else{
                echo "Le fichier n'a pas était chargé! Merci de réessayer";
            }


            header("Location: ../index.php");

        } catch (\Exception $e) {
                echo "Request failed : " . $e->getMessage();

        }

            // $uploadOk = 1;
            // $imageFileType = strtolower (pathinfo($target_file,PATHINFO_EXTENSION));
            //     //vérifie si le fichier est une image
            //
            // if(isset ($_POST ["fichier"])){
            //     $check = getimagesize($_FILES["fichier"]["tmp_name"]);
            //     if($check !== false) {
            //         echo "Le fichier est une image- " . $check["mime"] . ".";
            //         $uploadOk = 1;
            //     } else {
            //         echo "Le fichier n'est pas une image.";
            //         $uploadOk = 0;
            //     }
            // }

            // // Check la taille
            // if ($_FILES["fichier"]["size"] > 500000) {
            //     echo "Sorry, c'est pas la taille qui compte mais quand meme, merci de mettre un fichier plus petit.";
            // $uploadOk = 0;
            // }
            // // Autorise certains formats de fichiers
            // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            // && $imageFileType != "gif" ) {
            //     echo "Sorry, seuls les formats JPG, JPEG, PNG & GIF sont supportés.";
            //     $uploadOk = 0;
            // }

    }


        $connect=connectBDD();
        formulaire($connect);
        fichier();


?>

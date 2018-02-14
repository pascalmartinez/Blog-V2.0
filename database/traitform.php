<?php
    include 'connectDB.php';

    function formulaire($connect){

    //récupération des valeurs des champs:
        $nom = $_POST["nom"];
        $email = strtolower($_POST["email"]);
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


    function fichier(){

            $target_dir = "/sources/images";
            $target_file = $target_dir .basename ($_FILES["customFile"]["tmp_name"]);
            $uploadOk = 1;
            $imageFileType = strtolower (pathinfo($target_file,PATHINFO_EXTENSION));
                //vérifie si le fichier est une image

            if(isset ($_POST ["submit"])){
                $check = getimagesize($_FILES["customFile"]["tmp_name"]);
                if($check !== false) {
                    echo "Le fichier est une image- " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "Le fichier n'est pas une image.";
                    $uploadOk = 0;
                }
            }

            // Check si le fichier existe déjà
            if (file_exists($target_file)) {
                echo "Ce nom de fichier est déjà dans la base.";
            $uploadOk = 0;
            }
            // Check la taille
            if ($_FILES["customFile"]["size"] > 500000) {
                echo "Sorry, c'est pas la taille qui compte mais quand meme, merci de mettre un fichier plus petit.";
            $uploadOk = 0;
            }
            // Autorise certains formats de fichiers
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, seuls les formats JPG, JPEG, PNG & GIF sont supportés.";
                $uploadOk = 0;
            }

    }


        $connect=connectBDD();
        formulaire($connect);

        header("Location: ../index.php");
?>

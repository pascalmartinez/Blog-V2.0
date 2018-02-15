<?php 
    function fichier(){
        //Gère la partie upload image
        
        $target_dir = "../sources/images/";
        $target_file = $target_dir .basename ($_FILES["fichier"]["name"]);

        try{
            if (file_exists($target_file)) {
                $err= "Ce nom de fichier est déjà dans la base.";
                return $err;
            }

            if(move_uploaded_file($_FILES['fichier']['tmp_name'], $target_file)){
                echo "L'image ".  basename( $_FILES['fichier']['name']).
                "a bien été chargé!";
            }
            else{
                echo "Le fichier n'a pas était chargé! Merci de réessayer";
            }

            header("Location: ../index.php");
        }
        catch(Exception $e){
                echo "Request failed : " . $e->getMessage();
        }
    }
?>
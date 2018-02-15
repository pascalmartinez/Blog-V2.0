<?php
    function articleCardList($connect, $offset){
        try{
            $limit = 10;

            $stmt = $connect->prepare("SELECT article.id_article, article.date, article.titre, article.texte, article.url_img, auteur.nom_auteur, categorie.nom_categorie
            FROM article
            INNER JOIN auteur ON article.id_auteur=auteur.id_auteur
            INNER JOIN categorie ON article.id_categorie=categorie.id_categorie
            ORDER BY date DESC
            LIMIT
                :limit
            OFFSET
                :offset");

            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt;

        }
        catch(PDOExeption $e){
            echo "Request failed : " . $e->getMessage();
        }
    }

    function selectCard($connect, $idCategorie){
        try{
            $stmt = $connect->prepare("SELECT article.id_article, article.date, article.titre, article.texte, article.url_img, auteur.nom_auteur, categorie.nom_categorie
            FROM article
            INNER JOIN auteur ON article.id_auteur=auteur.id_auteur
            INNER JOIN categorie ON article.id_categorie=categorie.id_categorie
            WHERE categorie.id_categorie='$idCategorie' ORDER BY date DESC");
            $stmt->execute();
            return $stmt;
        }
            catch(PDOExeption $e){
                echo "Request failed : " . $e->getMessage();
            }
    }

    function selectCategorie($connect){
        try{
            $stmt = $connect->prepare("SELECT id_categorie, nom_categorie FROM categorie");
            $stmt->execute();
            return $stmt;
        }
        catch(PDOExeption $e){
            echo "Request failed : " . $e->getMessage();
        }
    }

    function article($connect, $id){
        try{
            $stmt = $connect->prepare("SELECT article.id_article, article.date, article.titre, article.texte, article.url_img, auteur.nom_auteur, categorie.nom_categorie
            FROM article
            INNER JOIN auteur ON article.id_auteur=auteur.id_auteur
            INNER JOIN categorie ON article.id_categorie=categorie.id_categorie WHERE id_article='$id'");
            $stmt->execute();

            return $stmt;
        }
        catch(PDOExeption $e){
            echo "Request failed : " . $e->getMessage();
        }
    }

    function textArticle($connect, $idArticle){
        try{
            $stmt = $connect->prepare("SELECT texte FROM article WHERE id_article='$idArticle'");
            $stmt->execute();
            return $stmt;
        }
        catch(PDOExeption $e){
            echo "Request failed : " . $e->getMessage();
        }
    }

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
        //Gère la partie upload image
        
            $target_dir = "../sources/images/";
            $target_file = $target_dir .basename ($_FILES["fichier"]["name"]);

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
    }

?>

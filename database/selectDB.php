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

    function formulaire($connect, $nom, $email, $categorie, $titremessage, $message, $fichier){
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

    function nbArticle($connect){
        try{
            $totalArticle = $connect->query("SELECT COUNT(id_article) FROM article")->fetchColumn();
            return $totalArticle;
        }
        catch (Exception $e){
            echo "Request failed : " . $e->getMessage();
        }
    }
?>

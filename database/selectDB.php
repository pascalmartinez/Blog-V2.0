<?php
    function articleCardList($connect){
        try{

            $stmt = $connect->prepare("SELECT article.id_article, article.date, article.titre, article.texte, article.url_img, auteur.nom_auteur, categorie.nom_categorie
            FROM article
            INNER JOIN auteur ON article.id_auteur=auteur.id_auteur
            INNER JOIN categorie ON article.id_categorie=categorie.id_categorie
            ORDER BY DATE LIMIT 10");//offset 10

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
            WHERE categorie.id_categorie='$idCategorie'");
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
            INNER JOIN categorie ON article.id_categorie=categorie.id_categorie WHERE id_article='$id'");//offset 10
            $stmt->execute();
            
            return $stmt;
        }
        catch(PDOExeption $e){
            echo "Request failed : " . $e->getMessage();
        }
    }

?>

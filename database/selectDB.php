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

    function pagination($connect){
        try{
            $totalArticle = $connect->query("SELECT COUNT(id_article) FROM article")->fetchColumn();
            $limit = 10;
            $pages = ceil($totalArticle / $limit);

            $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
                'options' => array(
                    'default'   => 1,
                    'min_range' => 1,
                ),
            )));

            $offset = ($page - 1) * $limit;

            $start = $offset + 1;
            $end = min(($offset + $limit), $totalArticle);

            //Permet de changer de page en y incluant leur titre et n°
           $previousLink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a>
            <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' :
            '<span class="disabled">&laquo;</span>
            <span class="disabled">&lsaquo;</span>';

            $nextLink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a>
            <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' :
            '<span class="disabled">&rsaquo;</span>
            <span class="disabled">&raquo;</span>';

            echo '<div id="paging"><p>', $previousLink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $totalArticle, ' results ', $nextLink, ' </p></div>';

            return $offset;
        }
        catch (Exception $e) {
            echo "Request failed : " . $e->getMessage();
        }
    }
?>

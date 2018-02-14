<?php
    function articleCardList($connect){
        try{
            $stmt = $connect->prepare( "SELECT article.id_article, article.date, article.titre, article.texte, article.url_img, auteur.nom_auteur, categorie.nom_categorie
                                        FROM article
                                        INNER JOIN auteur ON article.id_auteur=auteur.id_auteur
                                        INNER JOIN categorie ON article.id_categorie=categorie.id_categorie
                                        ORDER BY DATE LIMIT 10"); //offset 10
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $stmt->fetch()) {
                    echo  "<div class='card bg-light mb-3' style='max-width: 18rem;'>
                    <div class='card-header'>
                        <h6>".$row['nom_categorie']."</h6>
                        <a class='card-title' id='article_".$row['id_article']."' href='html/article.php?id=".$row['id_article']."'>".$row['titre']."</a>
                    </div>";

                    if($row['url_img'] != ""){
                       echo "<img class='card-img-top' src='sources/images/".$row['url_img']."' alt='img article'>";
                    }

                    echo "<div class='card-body'>
                        <p class='card-text'>".$row['texte']."</p>
                        <p class='card-text'><small class='text-muted'>".$row['date']."</small></p>
                        <h5 class='card-subtitle text-center'>".$row['nom_auteur']."</h5>
                    </div>
                </div>";
            }

            return $stmt;
        }
        catch(PDOExeption $e){
            echo "Request failed : " . $e->getMessage();
        }
    }

    /**function selectCard($connect){
        try{
<<<<<<< HEAD
            $stmt = $connect->prepare("SELECT article.id_article, article.date, article.titre, article.texte, article.url_link, auteur.nom_auteur, categorie.nom_categorie
            FROM article
            INNER JOIN auteur ON article.id_auteur=auteur.id_auteur
            INNER JOIN categorie ON article.id_categorie=categorie.id_categorie");
=======
            $stmt = $connect->prepare("SELECT article.id_article, article.date, article.titre, article.texte, article.url_img, auteur.nom_auteur, categorie.nom_categorie
            FROM article
            INNER JOIN auteur ON article.id_auteur=auteur.id_auteur
            INNER JOIN categorie ON article.id_categorie=categorie.id_categorie
            WHERE id=1");
>>>>>>> 85b714bd171216e4deaec04bd47b6385d8d22d2b
            $stmt->execute();
            return $stmt;

    }*/

    function selectCategorie($connect){
        try{
            $stmt = $connect->prepare("SELECT id_categorie, nom_categorie FROM categorie");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $stmt->fetch()) {
                    echo "<option value=".$row['id_categorie']." >".$row['nom_categorie']."</option>";
                }
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
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $stmt->fetch()) {
                    echo  "<div>
                                <div>
                                    <h6>".$row['nom_categorie']."</h6>
                                    <p ".$row['id_article'].$row['titre']."</p>
                                </div>";

                        if($row['url_img'] != ""){
                           echo "<img class='card-img-top' src='sources/images/".$row['url_img']."' alt='img article'>";
                        }

                    echo "<div class='card-body'>
                                <p class='card-text'>".$row['texte']."</p>
                                <p class='card-text'><small class='text-muted'>".$row['date']."</small></p>
                                <h5 class='card-subtitle text-center'>".$row['nom_auteur']."</h5>
                          </div>
                         </div>";
                    }
            return $stmt;
        }
        catch(PDOExeption $e){
            echo "Request failed : " . $e->getMessage();
        }
    }



?>

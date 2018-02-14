<?php
    function afficherCard($stmt){
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $stmt->fetch()) {
            echo  "<div class='card bg-light mb-3' style='max-width: 18rem;'>
            <div class='card-header'>
                <h6>".$row['nom_categorie']."</h6>
                <a class='card-title' id='article_".$row['id_article']."' href='html/article.php'>".$row['titre']."</a>
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
    }
    
?>
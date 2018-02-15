<?php
    function afficherSelectCategorie($stmt){
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $stmt->fetch()) {
            echo "<option value=".$row['id_categorie']." >".$row['nom_categorie']."</option>";
        }
    }

    function afficherCard($stmt){
        while($row = $stmt->fetch()) {
            echo  "<div class='card bg-light mb-3''>
            <div class='card-header'>
                <h6>".$row['nom_categorie']."</h6>
                <a class='card-title' id='article_".$row['id_article']."' href='html/article.php?id=".$row['id_article']."'>".$row['titre']."</a>
            </div>";

            if($row['url_img'] != ""){
                echo "<img id='my_image' class='card-img-top' src='sources/images/".$row['url_img']."' alt='img article'>";
            }

            echo "<div class='card-body'>
                <p class='card-text'>".substr($row['texte'],0,150)."</p>
                <p class='card-text'><small class='text-muted'>".$row['date']."</small></p>
                <h5 class='card-subtitle text-center'>".$row['nom_auteur']."</h5>
            </div>
        </div>";
        }
    }

    function afficherTextArticle($stmt){
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $stmt->fetch()) {
            echo "<p class='card-text'>".$row['texte']."</p>";
        }
    }

    function afficherTitre($stmt){
        while($row = $stmt->fetch()) {
            echo  $row['titre'];
        }
    }

    function affichagePagination($page, $pages,$start, $end, $totalArticle){
        $previousLink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a>
        <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' :
        '<span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>';

        $nextLink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a>
        <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' :
        '<span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>';

        echo '<div id="paging"><p>', $previousLink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $totalArticle, ' results ', $nextLink, ' </p></div>';
    }
?>

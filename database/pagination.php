<?php 
    //include "html/affichage.php";

    function pagination($connect){        
        try{
            $totalPages = $connect->query("SELECT COUNT(id_article) FROM article")->fetchColumn();
            $limit = 10;
            $pages = ceil($totalPages / $limit);

            $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
                'options' => array(
                    'default'   => 1,
                    'min_range' => 1,
                ),
            )));

            $offset = ($page - 1) * $limit;

            $start = $offset + 1;
            $end = min(($offset + $limit), $totalPages);

            $previousLink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
            $nextLink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

            echo '<div id="paging"><p>', $previousLink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $totalPages, ' results ', $nextLink, ' </p></div>';

            $stmt = $connect->prepare('SELECT article.id_article, article.date, article.titre, article.texte, article.url_img, auteur.nom_auteur, categorie.nom_categorie
            FROM article
            INNER JOIN auteur ON article.id_auteur=auteur.id_auteur
            INNER JOIN categorie ON article.id_categorie=categorie.id_categorie
            ORDER BY date DESC 
            LIMIT 
                :limit 
            OFFSET
                :offset');

            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
             

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            afficherCard($stmt);


        }
        catch (Exception $e) {
            echo "Request failed : " . $e->getMessage();
        }
    }
?>
<?php 
    //include "html/affichage.php";

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


            /*$listdebut = '<li class="page-item">';
            $listSuite = ($page > 1) ?
                       ' <a class="page-link" href="?page='.($page - 1).'" title="Previous page" aria-label="Previous">' :
                            '<span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="?page=1">&laquo;</a></li>
                    <li class="page-item">';
            $listFin =  ($page < $pages) ? '<a class="page-link" href="?page=' . ($page + 1) . '" title="Next page" aria-label="Next">' :
                            '<span class="disabled" aria-hidden="true">&raquo;</span>
                            <span class="disabled sr-only">Next</span>
                        </a>
                    </li>';

                    echo $listdebut.$listSuite.$listFin;*/

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
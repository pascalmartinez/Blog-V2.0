<?php
    function pagination($totalArticle){
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
        affichagePagination($page, $pages,$start, $end, $totalArticle);
        return $offset;
    }
 ?>

//Affiche tout le texte de la card.

$(document).ready(function(){
    var img = ($("img").attr("src"));
        $("img").attr("src","../"+ img);
    //change l'url de l'image de la page article.php

    var id = ($("a").attr("id"));
    id = id.substr(8);
    $("p.card-text:first-child").load("../html/textArticle.php", "id="+id);
    //change le text de la page article.php
});

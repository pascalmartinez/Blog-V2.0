//Affiche tout le texte de la card.

$(document).ready(function(){
    //$("#article_").click(function() {
    var img = ($("img").attr("src"));
    //alert (img);
        $("img").attr("src","../"+ img);
    //});



    var Id = ($("a").attr("id"));

    alert (Id);
    $("p.card-text:first-child").load("html/textArticle.php");

});

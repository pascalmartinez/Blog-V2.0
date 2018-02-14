//Affiche tout le texte de la card.

$(document).ready(function(){
    var Id = ($("a").attr("id"));

    alert (Id);
    $("p.card-text:first-child").load("html/textArticle.php");

});

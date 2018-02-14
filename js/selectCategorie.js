function changeSelect(event){
    var idC = $("#inputCategorie option:selected").val();

    $("#main").load("html/action.php", "idc="+idC);
}

$(document).ready(function(){
    $("#inputCategorie").change(changeSelect);
});
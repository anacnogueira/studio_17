$(document).ready(function() {
  $("a.conta").click(function(event){
    conta_click($(this).text(),$(this).attr("href"));
    event.preventDefault();
   });
});



function conta_click(valor, link){
  $.ajax({
    type: "POST",
    url: "http://localhost/studio17/categorias/add_click",
    //url: "http://www.studio17.com.br/ver_alfa/categorias/add_click",
    data: {categoria_name: valor},
    complete: function(text) {
      window.location = link;
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      //alert("Erro: " + errorThrown);
    }
  });
}
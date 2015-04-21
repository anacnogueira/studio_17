$(document).ready(function(){
   //Anexar Multiplas imagens
  var url = "http://localhost/studio17/";          //local
  //var url = "http://studio17.com.br/";  //server

  if(!empty($("#ClienteFoto"))){

    new AjaxUpload('ClienteFoto', {
			action: url + 'clientes/manager_files',
      data: {cliente_id: $("#ClienteId").val()},
      name: 'foto',
      onComplete : function(file,response){
         
        if(response.match("Erro")){
          $('div#flashMessage').html(response.replace('Erro:',''));
          return false;
        }
        else{
          link = "<a href='" + url + "img/clientes/" + response + "' class='imagem iframe.fancybox'>";
          image = "<img src='" + url + "img/clientes/" + response + "' alt='' class='' /><br />";
          hidden = "<input name='data[ClienteFoto][foto][]' type='hidden' value='" + response + "' />";
          button = "<button type='submit' class='btn_delete'>Excluir</button>";
          $('<div class="box">' + link  + image + hidden +  button + '<a/></div>').appendTo($('div#list_images'));
        }
			}
		});

   $('.btn_delete').live("click",function(){
    delete_image($(this));
   });
  }

  function delete_image(obj){
    file = $(obj).prev(0).val();
    linha   = $(obj).parent();

    linha.hide('slow').remove().stop();

	  $.ajax({
      type: "POST",
      url: url + 'clientes/delete_file/' + file,
      async: false,
      success: function(text) {
        //alert(text)
      }
	  });
 }

});



function empty(valor){
  if(valor == "" || valor == 0 || valor == null || valor == undefined)
    return true;
  else
    return false;
}
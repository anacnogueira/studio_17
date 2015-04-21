$(document).ready(function(){
  $("div.som").click(function() {
     var turn = $(this).children("span");
     var img  = $(this).children("img");
     var audio =  $(this).children("audio")[0];

     if(turn.text() == "ON"){
       turn.text("OFF");
       img.attr("src","img/equalizer_off.gif");
       audio.pause();
     }
     else{
       turn.text("ON");
       img.attr("src","img/equalizer_on.gif");
       audio.play();
     }
  });
})

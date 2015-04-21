<?php
  class VideoGalleryHelper extends AppHelper{
    public $helpers = array('Html');

    public function showGallery($itens = array()){
      if($itens){
        $out  = '<div class="yt_holder">';
        $out .= ' <div id="ytvideo"></div>';
        $out .= ' <ul class="videos">';
          foreach($itens as $item){
            $out .= '<li><a href="'. $item["PortfolioVideo"]["link_youtube"].'"></a></li>';
          }
        $out .= ' </ul>';
        $out .= '</div>';
      }
      else{
       $out ='<h3>Nenhum vídeo disponível</h3>';
      }


       return $this->output($out);
    }
  }
?>

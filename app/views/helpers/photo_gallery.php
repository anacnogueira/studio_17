<?php
  class PhotoGalleryHelper extends AppHelper{
    public $helpers = array('Html');

    public function showGallery($itens = array(),$table,$folder){
      if($itens){
        $out  ='<div id="thumbs" class="navigation"> ';
        $out.= '<ul class="thumbs noscript">';
         foreach($itens as $item){
          $descricao = isset($item[$table]['descricao']) ? $item[$table]['descricao'] : '';
          $out .= '<li>';
          $out .= $this->Html->link(
                  $this->Html->Image($folder.'/'.$item[$table]['foto'],
                  array('alt'=> $descricao)),
                  '/img/'.$folder.'/'.$item[$table]['foto'],
                  array('class' => 'thumb',
                  'name'=>$item[$table]['foto'],
                  'title'=>$descricao,
                  'escape' => false));
          if(isset($item[$table]['foto_ori'])){
            $out .= '<div class="caption">

                      <div class="download">
									      <a href="img/'.$folder.'/'.$item[$table]['foto_ori'].'" rel="external">Download Original</a>
								      </div>

							      </div>';
          }
          $out .= '    </li>';
         }
         
         $out .= '  </ul>';
         $out .= '</div>';
         $out .= '<div id="gallery" class="content">';
         $out .= '  <div id="controls" class="controls"></div>';
         $out .= '  <div class="slideshow-container">';
         $out .= '    <div id="loading" class="loader"></div>';
         $out .= '    <div id="slideshow" class="slideshow"></div>';
         $out .= '  </div>';
         $out .= '  <div id="caption" class="caption-container"></div>';
         $out .= '</div>';

      }
      else{
       $out = '<h3>Nenhuma foto disponível.</h3>';
      }
       return $this->output($out);
    }


  }
?>

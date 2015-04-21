<?php
  class BdImagesHelper extends AppHelper{
   var $helpers = array('Html','Form');

    public function radio($fotos){
     $out = "";
     if($fotos){
       $out = '<div id="bd_images">';
       foreach($fotos as $foto){
        $out .= '<div class="box">';
        $out .= $this->Form->radio('foto_id',array(
        $foto['Foto']['id']=>'<img src="/studio17/img/fotos/'.$foto['Foto']['foto'].'" alt="'.$foto['Foto']['descricao'].'" />',
        ),array('legend'=>false,'label'=>false,'value'=>false))."\n";
        $out .= $this->Form->error('foto_id')."\n";      
        $out .= '</div>';
      }
      $out .= '</div>';
     }

     return $this->output($out);
    }
  }
?>

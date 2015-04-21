<?php
  $script  = $this->Html->script(array('jquery.galleriffic','jquery.opacityrollover.js','config_galeria.js'));
  $script .= $this->Html->css(array('galleriffic-2'));
  echo $this->addScript('scripts_for_layout',$script);
?>
<h1>Ensaios Fotográficos</h1>
<?php echo $this->PhotoGallery->showGallery($ensaios,'Foto','fotos'); ?>  
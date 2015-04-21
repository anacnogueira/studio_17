<?php
  $script  = $this->Html->script(array('jquery.galleriffic','jquery.opacityrollover.js','config_galeria.js','conta_click.js'));
  $script .= $this->Html->css(array('galleriffic-2','evento'));

  echo $this->addScript('scripts_for_layout',$script);
  $factor = 0.2;
  // Smallest font size possible
  $starting_font_size = 10;

?>
<h1>Eventos <?php echo !empty($categoria) ?' &raquo; '.$categoria :''; ?></h1>
<ul id="cloud">
  <?php
  if(count($categorias) > 0){
    foreach($categorias as $categoria){
       $x = round(($categoria['Categoria']["clicks"] * 100) / $max_count * $factor);
       $font_size = $starting_font_size + $x.'px';
       echo "<li style='font-size:".$font_size."'>";
       echo $this->Html->link($categoria['Categoria']["name"],
        array('controller'=>'eventos','action'=>'index',$categoria['Categoria']['name']),
         array('escape' => false,'class'=>'conta'));
       echo "</li>";
    }
  }
 ?>
</ul>
<?php echo $this->PhotoGallery->showGallery($eventos,'Foto','fotos'); ?>
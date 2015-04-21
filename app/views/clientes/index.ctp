<?php
  $script  = $this->Html->script(array('jquery.galleriffic','jquery.opacityrollover.js','config_galeria.js'));
  $script .= $this->Html->css(array('galleriffic-2'));
  echo $this->addScript('scripts_for_layout',$script);
?>
<h1>Minhas Fotos</h1>
<?php if(!empty($fotos['Cliente']['folder'])): ?>
    <div id="thumbs" class="navigation">
    <ul class="thumbs noscript">
<? //ler a pasta
if($folder = opendir("img/clientes/".$fotos['Cliente']['folder'])):
   while(($file = readdir($folder)) !== false or $file == "Thumbs.db"):
    if($file == "." or $file == "..") continue;
?>   
<?php if($file != "Thumbs.db"): ?>
    <li><?php echo $this->Html->link(
                  $this->Html->Image('clientes/'.$fotos['Cliente']['folder']."/".$file),
                  '/img/clientes/'.$fotos['Cliente']['folder'].'/'.$file,
                  array('class' => 'thumb',
                  'escape' => false)); ?>
      <div class="caption">
        <div class="download"><a href="img/clientes/<?php echo $fotos['Cliente']['folder']."/".$file; ?>" rel="external">Download Original</a></div>
      </div>
    </li>
<?php endif; ?>
<?php endwhile; ?>
  </ul>
</div>
  <div id="gallery" class="content">
    <div id="controls" class="controls"></div>
      <div class="slideshow-container">
        <div id="loading" class="loader"></div>
        <div id="slideshow" class="slideshow"></div>
      </div>
      <div id="caption" class="caption-container"></div>
  </div>
<?php endif; ?>
<?php else: ?>
    <h3>Nenhuma foto disponível.</h3>
<?php endif; ?>   
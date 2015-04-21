<?php
  $script  = $this->Html->script(array('jquery.youtubeplaylist.js','config_playlist.js'));
  $script .= $this->Html->css(array('youtubeplaylist'));
  echo $this->addScript('scripts_for_layout',$script);
?>

<h1>Portfolio &raquo; Vídeos</h1>
<?php echo $this->VideoGallery->showGallery($videos); ?>
<?php echo $this->Html->docType('xhtml11'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Studio17 - <?php echo $title_for_layout; ?></title>
  <?php echo $this->Html->meta('description','')."\n";?>
  <?php echo $this->Html->meta('keywords','')."\n";?>
  <meta name="author" content="Ana Claudia Nogueira - www.anaclaudia.com.br" />
  <?php echo $this->Html->charset('UTF-8'); ?>
	<?php echo $this->Html->css('frontend');?>
  <?php echo $this->Html->css('menu_cliente');?>
  <?php echo $this->Html->script(array('jquery.js','jquery.hoverIntent.js','script.js')); ?>
  <?php echo $scripts_for_layout; ?>

</head>
<body>
  <div id="container">
    <div id="content">
      <?php echo $this->element('top'); ?>
      <?php
      if($this->Session->check('cliente')){
        echo $this->element('menu_login_cliente');
      }
      ?>
      <div id="conteudo">
        <?php echo $this->Session->flash(); ?>       
        <?php echo $content_for_layout;?>
        <?//php echo $this->element('sql_dump'); ?>
      </div>
      <div id="empty">&nbsp;</div>
      <?php echo $this->element('footer'); ?>
	  </div>
	</div>
</body>
</html>
<?php
  $script = $this->Html->script(array('jquery.maskedinput.js','mascara_campo.js'))."\n";
  echo $this->addScript('scripts_for_layout',$script);
?>
<h2>Portfolio &raquo; Vídeos &raquo; Alterar</h2>
<div class="usuarios form">
<?php echo $this->Form->create('PortfolioVideo');?>
<p>Os campos com * são obrigatórios</p>
<?php echo $this->Form->input('descricao',array('label'=>'Descrição*:'))."\n"; ?>
<?php echo $this->Form->input('link_youtube',array('label'=>'Link Youtube*:'))."\n"; ?>
<?php echo $this->Form->hidden('id');?> 
<?php echo $this->Form->end('Enviar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Listar Vídeos', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>
<h2>Categorias &raquo; Cadastrar</h2>
<div class="categorias form">
<?php echo $this->Form->create('Categoria');?>
<p>Os campos com * são obrigatórios</p>
 <?php echo $this->Form->input('name',array('label'=>'Nome*:','maxlength'=>'50'))."\n"; ?>
<?php echo $this->Form->end('Enviar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Listar Categorias', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>
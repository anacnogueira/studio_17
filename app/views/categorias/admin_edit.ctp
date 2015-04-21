<h2>Categorias &raquo; Editar</h2>
<div class="categorias form">
<?php echo $this->Form->create('Categoria');?>
<p>Os campos com * são obrigatórios</p>
 <?php echo $this->Form->input('name',array('label'=>'Nome*:','maxlength'=>'50'))."\n"; ?>
 <?php echo $this->Form->hidden('id'); ?>
<?php echo $this->Form->end('Enviar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Listar Categorias', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Excluir', true), array('action' => 'admin_delete', $this->Form->value('Categoria.id')), null, sprintf(__('Tem certeza que deseja excluir o registro  # %s?', true), $this->Form->value('Categoria.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Categorias', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>
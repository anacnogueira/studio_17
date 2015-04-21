<?php echo $this->element('tiny_mce'); ?>
<div class="paginas form">
<h2>Editar página</h2>
<p>Os campos com * são obrigatórios</p>
<?php echo $form->create('Pagina');?>
	<fieldset>
 		<legend><?php __('Informações');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('permalink',array('label'=>'Nome:*'));
		echo $form->input('titulo',array('label'=>'Título:*'));
	 echo '<div class="inline"><label for="PaginaConteudo">Conteúdo:*</label></div>';
    echo '<div class="inline right">';
    echo  $form->input('conteudo',array('label'=>false,'type'=>'textarea','cols'=>'20','rows'=>'20'));
    echo '</div>'
	?>
	</fieldset>
<?php echo $form->end('Enviar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Excluir', true), array('action' => 'admin_delete', $form->value('Pagina.id')), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $form->value('Pagina.id'))); ?></li>
		<li><?php echo $html->link(__('Listar Páginas', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>
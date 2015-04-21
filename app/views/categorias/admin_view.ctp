<div class="categorias view">
<h2><?php  __('Categoria');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ID:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['name']; ?>
			&nbsp;
  	</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar Categoria', true), array('action' => 'admin_edit', $categoria['Categoria']['id'])); ?> </li>
		<li><?php echo $html->link(__('Excluir Categoria', true), array('action' => 'admin_delete', $categoria['Categoria']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $categoria['Categoria']['id'])); ?> </li>
		<li><?php echo $html->link(__('Listar Categorias', true), array('action' => 'admin_index')); ?> </li>
		<li><?php echo $html->link(__('Nova Categoria', true), array('action' => 'admin_add')); ?> </li>
	</ul>
</div>
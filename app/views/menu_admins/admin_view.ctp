<div class="mnu view">
<h2><?php  __('Item do Menu');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ID:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['MenuAdmin']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['MenuAdmin']['nome']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descrição:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['MenuAdmin']['descricao']; ?>
			&nbsp;
		</dd>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Link:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['MenuAdmin']['link']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ordem:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['MenuAdmin']['order']; ?>
			&nbsp;
		</dd>		
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar Item', true), array('action' => 'admin_edit', $item['MenuAdmin']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Excluir Item', true), array('action' => 'admin_delete', $item['MenuAdmin']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $item['MenuAdmin']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Items de Menu', true), array('action' => 'admin_index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo Item de Menu', true), array('action' => 'admin_add')); ?> </li>
	</ul>
</div>

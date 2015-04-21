<div class="paginas view">
<h2><?php  __('Página');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pagina['Pagina']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pagina['Pagina']['permalink']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Título'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pagina['Pagina']['titulo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Conteúdo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pagina['Pagina']['conteudo']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar Página', true), array('action' => 'admin_edit', $pagina['Pagina']['id'])); ?> </li>
		<li><?php echo $html->link(__('Excluir Página', true), array('action' => 'admin_delete', $pagina['Pagina']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $pagina['Pagina']['id'])); ?> </li>
		<li><?php echo $html->link(__('Listar Páginas', true), array('action' => 'admin_index')); ?> </li>
		<li><?php echo $html->link(__('Nova Página', true), array('action' => 'admin_add')); ?> </li>
	</ul>
</div>

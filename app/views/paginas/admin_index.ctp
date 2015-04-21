<div class="paginas index">
<h2><?php __('Páginas');?></h2>
 <div class="filtro">
     <?php echo $form->create(array('inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false))); ?>
     <table class="none">
    <tr>
      <td><label for="PaginaName">Nome:</label></td>
      <td><?php echo $form->input('permalink',array('class'=>'custom')); ?></td>
      <td><label for="PaginaTitulo">Título:</label></td>
      <td><?php echo $form->input('titulo',array('class'=>'custom')); ?></td>
      <td><label for="TipoQtde">Exibir:</label></td>
      <td>
        <?php echo $form->input('qtde',array('type'=>'select','options'=>$qtde,'default'=>1)); ?>
         <?php echo $form->submit('Pesquisar',array('div'=>false)); ?>
      </td>
    </tr>
  </table>
  </form>
  </div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Nova Página', true), array('action' => 'admin_add')); ?></li>
	</ul>
</div>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('ID','id');?></th>
	<th><?php echo $paginator->sort('NOME','permalink');?></th>
	<th><?php echo $paginator->sort('TÍTULO','titulo');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($paginas as $pagina):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td><?php echo $pagina['Pagina']['id']; ?></td>
		<td><?php echo $pagina['Pagina']['permalink']; ?></td>
		<td><?php echo $pagina['Pagina']['titulo']; ?></td>

		<td class="actions">
			<?php echo $html->link(__('Visualizar', true), array('action' => 'admin_view', $pagina['Pagina']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action' => 'admin_edit', $pagina['Pagina']['id'])); ?>
			<?php echo $html->link(__('Excluir', true), array('action' => 'admin_delete', $pagina['Pagina']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $pagina['Pagina']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('Próximo', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
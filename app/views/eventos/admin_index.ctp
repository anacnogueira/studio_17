<?php
  $script = $this->Html->script(array('jquery.lightbox.min','config.lightbox'))."\n";
  $script .= $this->Html->css(array('jquery.lightbox'));
  echo $this->addScript('scripts_for_layout',$script);
?>
<div class="filtro">
<?php echo $form->create(array('inputDefaults' => array(
                                                     'label' => false,
                                                       'div' => false))); ?>
<table class="none">
    <tr>
      <td>Categoria:</td>
      <td><?php echo $form->input('categoria_id'); ?></td>
      <td>Exibir:</td>
      <td>
        <?php echo $form->input('qtde',array('type'=>'select','options'=>$qtde,'default'=>1)); ?>
         <?php echo $form->submit('Pesquisar',array('div'=>false)); ?>
      </td>
    </tr>
  </table>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Cadastrar Novo Evento', true), array('action' => 'admin_add')); ?></li>
    <li><?php echo $this->Html->link(__('Categorias', true), array('controller'=>'categorias','action' => 'admin_index')); ?></li>
	</ul>
</div>
<?php if(isset($eventos) and is_array($eventos)): ?>
<?php foreach($eventos as $evento): ?>
 <div class="box">
  <?php if(isset($evento['Foto']['foto'])): ?>
  <?php echo $html->image("fotos/".$evento['Foto']['foto'],array('alt'=>$evento['Foto']['descricao'])); ?>
  <?php endif; ?>
  <p class="desc"><?php echo $evento['Categoria']['name']; ?></p>


  <div class='actions'>
   <ul>
     <li><?php echo $html->link(__('Visualizar', true), "/img/fotos/".$evento['Foto']['foto'],array('class'=>'view')); ?></li>
		 <li><?php echo $html->link(__('Editar', true), array('controller'=>'eventos','action' => 'edit', 'admin'=>true,$evento['Evento']['id'])); ?></li>
		 <li><?php echo $html->link(__('Excluir', true), array('controller'=>'eventos','action' => 'delete', 'admin'=>true,$evento['Evento']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $evento['Evento']['id'])); ?></li>
   </ul>
 </div>
</div>
<?php endforeach; ?>
<div class="paging">
  <?php echo $paginator->prev('« Anterior ', null, null); ?>
  <?php echo $paginator->numbers(); ?>
  <?php echo $paginator->prev('Próximo » ', null, null); ?>
</div>
<?php endif; ?>
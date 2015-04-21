<?php
  $script = $this->Html->script(array('jquery.lightbox.min','config.lightbox'))."\n";
  $script .= $this->Html->css(array('jquery.lightbox'));
  echo $this->addScript('scripts_for_layout',$script);
?>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Cadastrar novo ensaio', true), array('action' => 'admin_add')); ?></li>
	</ul>
</div>
<?php //pr($ensaios); ?>
<?php if(isset($ensaios) and is_array($ensaios)): ?>
<?php foreach($ensaios as $ensaio): ?>
 <div class="box">
  <?php if(isset($ensaio['Foto']['foto'])): ?>
  <?php echo $html->image("/img/fotos/".$ensaio['Foto']['foto'],array('alt'=>$ensaio['Foto']['descricao'])); ?>
  <?php endif; ?>
  <p class="desc"><?php echo $ensaio['Foto']['descricao']; ?></p>
  <div class='actions'>
   <ul>
     <li><?php echo $html->link(__('Visualizar', true), "/img/fotos/".$ensaio['Foto']['foto'],array('class'=>'view')); ?></li>
		 <li><?php echo $html->link(__('Editar', true), array('controller'=>'ensaios_fotograficos','action' => 'edit', 'admin'=>true,$ensaio['EnsaiosFotografico']['id'])); ?></li>
		 <li><?php echo $html->link(__('Excluir', true), array('controller'=>'ensaios_fotograficos','action' => 'delete', 'admin'=>true,$ensaio['EnsaiosFotografico']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $ensaio['EnsaiosFotografico']['id'])); ?></li>
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
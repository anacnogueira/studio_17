<?php
  $script = $this->Html->script(array('jquery.lightbox.min','config.lightbox'))."\n";
  $script .= $this->Html->css(array('jquery.lightbox'));
  echo $this->addScript('scripts_for_layout',$script);
?>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Cadastrar nova foto', true), array('action' => 'admin_add')); ?></li>
	</ul>
</div>
<?php if(isset($fotos) and is_array($fotos)): ?>
<?php foreach($fotos as $foto): ?>
 <div class="box">
  <?php if(isset($foto['Foto']['foto'])): ?>
  <?php echo $html->image("/img/fotos/".$foto['Foto']['foto'],array('alt'=>$foto['Foto']['descricao'])); ?>
  <?php endif; ?>
  <p class="desc"><?php echo $foto['Foto']['descricao']; ?></p> 
  <div class='actions'>
   <ul>
     <li><?php echo $html->link(__('Visualizar', true), "/img/fotos/".$foto['Foto']['foto'],array('class'=>'view')); ?></li>
		 <li><?php echo $html->link(__('Editar', true), array('controller'=>'portfolio_fotos','action' => 'edit', 'admin'=>true,$foto['PortfolioFoto']['id'])); ?></li>
		 <li><?php echo $html->link(__('Excluir', true), array('controller'=>'portfolio_fotos','action' => 'delete', 'admin'=>true,$foto['PortfolioFoto']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $foto['PortfolioFoto']['id'])); ?></li>
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
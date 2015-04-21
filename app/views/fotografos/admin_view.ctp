<?php
  $script = $this->Html->css(array('fotografos'));
  echo $this->addScript('scripts_for_layout',$script);

?>
<div class="fotografos view">
<h2><?php  __('Fotógrafo &raquo; Visualizar');?></h2>
  <div>
    <div class="foto"><?php echo $this->Html->image('fotografos/'.$fotografo['Fotografo']['foto'],
    array('alt'=>$fotografo['Fotografo']['nome'])); ?></div>
    <div class="descricao">
      <h2><?php echo $fotografo['Fotografo']['nome']; ?></h2>
      <?php echo $fotografo['Fotografo']['descricao']; ?>
    </div>
  </div>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar Fotógrafo', true), array('action' => 'admin_edit', $fotografo['Fotografo']['id'])); ?> </li>
		<li><?php echo $html->link(__('Excluir Fotógrafo', true), array('action' => 'admin_delete', $fotografo['Fotografo']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $fotografo['Fotografo']['id'])); ?> </li>
		<li><?php echo $html->link(__('Listar Fotógrafos', true), array('action' => 'admin_index')); ?> </li>
		<li><?php echo $html->link(__('Novo Fotógrafo', true), array('action' => 'admin_add')); ?> </li>
	</ul>
</div>
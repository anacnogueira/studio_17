<h2>Adicionar Item de Menu</h2>
<div class="mnu form">
<?php echo $this->Form->create('MenuAdmin');?>
<p>Os campos com * são obrigatórios</p>
<?php echo $this->Form->input('nome',array('label'=>'Nome*:','maxlength'=>'50'))."\n"; ?>
<?php echo $this->Form->input('descricao',array('label'=>'Descrição:','type'=>'textarea'))."\n"; ?>
<?php echo $this->Form->input('link',array('label'=>'Link*:'))."\n"; ?>
<?php echo $this->Form->input('order',array('label'=>'Ordem*:')); ?>
 <label>Ativo:*</label>
  <?php echo $this->Form->radio('ativo',array(
   'N'=>'Não',
   'S'=>'Sim'),array('legend'=>false,'label'=>false)); ?>
   <?php echo $this->Form->error('ativo'); ?>

<?php echo $this->Form->end('Enviar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Listar Items de Menu', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>

<?php
  $script = $this->Html->script(array('jquery.maskedinput.js','mascara_campo.js'))."\n";
  echo $this->addScript('scripts_for_layout',$script);
?>
<h2>Cliente &raquo; Alterar</h2>
<div class="clientes form">
<?php echo $this->Form->create('Cliente');?>
<p>Os campos com * são obrigatórios</p>
	<fieldset>
 <legend>Informações Pessoais</legend>
 <?php echo $this->Form->input('nome',array('label'=>'Nome*:','maxlength'=>'50'))."\n"; ?>
<?php echo $this->Form->input('cpf',array('label'=>'CPF:','class'=>'cpf','maxlength'=>'14',
'after'=>"<span class='instrucoes'> 999.999.999-99</span>"))."\n"; ?>
</fieldset>
<br />
<fieldset>
  <legend>Informações para contato</legend>
  <?php echo $this->Form->input('telefone',array('label'=>'Telefone*:','class'=>'telefone',
 'maxlength'=>'13','after'=>"<span class='instrucoes'> (99)9999-9999</span>"))."\n"; ?>
<?php echo $this->Form->input('celular',array('label'=>'Celular:','class'=>'telefone',
'maxlength'=>'13','after'=>"<span class='instrucoes'> (99)9999-9999</span>"))."\n"; ?>
</fieldset>
<br />
<fieldset>
  <legend>Endereço</legend>
  <?php echo $form->input('endereco',array('label'=>'Endereço:*','maxlength'=>'50'))."\n"; ?>
  <?php echo $form->input('complemento',array('label'=>'Complemento:','maxlength'=>'50'))."\n"; ?>
  <?php echo $form->input('bairro',array('label'=>'Bairro:*','maxlength'=>'50'))."\n"; ?>
  <?php echo $form->input('cidade',array('type'=>'text','label'=>'Cidade:*','maxlength'=>'50'))."\n"; ?>
  <?php echo $form->input('estado',array('options'=>$estados,'type'=>'select','label'=>'Estado:*'))."\n"; ?>
  <?php echo $form->input('cep',array('label'=>'CEP:','class'=>'cep','maxlength'=>'9',
  'after'=>"<span class='instrucoes'> 99999-999</span>"))."\n"; ?>
</fieldset>
<fieldset>
  <legend>Informações de acesso</legend>
  <?php echo $this->Form->input('email',array('label'=>'Email*:','maxlength'=>'50')); ?>
  <?php echo $this->Form->input('password',array('label'=>'Senha*:','maxlength'=>'15','value'=>'')); ?>
  <span class='instrucoes' style='margin-left: 120px'>Sua senha deve conter entre 6 e 15 caracteres</span>
</fieldset>
<fieldset>
  <legend>Informações Adicionais</legend>
  
  <?php echo $this->Form->input('folder',array('label'=>'Pasta Fotos:','maxlength'=>'50'))."\n"; ?>
  <label>Ativo:*</label>  
  <?php echo $this->Form->radio('ativo',array(
    'options' => array('N'=>'Não','S'=>'Sim'),
    'legend'=>false,
    'label'=>false,
    'default' => $this->data['Vehicle']['status']
      )); ?>
   <?php echo $this->Form->error('ativo'); ?>

</fieldset>
<?php echo $this->Form->hidden('id'); ?>
<?php echo $this->Form->end('Enviar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Excluir', true), array('action' => 'admin_delete', $this->Form->value('Cliente.id')), null, sprintf(__('Tem certeza que deseja excluir o registro  # %s?', true), $this->Form->value('Cliente.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Clientes', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>
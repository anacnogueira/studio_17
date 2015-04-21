<?php
  $script = $this->Html->css(array('form'))."\n";
  echo $this->addScript('scripts_for_layout',$script);
?>
<div class="cliente form">
 <h2>Alterar senha</h2>
 <?php echo $form->create('Cliente');?>
 <?php echo $form->input('senhaAtual',array('label'=>'Senha Atual:','type'=>'password')); ?>
 <?php echo $form->input('password1',array('label'=>'Nova Senha:','type'=>'password')); ?>
 <?php echo $form->input('password2',array('label'=>'Redigite a nova senha:','type'=>'password')); ?>
 <?php echo $this->Form->submit('ENVIAR',array('class'=>'submit')); ?>
 <?php echo $this->Form->end(); ?>
</div>
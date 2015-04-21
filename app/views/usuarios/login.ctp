<?php
  $script = $this->Html->css(array('login_admin'));
  $link = '/admin/usuarios/esqueci_senha/';
  echo $this->addScript('scripts_for_layout',$script);
 
?>
<?php echo $this->addScript('scripts_for_layout',$script); ?>
<div class='space'>&nbsp;</div>
<?php echo $this->Session->flash(); ?>
<div class="login form">
 <?php echo $this->Form->create('Usuario')."\n"; ?>
 <?php
  echo $this->Form->input('username',array('label'=>'E-mail:','size'=>40));
  echo $this->Form->input('senha',array('label'=>'Senha:','type'=>'password','size'=>40,'maxlength'=>15));
  echo $this->Form->end('Enviar');
 ?>
</div>
<p><?php echo $this->Html->link('Esqueci a senha',$link); ?></p>
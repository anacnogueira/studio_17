<?php $script = $this->Html->css(array('form','login_cliente'));  ?>
<?php echo $this->addScript('scripts_for_layout',$script); ?>
<div class='space'>&nbsp;</div>
<div class="login form">
<h2>Esqueci a senha</h2>
<p>Informe o e-mail cadastrado abaixo</p>
<?php
 echo $this->Form->create('Cliente')."\n";

 echo $this->Form->input('email',array('label'=>false))."\n";
 if(isset($msg))
  echo '<div class="error-message">'.$msg.'</div>';

  echo $this->Form->submit('OK',array('class'=>'submit'));
  echo $this->Form->end();
?>

</div>

<p><?php echo $this->Html->link('Login','/clientes/login'); ?></p>
<?php
  $script = $this->Html->script(array('jquery.maskedinput.js','mascara_campo.js'))."\n";
  $script .= $this->Html->css(array('form'))."\n";
  echo $this->addScript('scripts_for_layout',$script);
?>
<h1>Contato</h1>
<div class = "contatos form">
 <p>Preencha os dados abaixo corretamente para enviar sua mensagem</p>
 <p>Os campos marcados com * são obrigatórios</p>
 <?php
  echo $this->Form->create('Contato')."\n";

  echo $this->Form->input('nome',array('label'=>'Nome:*'))."\n";
  echo $this->Form->input('email',array('label'=>'E-mail:*'))."\n";

  echo $this->Form->input('telefone',array('label'=>'Telefone:*','class'=>'telefone','maxlength'=>13,
  'after' => "<span class='instrucoes'>Ex:(99)9999-9999</span>"))."\n";
  echo $this->Form->input('assunto',array('label'=>'Assunto:*'));
  echo $this->Form->input('mensagem',array('label'=>'Mensagem:*'))."\n";
  echo $this->Form->submit('ENVIAR',array('class'=>'submit'))."\n";
  echo $this->Form->end()."\n";

  ?>
</div>
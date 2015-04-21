<?php echo $this->element('tiny_mce'); ?>
<h2>Fotógráfos &raquo; Cadastrar</h2>
<div class="fotografos form">

  <p><strong>Instruções para inserção da foto:</strong></p>
     <ul>
     <li>Extensão permitida: jpg</li>
    <li>Cada imagem não deve ultrapassar <?php echo Configure::read('File.max_file_size_txt'); ?></li>
   </ul>
  <?php echo $form->create('Fotografo',array('type'=>'file',));?>
   <?php echo $form->input('nome',array('label'=>'Nome*:'));?> <br />

   <?php echo $form->input('upload',array('type'=>'file','label'=>'Foto*:'));?>
   <?php
     echo '<div class="inline"><label for="PaginaConteudo">Conteúdo*:</label></div>';
     echo '<div class="inline right">';
     echo  $form->input('descricao',array('label'=>false,'type'=>'textarea','cols'=>'20','rows'=>'20'));
     echo '</div>';
  ?>
<?php echo $this->Form->end('Enviar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Fotógrafos', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>

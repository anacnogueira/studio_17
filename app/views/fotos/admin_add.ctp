<h2>Foto &raquo; Cadastrar</h2>
<div class="fotos form">
<p>Campos com * são obrigatórios</p>
<p><strong>Instruções para inserção da foto:</strong></p>
   <ul>
     <li>Extensão permitida: jpg</li>
    <li>Cada imagem não deve ultrapassar <?php echo Configure::read('File.max_file_size_txt'); ?></li>
   </ul>
<?php echo $form->create('Foto',array('type'=>'file',));?>
<?php echo $form->input('upload',array('type'=>'file','label'=>'Foto*:'));?>
<?php echo $form->input('descricao',array('label'=>'Descrição:')); ?>
<label for="show_home">Mostrar na home:*</label>
<?php   echo $form->radio('show_home',array('S'=>'Sim',
'N'=>'Não'),array('legend'=>false,'label'=>false)); ?>
 <?php echo $form->error('Foto.show_home'); ?>
<?php echo $form->end('Enviar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Fotos', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>
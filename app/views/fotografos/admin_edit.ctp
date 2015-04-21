<?php echo $this->element('tiny_mce'); ?>
<h2>Fotógráfos &raquo; Alterar</h2>
<div class="fotografos form">

  <p><strong>Instruções para inserção da foto:</strong></p>
  <ul>
     <li>Extensão permitida: jpg</li>
    <li>Cada imagem não deve ultrapassar <?php echo Configure::read('File.max_file_size_txt'); ?></li>
   </ul>
   <?php echo $form->create('Fotografo',array('type'=>'file',));?>
   <?php echo $form->input('nome',array('label'=>'Nome*:'));?>
   <?php echo $form->input('upload',array('type'=>'file','label'=>'Foto*:'));?>
   <div class="foto_atual">
    <label>Foto atual:</label>
    <?php echo $this->Html->image('fotografos/'.$this->data['Fotografo']['foto'],array('alt'=>$this->data['Fotografo']['nome'])); ?>
</div>
   <?php
     echo '<div class="inline"><label for="PaginaConteudo">Conteúdo:*</label></div>';
     echo '<div class="inline right">';
     echo  $form->input('descricao',array('label'=>false,'type'=>'textarea','cols'=>'20','rows'=>'20'));
     echo '</div>';
  ?>
<?php echo $this->Form->hidden('id');?>
<?php echo $this->Form->hidden('foto_old');?>
<?php echo $this->Form->end('Enviar');?>
</div>
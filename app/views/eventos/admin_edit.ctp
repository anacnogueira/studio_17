<h2>Eventos &raquo; Cadastrar</h2>
<div class="ensaios_fotograficos form">
<fieldset>
  <legend>Foto</legend>
  <p><strong>Instruções para inserção da foto:</strong></p>
   <ul>
     <li>Extensão permitida: jpg</li>
    <li>Cada imagem não deve ultrapassar <?php echo Configure::read('File.max_file_size_txt'); ?></li>
   </ul>
   <?php echo $form->create('Evento',array('type'=>'file',));?>
   <?php echo $form->input('upload',array('type'=>'file','label'=>'Nova Foto:'));?>
   <?php echo $this->BdImages->radio($fotos); ?>
   <div class="foto_atual">
      <label>Foto atual:</label>
      <?php echo $this->Html->image('fotos/'.$this->data['Foto']['foto'],array('alt'=>$this->data['Foto']['descricao'])); ?>
    </div>
</fieldset>
<?php echo $form->input('categoria_id',array('label'=>'Categoria*:')); ?>
<?php echo $this->Form->hidden('id');?>
<?php echo $this->Form->end('Enviar');?>
</div>
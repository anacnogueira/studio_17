<?php
  $script = $javascript->link(array('jquery.mousewheel','jquery.fancybox','config.fancybox','ajaxupload','anexa_arquivos'))."\n";
   $script .= $this->Html->css(array('jquery.fancybox'));
  echo $this->addScript('scripts_for_layout',$script);
?>
<div class="cliente view">
<h2><?php  __('Clientes &raquo; Fotos');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ID:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cliente['Cliente']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cliente['Cliente']['nome']; ?>
			&nbsp;
		</dd>
	</dl>
  <?php echo $form->create('Cliente',array('type'=>'file'));?>
  <?php echo $this->Form->hidden('id',array('value'=>$cliente['Cliente']['id'])); ?>
   <p>Instruções:</p>
   <ul>
     <li>Extensão permitida: jpg</li>
    <li>Cada imagem não deve ultrapassar <?php echo Configure::read('File.max_file_size_txt'); ?></li>
   </ul>
   <label for="FotoFoto">Foto:</label>
   <?php echo $form->file('Cliente.foto',array('id'=>'ClienteFoto')); ?>

   </form>
   <div id="list_images">
   <?php if(count($cliente['ClienteFoto']) > 0): ?>
      <?php $idx = 0; ?>
      <?php foreach($cliente['ClienteFoto'] as $item): ?>

      <div class="box">
        <?php echo $html->link($html->image('/img/clientes/'.$item['foto_redim'],array('alt'=>'')),
              "/img/clientes/".$item['foto_redim'],array('class'=>'imagem iframe.fancybox','escape'=>false)); ?>
        <br /> 
        <?php echo $form->hidden('',array('name'=>'data[ClienteFoto][foto][]','value'=>$item['foto_ori'],'id'=>'ClienteFoto'.$idx))."\n"; ?>
        <?php echo $form->button('Excluir',array('class'=>'btn_delete'))."\n"; ?>
        <?php $idx++; ?>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
   </div>
</div>

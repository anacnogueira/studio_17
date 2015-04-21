<?php
  $script = $this->Html->script(array('coin-slider.min.js','home.js','conta_click.js'))."\n";
  $script .= $this->Html->css(array('coin-slider-styles','home'));
  echo $this->addScript('scripts_for_layout',$script);
 //pr($eventos);
?>
<div id="sidebar">
   <div class="sobre">
     <h2><?php echo $sobre['Pagina']['titulo']; ?></h2>
     <div>
       <?php echo $this->Text->truncate($sobre['Pagina']['conteudo'],330,array('exact'=>false)); ?>
       <p><?php echo $this->Html->link('Saiba Mais','/pagina/'.$sobre['Pagina']['permalink']); ?></p>
     </div>
   </div>
   <?php if(count($eventos) > 0): ?>
   <div class="eventos">
    <h2>Eventos</h2>
     
     <?php foreach($eventos as $evento): ?>
      <?php if($evento[0]['categoria_foto']): ?>
      <div>
      <?php
      echo "<span class='img'>".$this->Html->Image('fotos/'.$evento[0]['categoria_foto'])."</span>";
       echo "<span class='texto'>".$this->Html->link($evento['Categoria']['name'],
       array('controller'=>'Eventos','action'=>'index',$evento['Categoria']['name']),
       array('class'=>'conta'))."</span>";
     ?>
     </div>
       <?php endif; ?>
     <?php endforeach; ?>

   </div>
   <?php endif; ?>
</div>
<div id="coin-slider">
<?php foreach($fotos as $foto): ?>
  <a href="#">
		<?php echo $this->Html->Image('fotos/'.$foto['Foto']['foto'],array('alt'=>'','width'=>500,'height'=>333)); ?>
		<?php if(!empty($foto['Foto']['descricao'])): ?>
      <span>
        <?php echo $foto['Foto']['descricao']; ?>
      </span>
    <?php endif; ?>
	</a>
<?php endforeach; ?>
</div>


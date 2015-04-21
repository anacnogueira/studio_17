<?php
  $script = $this->Html->css(array('fotografos'));
  echo $this->addScript('scripts_for_layout',$script);

?>
<h1>Fotografos</h1>
<?php if($fotografos): ?>
<div class="fotografos">
 <? foreach($fotografos as $fotografo): ?>
  <div class="fotografo">
    <div class="foto"><?php echo $this->Html->image('fotografos/'.$fotografo['Fotografo']['foto'],
    array('alt'=>$fotografo['Fotografo']['nome'])); ?></div>
    <div class="descricao">
      <h2><?php echo $fotografo['Fotografo']['nome']; ?></h2>
      <?php echo $fotografo['Fotografo']['descricao']; ?>
    </div>
  </div>
 <?php endforeach; ?>
</div>
<?php else: ?>
 <h3>Nenhum dado para exibir</h3>
<?php endif; ?>
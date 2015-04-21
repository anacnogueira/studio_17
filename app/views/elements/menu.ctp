<div id="menu">
  <ul>
    <li><?php echo $this->Html->link('Home', '/'); ?></li>
    <li><?php echo $this->Html->link('Fotografos', array('controller'=>'Fotografos','action'=>'index')); ?></li>
    <li class='eventos'><?php echo $this->Html->link('Eventos', array('controller'=>'Eventos','action'=>'index')); ?></li>
    <li class="double-line"><?php echo $this->Html->link('Ensaios Fotográficos', array('controller'=>'EnsaiosFotograficos','action'=>'index')); ?></li>
    <li>
      <a href="#">Portfolio</a>
      <ul>
        <li><?php echo $this->Html->link('Fotos', array('controller'=>'PortfolioFotos','action'=>'index')); ?></li>
        <li><?php echo $this->Html->link('Vídeos',array('controller'=>'PortfolioVideos','action'=>'index')); ?></li>
      </ul>
    </li>
    <li><?php echo $this->Html->link('Contato', array('controller'=>'Contatos','action'=>'index')); ?></li>
    <li><?php echo $this->Html->link('Sua Foto', array('controller'=>'Clientes','action'=>'login')); ?></li>
  </ul>
</div>
<div id="login">Olá <?php echo $this->Session->read('cliente.nome'); ?></div>    
<div id="menu">
 <ul>
  <li><?php echo $this->Html->link('Minhas Fotos',array('controller'=>'clientes','action'=>'index')); ?></li>
  <li><?php echo $this->Html->link('Alterar Dados',array('controller'=>'clientes','action'=>'alterar_dados')); ?></li>
  <li><?php echo $this->Html->link('Alterar Senha',array('controller'=>'clientes','action'=>'alterar_senha')); ?></li>
  <li><?php echo $this->Html->link('Sair',array('controller'=>'clientes','action'=>'logout')); ?></li>
 </ul>
</div>

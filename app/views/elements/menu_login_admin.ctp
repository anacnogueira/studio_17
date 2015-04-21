<div class="menu_login">
 <ul>
  <li>Olá <?php echo $this->Session->read('usuario.nome'); ?></li>
  <li>&nbsp;|&nbsp;</li>
  <li><?php echo $this->Html->link('Alterar Dados',array('controller'=>'usuarios','action'=>'alterar_dados','admin'=>true)); ?></li>
  <li>&nbsp;|&nbsp;</li>
  <li><?php echo $this->Html->link('Alterar Senha',array('controller'=>'usuarios','action'=>'alterar_senha','admin'=>true)); ?></li>
  <li>&nbsp;|&nbsp;</li>
  <li><?php echo $this->Html->link('Sair',array('controller'=>'usuarios','action'=>'logout','admin'=>false,'admin')); ?></li>
 </ul>
</div>

<h1>Nova senha cadastrada</h1>

<p>Sua senha foi modificada com sucesso!</p>
<p>Dentro de instantes você irá receber um e-mail com sua nova senha.</p>
<p>Se dentro de até 15 minutos você não receber o e-mail com sua nova senha,
entre contato conosco através do e-mail <?php echo $html->link(Configure::read('Site.email'),
 'mailto:'.Configure::read('Site.email').'?subject=Reenvio de senha'); ?>
</p>
<p><?php echo $html->link('Ir para Login','/clientes/login'); ?></p>
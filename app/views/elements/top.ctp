<div id="top">
  <div class="social_media">
    <?php if(strtolower($this->params["controller"]) != "clientes") : ?> 
  <p>Acesse:</p>
    <ul>
      <li><a href="https://www.facebook.com/pages/Studio-17/327679393925595" target="_blank"><?php echo $this->Html->Image('facebook32x32.png',array('alt'=>'Facebook')); ?></a></li>
      <!--li><a href="#" target="_blank"><?php echo $this->Html->Image('twitter32x32.png',array('alt'=>'Twitter')); ?></a></li-->
      <!--li><a href="#" target="_blank"><?php echo $this->Html->Image('blogger32x32.png',array('alt'=>'Blogger')); ?></a></li-->
    </ul> 
    <?php else: ?>
        <h1>Área do Cliente</h1>
    <?php endif; ?>
  </div>
 
  <div class="logo"><?php echo $this->Html->image('logo_white.png',array('alt'=>'Studio17')); ?></div>
  <div class="slogan"><?php echo $this->Html->image('slogan_white.png',array('alt'=>'Fine photography and more')); ?></div>
</div>

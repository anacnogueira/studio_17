<?php echo $html->docType('xhtml-strict'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Studio17</title>
  <?php echo $html->charset('UTF-8'); ?>
  <style type='text/css'>
    body{
      font-family: verdana;
      background: #fff;
       }

    div#container{
      width: 650px;
      margin: 0 auto;
      background: #000;
      padding: 10px;
    }

   h1{
    font-size: 16px;
    color: #c60;
    font-weight: bold;
    margin-bottom: 10px;
  }

  h2{ font-size: 16px;  }

  </style>
</head>

<body>
  <div id="container">
    <div id="header">
     <div class="logo"><?php echo $this->Html->image('logo_white.png',array('alt'=>'Studio17')); ?></div>
    <div class="slogan"><?php echo $this->Html->image('slogan_white.png',array('alt'=>'Fine photography and more')); ?></div>
    </div>
    <div id="conteudo">
       <?php echo $content_for_layout;?>
    </div>
  </div>
</body>
</html>
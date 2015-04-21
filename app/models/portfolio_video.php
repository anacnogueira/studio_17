<?php
  class PortfolioVideo extends AppModel {
	  var $name = 'PortfolioVideo';

    var $validate = array(
      'descricao'=>array(
        'rule'=>'notEmpty',
        'required'=>true,
        'message'=>'Insira a descrição do vídeo'
      ),
      'link_youtube'=>array(
        'rule'=>'notEmpty',
        'required'=>true,
        'message'=>'Insira o link do Youtube'));
  }
?>
<?php
class Pagina extends AppModel {
	var $name = 'Pagina';

  var $validate = array(
    'permalink'=>array(
     'rule'=>'notEmpty',
     'required'=>true,
     'message'=>'Informe o nome da página'
    ),
    'titulo'=>array(
      'rule'=>'notEmpty',
      'required'=>true,
      'message'=>'Informe o título da página'
    ),
    'conteudo'=>array(
      'rule'=>'notEmpty',
      'required'=>true,
      'message'=>'Informe o contéudo da página'
    )
  );        
}
?>
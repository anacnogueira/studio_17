<?php
  class Contato extends AppModel{
    var $useTable = false;
    var $_schema = array(
    'nome'   =>array('type'=>'string', 'length'=>100),
    'email'		=>array('type'=>'string', 'length'=>255),
    'telefone' => array('type'=>'string','length'=>13),
    'assunto' =>array('type'=>'string','lenght'=>50),
    'mensagem'	=>array('type'=>'text')
    );
   var $validate = array(
    'nome' => array(
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'required' => true,
        'message' => 'Informe seu nome'
      )
    ),
    'email' => array(
      'email' => array(
      'rule' => 'email',
      'message' => 'Endereço de e-mail inválido'
      ),
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'message' => 'Informe seu e-mail'
      )
    ),
    'telefone' => array(
      'custom' => array(
       'rule' => array('custom', '/^\([0-9]{2}\)[0-9]{4}-[0-9]{4}$/'),
       'message' => 'Informe o telefone corretamente')
      ),
    'assunto' => array(
      'custom' => array(
       'rule' => array('naoVazio'),
       'message' => 'Selecione o assunto')
      ),
    'mensagem'=>array(
      'rule'=>'notEmpty',
      'required'=>true,
      'message'=>'Informe o texto da mensagem'
    )
  );

  function naoVazio($field=array()){
    foreach( $field as $key => $value ){
      if($key == 'assunto'){
        if(!empty($value))
          return true;

          return false;
        }
      }
    }
 }
?>
<?php
class ClientesFoto extends AppModel {
  var $name = 'ClientesFoto';
  var $belongsTo = array('Cliente');

  var $validate = array(
    'foto' => array(
      'rule'=>'notEmpty',
      'required'=>true,
      'message'=>'Selecione a foto'));

}
?>
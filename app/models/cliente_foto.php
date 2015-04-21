<?php
class ClienteFoto extends AppModel {
  var $name = 'ClienteFoto';
  var $belongsTo = array(
  'Cliente' => array(
  'className' => 'Cliente',
  'foreignKey' => 'cliente_id'
  ));

  /*var $validate = array(
    'foto' => array(
      'rule'=>'notEmpty',
      'required'=>true,
      'message'=>'Selecione a foto')); */

}
?>
<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */


class AppController extends Controller {
   public $helpers = array('Html','Form','Javascript','Session','Text');
   public $components = array('Email','Session','RequestHandler','Upload');
   public $uses = array('MenuAdmin');
   public $qtde = array('10','20','30','50','100');
   public $status = array('0'=>'Todos','S'=>'Sim','N'=>'Não');
   
   function beforeFilter(){      
      //Admin  
      $admin_exceptions = array('admin_esqueci_senha','admin_cadastrar_nova_senha','admin_nova_senha_cadastrada');

      if((isset($this->params['admin']) or $this->params['url']['url'] == 'admin')
       and !in_array($this->params['action'],$admin_exceptions)){
        $this->checkAdminSession();
      }      
    }
    
   function beforeRender(){
      $menu_admin = $this->MenuAdmin->find('all',array(
      'conditions'=>array('ativo'=>'S'),
      'order'=>'order'));

      $qtde = $this->qtde;
      $status = array('0'=>'Todos','S'=>'Sim','N'=>'Não');
      $estados = $this->__estados_br();
      $this->set(compact("qtde","status",'menu_admin','estados'));
      return true;
      
   }

   function __estados_br(){
     $arraEstados = array("AC"=>"Acre","AL"=>"Alagoas","AM"=>"Amazonas","AP"=>"Amapá",
     "BA"=>"Bahia","CE"=>"Ceará","DF"=>"Distrito Federal","ES"=>"Espirito Santo","GO"=>"Goiás",
     "MA"=>"Maranhão","MG"=>"Minas Gerais","MG"=>"Mato Grosso do Sul","MT"=>"Mato Grosso","PA"=>"Pará",
     "PB"=>"Paraíba","PE"=>"Pernambuco","PI"=>"Piauí","PR"=>"Paraná","RJ"=>"Rio de Janeiro",
    "RN"=>"Rio Grande Norte","RO"=>"Rondônia","RR"=>"Roraima","RS"=>"Rio Grande do Sul",
    "SC"=>"Santa Catarina","SP"=>"São Paulo","SE"=>"Sergipe","TO"=>"Tocantins");
    asort($arraEstados);
    array_unshift($arraEstados,"Selecione");
    return $arraEstados;
   }

/*--------------------------------------------------------------------------------'
'   													Função conversora de Data														'
'   1 =  AAAA-MM-DD para DD/MM/AAAA                   														'
'   2 =  DD/MM/AAAA para AAAA-MM-DD                  														  '
'   3 = DD/MM/AAAA 00:00:00 para AAAA-MM-DD 00:00:00  														'
'   4 = AAAA-MM-DD 00:00:00 para DD/MM/AAAA 00:00:00  														'
---------------------------------------------------------------------------------*/
   function format_date($date,$cod_format){
    $date = str_replace("'","",$date);
    switch($cod_format){
      case 1:
        $conv1 = explode("-",$date);
        $out = implode("/",array_reverse($conv1));
        break;
      case 2:
        $conv1 = explode("/",$date);
        $out = implode("-",array_reverse($conv1));
        break;
      case 3:
        $convHora = explode(" ",$date);
        $ConvData = explode("/",$convHora[0]);
        $out = implode("-",array_reverse($ConvData))." ".$convHora[1];
        break;
      case 4:
        $convHora = explode(" ",$date);
        $ConvData = explode("-",$convHora[0]);
        $out = implode("/",array_reverse($ConvData))." ".$convHora[1];
        break;
      }
      return $out;
   }

   function checkClienteSession(){
     if(!$this->Session->check('cliente')){
       $this->Session->setFlash(__('Por favor,ss faça seu login',true));
       $this->Session->write('redirect_page',$this->params['url']);
       $this->redirect('/clientes/login');
     }
   }

   function checkAdminSession(){
    if(!$this->Session->check('usuario')){
      //Set flash message and redirect
      $this->Session->setFlash(__('Por favor, faça seu login como administrador',true));
      $this->redirect('/admin/login');
    }
   }
   
   function _upload_file($file,$destination,$id,$size=null){
      $name = "foto_".$id.".jpg";
      if(empty($size))
        $size = array('380', '252');

      $result = $this->Upload->upload($file, $destination, $name, array('type' => 'resize', 'size' => $size, 'output' => 'jpg'));

       return $this->Upload->result;
   }

   function _delete_file($file,$destination){
    if(file_exists($destination.$file)){
        @unlink($destination.$file);
    }
   }

   function _gera_passwd(){
    $sConso = 'bcdfghjklmnpqrstvwxyzbcdfghjklmnpqrstvwxyz';
    $sVogal = 'aeiou';
    $sNum = '123456789';
    $passwd = '';

    $y = strlen($sConso)-1; //conta o nº de caracteres da variável $sConso
    $z = strlen($sVogal)-1; //conta o nº de caracteres da variável $sVogal
    $r = strlen($sNum)-1; //conta o nº de caracteres da variável $sNum

     for($x=0;$x<=2;$x++){
      $rand = rand(0,$y); //Funçao rand() - gera um valor randômico
      $rand1 = rand(0,$z);
      $rand2 = rand(0,$r);
      $str = substr($sConso,$rand,1); // substr() - retorna parte de uma string
      $str1 = substr($sVogal,$rand1,1);
      $str2 = substr($sNum,$rand2,1);
      $passwd .= $str.$str1.$str2;
    }
    return $passwd;
  }

}
?>
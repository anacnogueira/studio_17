<?php
class Evento extends AppModel {
  var $belongsTo = array('Foto','Categoria');
	var $name = 'Evento';

  var $validate = array(
    'categoria_id'=>array(
      'rule' => array('naoVazio'),
      'required' => true,
      'message' => 'Selecione a categoria'),
     'upload' => array (
      'uploadedFile'=>array(
        'rule'=>array('validFile','uploaded'),
        'message'=>'Nгo foi possнvel fazer o upload do arquivo',
        'on'=>'create'
      ),
      'phpError' => array(
        'rule'=>array('validFile','php'),
        'message'=>'Ocorreu um erro durante o upload do arquivo',
        'on'=>'create'
      ),
      'maxFileSize' => array(
        'rule'=>array('validFile','max'),
        'message'=>'Tamanho do arquivo maior que 5MB',
        'on'=>'create'
      ),
      'allowedType' => array(
        'rule'=>array('validFile','type'),
        'message'=>'Tipo de arquivo invalido, somente sгo permitidos arquivos JPEG',
        'on'=>'create'
      ),
      'requiredFoto'=>array(
        'rule'=>array('escolherFoto'),
        'message'=>'Envie ou selecione uma foto'
      )
    )
  );

  function naoVazio($data){
    if(!empty($data))
      return true;

     return false;
  }

  function validFile($data=array(),$validation){
    $upload_info = array_shift($data);
    // No file uploaded
    if($upload_info['size'] != 0){
      switch($validation){

        case 'type':
          $ext = end(explode('.',$upload_info['name']));
          if($ext != "jpg")
            return false;
          break;
        case 'max':
          if($upload_info['size'] >  Configure::read('File.max_file_size_kb')){ // 5MB
            return false;
          }
          break;
        case 'php':
          if ($upload_info['error'] !== 0)
            return false;
          break;
        case 'uploaded':
          return is_uploaded_file($upload_info['tmp_name']);
          break;
        default:
          echo 'Validaзгo invбlida';
          return false;
      }
    }
    return true;
  }

  function escolherFoto($data=array()){
    $upload_info = array_shift($data);

    if (empty($upload_info['size']) and !isset($this->data[$this->name]['foto_id'])){
      return false;
    }

    return true;
  }
}
?>
<?php
  class Fotografo extends AppModel {
    var $name = 'Fotografo';

    var $validate = array(
      'nome'=>array(
        'rule'=>'notEmpty',
        'required'=>true,
        'message'=>'Insira o nome do fotógrafo'
      ),
      'upload' => array (
        'uploadedFile'=>array(
          'rule'=>array('validFile','uploaded'),
          'message'=>'Não foi possível fazer o upload do arquivo',
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
          'message'=>'Tipo de arquivo inválido, somente são permitidos arquivos JPEG',
          'on'=>'create'
        ),
        'emptyFile' => array(
          'rule'=>array('validFile','empty'),
          'message'=>'Nenhum arquivo enviado',
          'on'=>'create'
        )
      ),
      'descricao'=>array(
        'rule'=>'notEmpty',
        'required'=>true,
        'message'=>'Insira o texto')
    );

    function validFile($data=array(),$validation){
      $upload_info = array_shift($data);

      // No file uploaded.
      switch($validation){
        case 'empty':
          if ($upload_info['size'] == 0)
            return false;
          break;
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
          echo 'Validação inválida';
          return false;
      }
     return true;
    }
  }
?>
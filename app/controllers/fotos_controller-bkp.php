<?php
uses('sanitize');
  class FotosController extends AppController{
    var $name = "fotos";
    var $components = array('Upload');

    /* ADMIN */
    function admin_index(){
      $this->layout = "admin";
      $this->set("title_for_layout","Fotos");

      $this->paginate = array(
        'fields' => array('Foto.*'),
        'order'=>'id DESC',
        'limit'=>20);
      $fotos = $this->paginate('Foto');
      $this->set(compact('fotos'));
    }
    function admin_view($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Fotos &raquo; Visualizar");

      if (!$id) {
			  $this->Session->setFlash(__('Foto Inválida', true));
        $this->redirect(array('controller'=>'fotos','action'=>'admin_index'));
		  }
      $foto =  $this->Foto->read(null, $id);
      $this->set(compact('foto'));
    }

    function admin_add(){
      $this->layout = "admin";
      $this->set("title_for_layout","Fotos &raquo; Cadastrar");
      $destination = Configure::read('File.destination_fotos');

      if (!empty($this->data)) {
        //Upload da imagem
		    if($this->data['Foto']['foto']['error']==0){
		    // set the upload destination folder
		    

		    // grab the file
		    $file = $this->data['Foto']['foto'];
        $id =  $this->Foto->find('first',array(
          'fields'=>array('id'),
          'order'=>'id DESC'));

        $name = "foto_".($id['Foto']['id']+1).".jpg";

		    //upload the image using the upload component
		    $result = $this->Upload->upload($file, $destination, $name, array('type' => 'resize', 'size' => array('380', '252'), 'output' => 'jpg'));

		    if (!$result){
			    $this->data['Foto']['foto'] = $this->Upload->result;
		    } else {
			    // display error
			    $errors = $this->Upload->errors;

			    // piece together errors
			    if(is_array($errors)){ $errors = implode("<br />",$errors); }

			    $this->Session->setFlash($errors);
			    $this->redirect(array("action" => "admin_add"));
			    exit();
		    }
      }
		  if ($this->Foto->save($this->data)) {
			  $this->Session->setFlash('Foto criada com sucesso');
			  $this->redirect(array("action" => "admin_index"));
		  } else {
			  $this->Session->setFlash('por favor corrija os erros abaixo');
			  @unlink($destination.$this->Upload->result);
		  }
    }
   }

    function admin_edit($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Fotos &raquo; Editar");
      $destination = Configure::read('File.destination_fotos');

      if (!$id && empty($this->data)) {
        $this->Session->setFlash(__('Foto Inválida', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if (!empty($this->data)) {
		    if($this->data['Foto']['foto']['error'] == 0){	    
          // grab the file
          $file = $this->data['Foto']['foto'];
          $name = "foto_".$id.".jpg";

          //upload the image using the upload component
          $result = $this->Upload->upload($file, $destination, $name, array('type' => 'resize', 'size' => array('380', '252'), 'output' => 'jpg'));

          if (!$result){
            $this->data['Foto']['foto'] = $this->Upload->result;
          } else {
            // display error
            $errors = $this->Upload->errors;

            // piece together errors
            if(is_array($errors)){ $errors = implode("<br />",$errors); }

            $this->Session->setFlash($errors);
            $this->redirect(array("action" => "admin_edit"));
            exit();
          }
        } else
          $this->data['Foto']['foto'] = $this->data['Foto']['foto_old'];

        if ($this->Foto->save($this->data)) {
          $this->Session->setFlash(__('A Foto foi salva.', true));
          $this->redirect(array('controller'=>'fotos','action'=>'admin_index'));
			  } else {
          //$this->Session->setFlash(__('Não foi possível editar usuário.', true));
          //$this->redirect(array('controller'=>'usuarios','action'=>'admin_index'));
			  }
		  }
		  if(empty($this->data)) {
        $this->data = $this->Foto->read(null, $id);
        $this->data['Foto']['foto_old'] =  $this->data['Foto']['foto'];
		  }
    }

    function admin_delete($id = null){
      $destination = Configure::read('File.destination_fotos');
      if (!$id) {
			  $this->Session->setFlash(__('Foto Inválida', true));
        $this->redirect(array("action" => "admin_index"));
		  }
      //Selecionar imagem para excluir
      $foto = $this->Foto->find('first',array('fields'=>array('Foto.foto'),
      'conditions'=>array('Foto.id'=>$id)));  
      $file = $foto['Foto']['foto']; 
      
      //Excluir foto da pasta      
      if(file_exists($destination.$file)){
        unlink($destination.$file);
      }

      if ($this->Foto->delete($id)) {
        $this->flash(__('Foto excluída', true), array('action'=>'admin_index'));
        $this->redirect(array("action" => "admin_index"));
		  }
    }
  }
?>

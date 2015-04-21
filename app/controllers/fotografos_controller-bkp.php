<?php
  class FotografosController extends AppController{
    var $name = "fotografos";
     var $components = array('Upload');

    /* FRONTEND */
    function index() {
     $fotografos = $this->Fotografo->find('all',array(
     'fields'=>array('nome','foto','descricao'),
     'order'=>'nome'));
     $this->set(compact('fotografos'));
     $this->set("title_for_layout",'Fotógrafos');
    }

    /* ADMIN */
    function admin_index(){
      $this->layout = "admin";
      $this->set("title_for_layout","Fotografos");

      $this->Fotografo->recursive = 1;
      //Filtrar condições
      $conditions = array();
      if(empty($this->data))
        $index_qtde = 1;
      else
        $index_qtde  = $this->data['Fotografo']['qtde'];

      if(!empty($this->data['Fotografo']['nome'])){
        $conditions['nome LIKE'] = '%'.$this->data['Fotografo']['nome'].'%';
      }

      $this->paginate = array(
        'limit'=>$this->qtde[$index_qtde],
        'conditions' => array($conditions),
        'fields' => array('Fotografo.*'));

      $fotografos = $this->paginate('Fotografo');
      $this->set(compact('fotografos'));
    }

    function admin_view($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Fotografos &raquo; Visualizar");

      if (!$id) {
			  $this->Session->setFlash(__('Fotógrafo Inválido', true));
        $this->redirect(array('controller'=>'fotografos','action'=>'admin_index'));
		  }
      $fotografo =  $this->Fotografo->read(null, $id);
      $this->set(compact('fotografo'));
    }

    function admin_add(){
      $this->layout = "admin";
      $this->set("title_for_layout","Fotografos &raquo; Cadastrar");

      if (!empty($this->data)) {

        //Upload da imagem
		    if($this->data['Fotografo']['foto']['error']== 0){
		    // set the upload destination folder
		    $destination = realpath('../../app/webroot/img/fotografos') . '/';

		    // grab the file
		    $file = $this->data['Fotografo']['foto'];
        $id =  $this->Fotografo->find('first',array(
          'fields'=>array('id'),
          'order'=>'id DESC'));


        $name = "foto_".($id['Fotografo']['id']+1).".jpg";

		    //upload the image using the upload component
		    $result = $this->Upload->upload($file, $destination, $name, array('type' => 'resize', 'size' => '160', 'output' => 'jpg'));

		    if (!$result){
			    $this->data['Fotografo']['foto'] = $this->Upload->result;
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
        $this->Fotografo->create();

        if ($this->Fotografo->save($this->data)) {
            $this->Session->setFlash(__('Fotógrafo criado com sucesso.', true));
            $this->redirect(array("action" => "admin_index"));
			  } else {
         //Erro ao cadastrar categoria
         //$this->Session->setFlash(__('Não foi possível cadastrar categoria. Por favor,
         //contacte o administrador do site.', true));
        }
      }
    }

    function admin_edit($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Fotografos &raquo; Editar");

      if (!$id && empty($this->data)) {
        $this->Session->setFlash(__('Fotógrafo Inválido', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if (!empty($this->data)) {
		    //Upload da imagem
		    if($this->data['Fotografo']['foto']['error']== 0){
		    // set the upload destination folder
		    $destination = realpath('../../app/webroot/img/fotografos') . '/';

		    // grab the file
		    $file = $this->data['Fotografo']['foto'];
        $name = "foto_".$id.".jpg";

		    //upload the image using the upload component
		    $result = $this->Upload->upload($file, $destination, $name, array('type' => 'resize', 'size' => '160', 'output' => 'jpg'));

		    if (!$result){
			    $this->data['Fotografo']['foto'] = $this->Upload->result;
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
        if ($this->Fotografo->save($this->data)) {
				  $this->Session->setFlash(__('O Fotógrafo foi salvo.', true));
          $this->redirect(array('controller'=>'fotografos','action'=>'admin_index'));
			  } else {
          //$this->Session->setFlash(__('Não foi possível editar usuário.', true));
          //$this->redirect(array('controller'=>'usuarios','action'=>'admin_index'));
			  }
		  }
		  if (empty($this->data)) {
        $this->data = $this->Fotografo->read(null, $id);
		  }
    }

    function admin_delete($id = null){
      if (!$id) {
			  $this->Session->setFlash(__('Fotógrafo Inválido', true));
        $this->redirect(array("action" => "admin_index"));
		  }
      //Excluir foto da pasta
      $folder = realpath('../../app/webroot/img/fotografos') . '/';
      $file = "foto_".$id.".jpg";
      if(file_exists($folder.$file)){
        unlink($folder.$file);
      }
		  if ($this->Fotografo->delete($id)) {
			  $this->flash(__('Fotógrafo excluído', true), array('action'=>'admin_index'));
        $this->redirect(array("action" => "admin_index"));
		  }
    }
  }
?>
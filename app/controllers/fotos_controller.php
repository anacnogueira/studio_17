<?php
uses('sanitize');
  class FotosController extends AppController{
    var $name = "fotos";

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

      if (isset($this->data)) {
			  $this->Foto->set($this->data);
        if ($this->Foto->validates()) {
          $this->Foto->create(true);
          if($this->Foto->save($this->data)){
            if(!empty($this->data['Foto']['upload'])){
              $file = $this->data['Foto']['upload'];
              $id = $this->Foto->id;
              $result = parent::_upload_file($file, $destination, $id);

              //Atualiza campo foto no banco
              $this->data['Foto']['foto'] = $result;
              $this->data['Foto']['id'] = $id;
              $this->Foto->save($this->data);
            }
            $this->Session->setFlash('Foto adicionada com sucesso');
					  $this->redirect('index');
				  } else {
			      $this->Session->setFlash('Preencha os campos corretamente');
          }
			  }
		  }
   }

    function admin_edit($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Fotos &raquo; Editar");
      $destination = Configure::read('File.destination_fotos');

      if (isset($this->data)) {
			  if(!empty($this->data['Foto']['upload'])){
          //Buscar e pagar arquivo antigo
          $foto = $this->Foto->findById($this->data['Foto']['id']);
          $file_old = $foto['Foto']['foto'];
          parent::_delete_file($file_old,$destination);

          //Salvar novo arquivo
          $file = $this->data['Foto']['upload'];
          $result = parent::_upload_file($file,$destination, $this->data['Foto']['id']);
          $this->data['Foto']['foto'] = $result;
        }
        $this->Foto->create(false);
        if ($this->Foto->save($this->data)) {
				  $this->Session->setFlash('Foto alterada com sucesso.');
				  $this->redirect('index');
			  } else {
				  $this->Session->setFlash('Preencha os campos corretamente.');
			  }
		  } else {
			  if ($id != NULL) {
				  $foto = $this->Foto->findById($id);
          $this->data = $foto;
			  } else {
				  $this->Session->setFlash('Foto não encontrada!');
				  $this->redirect('index');
			  }
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
      parent::_delete_file($file,$destination);

      if ($this->Foto->delete($id)) {
        $this->flash(__('Foto excluída', true), array('action'=>'admin_index'));
        $this->redirect(array("action" => "admin_index"));
		  }
    }
  }
?>

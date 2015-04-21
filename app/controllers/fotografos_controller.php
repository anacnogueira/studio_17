<?php
  class FotografosController extends AppController{
    var $name = "fotografos";

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
      $this->set("title_for_layout","Fotógrafos");

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
      $this->set("title_for_layout","Fotóografos &raquo; Visualizar");

      if (!$id) {
			  $this->Session->setFlash(__('Fotógrafo Inválido', true));
        $this->redirect(array('controller'=>'fotografos','action'=>'admin_index'));
		  }
      $fotografo =  $this->Fotografo->read(null, $id);
      $this->set(compact('fotografo'));
    }

    function admin_add(){
      $this->layout = "admin";
      $this->set("title_for_layout","Fotógrafos &raquo; Cadastrar");
      $destination = Configure::read('File.destination_fotografos');

      if (isset($this->data)) {
			  $this->Fotografo->set($this->data);
        if ($this->Fotografo->validates()) {
          $this->Fotografo->create(true);
          if($this->Fotografo->save($this->data)){
            if(!empty($this->data['Fotografo']['upload'])){
              $file = $this->data['Fotografo']['upload'];
              $id = $this->Fotografo->id;
              $result = parent::_upload_file($file, $destination, $id,'160');

              //Atualiza campo foto no banco
              $this->data['Fotografo']['foto'] = $result;
              $this->data['Fotografo']['id'] = $id;
              $this->Fotografo->save($this->data);
            }
            $this->Session->setFlash('Fotógrafo adicionado com sucesso');
					  $this->redirect('index');
				  } else {
			      $this->Session->setFlash('Preencha os campos corretamente');
          }
			  }
		  }
    }

    function admin_edit($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Fotógrafos &raquo; Editar");
       $destination = Configure::read('File.destination_fotografos');

      if (isset($this->data)) {
			  if(!empty($this->data['Fotografo']['upload'])){
          //Buscar e pagar arquivo antigo
          $foto = $this->Fotografo->findById($this->data['Foto']['id']);
          $file_old = $foto['Fotografo']['foto'];
          parent::_delete_file($file_old,$destination);

          //Salvar novo arquivo
          $file = $this->data['Fotografo']['upload'];
          $result = parent::_upload_file($file,$destination, $this->data['Fotografo']['id'],'160');
          $this->data['Fotografo']['foto'] = $result;
        }
        $this->Fotografo->create(false);
        if ($this->Fotografo->save($this->data)) {
				  $this->Session->setFlash('Fotógrafos alterado com sucesso.');
				  $this->redirect('index');
			  } else {
				  $this->Session->setFlash('Preencha os campos corretamente.');
			  }
		  } else {
			  if ($id != NULL) {
				  $foto = $this->Fotografo->findById($id);
          $this->data = $foto;
			  } else {
				  $this->Session->setFlash('Fotógrafos não encontrado!');
				  $this->redirect('index');
			  }
		  }
    }

    function admin_delete($id = null){
      $destination = Configure::read('File.destination_fotografos');
      if (!$id) {
			  $this->Session->setFlash(__('Fotógrafo Inválido', true));
        $this->redirect(array("action" => "admin_index"));
		  }
      //Selecionar imagem para excluir
      $foto = $this->Fotografo->find('first',array('fields'=>array('Fotografo.foto'),
      'conditions'=>array('Fotografo.id'=>$id)));
      $file = $foto['Fotografo']['foto'];

      //Excluir foto da pasta
      parent::_delete_file($file,$destination);

      if ($this->Fotografo->delete($id)) {
        $this->flash(__('Fotógrafo excluído', true), array('action'=>'admin_index'));
        $this->redirect(array("action" => "admin_index"));
		  }
    }
  }
?>
<?php
  class EnsaiosFotograficosController extends AppController{
    var $name = "ensaios_fotograficos";
    var $helpers = array('PhotoGallery','BdImages');
    var $components = array('Upload');

    /* FRONTEND */
    function index() {
      $this->set('ensaios',$this->EnsaiosFotografico->find('all'));
      $this->set("title_for_layout","Ensaios Fotográficos");
    }

    /* ADMIN */
    function admin_index(){
      $this->layout = "admin";
      $this->set("title_for_layout","Ensaios Fotográficos");

      $this->EnsaiosFotografico->recursive = 1;
      //Filtrar condições
      $conditions = array();
      if(empty($this->data))
        $index_qtde = 1;
      else
        $index_qtde  = $this->data['EnsaiosFotografico']['qtde'];


      $this->paginate = array(
        'fields' => array('EnsaiosFotografico.*','Foto.*'),
        'conditions' => array($conditions),
        'order'=>'EnsaiosFotografico.id DESC',
        'limit'=>$this->qtde[$index_qtde]);

      $ensaios = $this->paginate('EnsaiosFotografico');
      $this->set(compact('ensaios'));
    }
    
    function admin_view($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Ensaios Fotográficos &raquo; Visualizar");

      if (!$id) {
			  $this->Session->setFlash(__('Ensaio Fotográfico Inválido', true));
        $this->redirect(array('controller'=>'ensaios_fotograficos','action'=>'admin_index'));
		  }
      $ensaio =  $this->EnsaiosFotografico->read(null, $id);
      $this->set(compact('ensaio'));
    }

    function admin_add(){
      $this->layout = "admin";
      $this->set("title_for_layout","Ensaios Fotográficos &raquo; Cadastrar");
      $destination = Configure::read('File.destination_fotos');

      if (isset($this->data)) {
        $this->EnsaiosFotografico->set($this->data);
        if ($this->EnsaiosFotografico->validates()) {
          if(!empty($this->data['EnsaiosFotografico']['upload']['size'])){

            $file = $this->data['EnsaiosFotografico']['upload'];
            $this->EnsaiosFotografico->Foto->save();
            $id = $this->EnsaiosFotografico->Foto->id;
            $result = parent::_upload_file($file, $destination, $id);

            //Atualiza campo foto no banco
            $this->data['Foto']['foto'] = $result;
            $this->data['Foto']['id'] = $id;
            $this->EnsaiosFotografico->Foto->save($this->data);
            $this->data['EnsaiosFotografico']['foto_id'] = $this->EnsaiosFotografico->Foto->id;
          }
          $this->EnsaiosFotografico->create(true);
          if ($this->EnsaiosFotografico->save($this->data)) {
				    $this->Session->setFlash(__('O ensaio fotográfico foi salvo.', true));
            $this->redirect(array('action'=>'index'));
			    } else {
            $this->Session->setFlash(__('Por favor, corrija os erros abaixo', true));
          }
        }
      }

      $fotos      = $this->EnsaiosFotografico->Foto->find('all',array('order'=>'id DESC'));
      $this->set(compact('fotos'));
    }

    function admin_edit($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Ensaios Fotográficos &raquo; Editar");
      $destination = Configure::read('File.destination_fotos');

		  if (isset($this->data)) {
        $this->EnsaiosFotografico->set($this->data);
        if ($this->EnsaiosFotografico->validates()) {
          if(!empty($this->data['EnsaiosFotografico']['upload']['size'])){

            $file = $this->data['EnsaiosFotografico']['upload'];
            $this->EnsaiosFotografico->Foto->save();
            $id = $this->EnsaiosFotografico->Foto->id;
            $result = parent::_upload_file($file, $destination, $id);

            //Atualiza campo foto no banco
            $this->data['Foto']['foto'] = $result;
            $this->data['Foto']['id'] = $id;
            $this->EnsaiosFotografico->Foto->save($this->data);
            $this->data['EnsaiosFotografico']['foto_id'] = $this->EnsaiosFotografico->Foto->id;
          }
          $this->EnsaiosFotografico->create(false);
          if ($this->EnsaiosFotografico->save($this->data)) {
				    $this->Session->setFlash(__('O ensaio fotográfico foi salvo.', true));
            $this->redirect(array('action'=>'index'));
			    } else {
            $this->Session->setFlash(__('Por favor, corrija os erros abaixo', true));
          }
        }
      }  else {
			  if ($id != NULL) {
				  $ensaio = $this->EnsaiosFotografico->findById($id);
          $this->data = $ensaio;
			  } else {
				  $this->Session->setFlash('Ensaio Fotográfico não encontrado!');
				  $this->redirect('index');
			  }
		  }

      $fotos  = $this->EnsaiosFotografico->Foto->find('all',array('order'=>'id DESC'));
      $this->set(compact('fotos'));
    }
    
    function admin_delete($id = null){
      if (!$id) {
			  $this->Session->setFlash(__('Ensaio Fotográfico Inválido', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if ($this->EnsaiosFotografico->delete($id)) {
			  $this->flash(__('Ensaio Fotográfico excluído', true), array('action'=>'admin_index'));
        $this->redirect(array("action" => "admin_index"));
		  }
    }
  }
?>

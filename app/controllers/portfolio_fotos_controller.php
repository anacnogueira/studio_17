<?php
  class PortfolioFotosController extends AppController{
    var $name = "portfolio_fotos";
    var $helpers = array('PhotoGallery','BdImages');
    var $components = array('Upload');

    /* FRONTEND */
    function index() {
      $this->set('fotos',$this->PortfolioFoto->find('all'));
      $this->set("title_for_layout","Portfolio &raquo; Fotos");
    }

       /* ADMIN */
    /* ADMIN */
    function admin_index(){
      $this->layout = "admin";
      $this->set("title_for_layout","Portfolio &raquo; Fotos");

      $this->PortfolioFoto->recursive = 0;
      //Filtrar condições
      $conditions = array();
      if(empty($this->data))
        $index_qtde = 1;
      else
        $index_qtde  = $this->data['PortfolioFoto']['qtde'];


      $this->paginate = array(
        'conditions' => array($conditions),
        'order'=>'PortfolioFoto.id DESC',
        'limit'=>$this->qtde[$index_qtde]);

      $fotos = $this->paginate('PortfolioFoto');
      $this->set(compact('fotos'));
    }

    function admin_view($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Portfolio &raquo; Fotos &raquo; Visualizar");

       if (!$id) {
			  $this->Session->setFlash(__('Foto Inválida', true));
        $this->redirect(array('controller'=>'portfolio_fotos','action'=>'admin_index'));
		  }
      $foto =  $this->PortfolioFoto->read(null, $id);
      $this->set(compact('foto'));
    }

    function admin_add(){
      $this->layout = "admin";
      $this->set("title_for_layout","Portfolio &raquo; Fotos &raquo; Cadastrar");
      $destination = Configure::read('File.destination_fotos');

      if (isset($this->data)) {
        $this->PortfolioFoto->set($this->data);
        if ($this->PortfolioFoto->validates()) {
          if(!empty($this->data['PortfolioFoto']['upload']['size'])){

            $file = $this->data['PortfolioFoto']['upload'];
            $this->PortfolioFoto->Foto->save();
            $id = $this->PortfolioFoto->Foto->id;
            $result = parent::_upload_file($file, $destination, $id);

            //Atualiza campo foto no banco
            $this->data['Foto']['foto'] = $result;
            $this->data['Foto']['id'] = $id;
            $this->PortfolioFoto->Foto->save($this->data);
            $this->data['PortfolioFoto']['foto_id'] = $this->PortfolioFoto->Foto->id;
          }
          $this->PortfolioFoto->create(true);
          if ($this->PortfolioFoto->save($this->data)) {
				    $this->Session->setFlash(__('A foto foi salva.', true));
            $this->redirect(array('action'=>'index'));
			    } else {
            $this->Session->setFlash(__('Por favor, corrija os erros abaixo', true));
          }
        }
      }

      $fotos = $this->PortfolioFoto->Foto->find('all',array('order'=>'id DESC'));
      $this->set(compact('fotos'));
    }

    function admin_edit($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Portfolio &raquo; Fotos &raquo; Editar");
      $destination = Configure::read('File.destination_fotos');

		  if (isset($this->data)) {
        $this->PortfolioFoto->set($this->data);
        if ($this->PortfolioFoto->validates()) {
          if(!empty($this->data['PortfolioFoto']['upload']['size'])){

            $file = $this->data['PortfolioFoto']['upload'];
            $this->PortfolioFoto->Foto->save();
            $id = $this->PortfolioFoto->Foto->id;
            $result = parent::_upload_file($file, $destination, $id);

            //Atualiza campo foto no banco
            $this->data['Foto']['foto'] = $result;
            $this->data['Foto']['id'] = $id;
            $this->PortfolioFoto->Foto->save($this->data);
            $this->data['PortfolioFoto']['foto_id'] = $this->PortfolioFoto->Foto->id;
          }
          $this->PortfolioFoto->create(false);
          if ($this->PortfolioFoto->save($this->data)) {
				    $this->Session->setFlash(__('A foto foi salva.', true));
            $this->redirect(array('action'=>'index'));
			    } else {
            $this->Session->setFlash(__('Por favor, corrija os erros abaixo', true));
          }
        }
      } else {
			  if ($id != NULL) {
				  $foto = $this->PortfolioFoto->findById($id);
          $this->data = $foto;
			  } else {
				  $this->Session->setFlash('Foto não encontrada!');
				  $this->redirect('index');
			  }
		  }

      $fotos = $this->PortfolioFoto->Foto->find('all',array('order'=>'id DESC'));
      $this->set(compact('fotos'));
    }

    function admin_delete($id = null){
      if (!$id) {
			  $this->Session->setFlash(__('Foto Inválida', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if ($this->PortfolioFoto->delete($id)) {
			  $this->flash(__('Foto excluída', true), array('action'=>'admin_index'));
        $this->redirect(array("action" => "admin_index"));
		  }
    }
  }
?>

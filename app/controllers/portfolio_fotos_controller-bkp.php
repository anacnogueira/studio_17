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

      if (!empty($this->data)) {
        //verifica se foi enviada nova foto
        if($this->data['PortfolioFoto']['foto']['error']==0){
		      // set the upload destination folder
		      $destination = realpath('../../app/webroot/img/fotos') . '/';

		      // grab the file
		      $file = $this->data['PortfolioFoto']['foto'];
          $id =  $this->PortfolioFoto->Foto->find('first',array(
            'fields'=>array('id'),
            'order'=>'id DESC'));

          $name = "foto_".($id['Foto']['id']+1).".jpg";

		      //upload the image using the upload component
		      $result = $this->Upload->upload($file, $destination, $name, array('type' => 'resize', 'size' => array('380', '252'), 'output' => 'jpg'));

		      if (!$result){
			      $this->data['Foto']['foto'] = $this->Upload->result;

            if ($this->PortfolioFoto->Foto->save($this->data)) {
              $this->data['PortfolioFoto']['foto_id'] = $this->PortfolioFoto->Foto->id;
            }
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
        $this->PortfolioFoto->create();

        if ($this->PortfolioFoto->save($this->data)) {
            $this->Session->setFlash(__('Foto criada com sucesso.', true));
            $this->redirect(array("action" => "admin_index"));
			  } else {
         //Erro ao cadastrar categoria
         //$this->Session->setFlash(__('Não foi possível cadastrar categoria. Por favor,
         //contacte o administrador do site.', true));
        }
      }
      $fotos      = $this->PortfolioFoto->Foto->find('all',array('order'=>'id DESC'));
      $this->set(compact('fotos'));
    }

    function admin_edit($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Portfolio &raquo; Fotos &raquo; Editar");

      if (!$id && empty($this->data)) {
        $this->Session->setFlash(__('Foto Inválida', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if (!empty($this->data)) {
		    //verifica se foi enviada nova foto
        if($this->data['PortfolioFoto']['foto']['error']==0){
		      // set the upload destination folder
		      $destination = realpath('../../app/webroot/img/fotos') . '/';

		      // grab the file
		      $file = $this->data['PortfolioFoto']['foto'];
          $id =  $this->PortfolioFoto->Foto->find('first',array(
            'fields'=>array('id'),
            'order'=>'id DESC'));

          $name = "foto_".($id['Foto']['id']+1).".jpg";

		      //upload the image using the upload component
		      $result = $this->Upload->upload($file, $destination, $name, array('type' => 'resize', 'size' => array('380', '252'), 'output' => 'jpg'));

		      if (!$result){
			      $this->data['Foto']['foto'] = $this->Upload->result;

            if ($this->PortfolioFoto->Foto->save($this->data)) {
              $this->data['PortfolioFoto']['foto_id'] = $this->PortfolioFoto->Foto->id;
            }
		      } else {
			      // display error
			      $errors = $this->Upload->errors;

			      // piece together errors
			      if(is_array($errors)){ $errors = implode("<br />",$errors); }

			      $this->Session->setFlash($errors);
			      $this->redirect(array("action" => "admin_edit"));
			      exit();
		      }
        }
        if ($this->PortfolioFoto->save($this->data)) {
				  $this->Session->setFlash(__('A Foto foi salva.', true));
          $this->redirect(array('controller'=>'portfolio_fotos','action'=>'admin_index'));
			  } else {
          //$this->Session->setFlash(__('Não foi possível editar usuário.', true));
          //$this->redirect(array('controller'=>'usuarios','action'=>'admin_index'));
			  }
		  }
		  if (empty($this->data)) {
        $this->data = $this->PortfolioFoto->read(null, $id);
		  }
      $fotos      = $this->PortfolioFoto->Foto->find('all',array('order'=>'id DESC'));
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

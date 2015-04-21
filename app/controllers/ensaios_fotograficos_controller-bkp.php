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

      if (!empty($this->data)) {
        //verifica se foi enviada nova foto
        if($this->data['EnsaiosFotografico']['foto']['error']==0){
		      // set the upload destination folder
		      $destination = realpath('../../app/webroot/img/fotos') . '/';

		      // grab the file
		      $file = $this->data['EnsaiosFotografico']['foto'];
          $id =  $this->EnsaiosFotografico->Foto->find('first',array(
            'fields'=>array('id'),
            'order'=>'id DESC'));

          $name = "foto_".($id['Foto']['id']+1).".jpg";

		      //upload the image using the upload component
		      $result = $this->Upload->upload($file, $destination, $name, array('type' => 'resize', 'size' => array('380', '252'), 'output' => 'jpg'));

		      if (!$result){
			      $this->data['Foto']['foto'] = $this->Upload->result;

            if ($this->EnsaiosFotografico->Foto->save($this->data)) {
              $this->data['EnsaiosFotografico']['foto_id'] = $this->EnsaiosFotografico->Foto->id;
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
        $this->EnsaiosFotografico->create();

        if ($this->EnsaiosFotografico->save($this->data)) {
            $this->Session->setFlash(__('Ensaio Fotográfico criado com sucesso.', true));
            $this->redirect(array("action" => "admin_index"));
			  } else {
         //Erro ao cadastrar categoria
         //$this->Session->setFlash(__('Não foi possível cadastrar categoria. Por favor,
         //contacte o administrador do site.', true));
        }
      }
      $fotos      = $this->EnsaiosFotografico->Foto->find('all',array('order'=>'id DESC'));
      $this->set(compact('fotos'));
    }
    
    function admin_edit($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Ensaios Fotográficos &raquo; Editar");

      if (!$id && empty($this->data)) {
        $this->Session->setFlash(__('Ensaio Fotográfico Inválido', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if (!empty($this->data)) {
		    //verifica se foi enviada nova foto
        if($this->data['EnsaiosFotografico']['foto']['error']==0){
		      // set the upload destination folder
		      $destination = realpath('../../app/webroot/img/fotos') . '/';

		      // grab the file
		      $file = $this->data['EnsaiosFotografico']['foto'];
          $id =  $this->EnsaiosFotografico->Foto->find('first',array(
            'fields'=>array('id'),
            'order'=>'id DESC'));

          $name = "foto_".($id['Foto']['id']+1).".jpg";

		      //upload the image using the upload component
		      $result = $this->Upload->upload($file, $destination, $name, array('type' => 'resize', 'size' => array('380', '252'), 'output' => 'jpg'));

		      if (!$result){
			      $this->data['Foto']['foto'] = $this->Upload->result;

            if ($this->EnsaiosFotografico->Foto->save($this->data)) {
              $this->data['EnsaiosFotografico']['foto_id'] = $this->EnsaiosFotografico->Foto->id;
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
        if ($this->EnsaiosFotografico->save($this->data)) {
				  $this->Session->setFlash(__('O Ensaio Fotográfico foi salvo.', true));
          $this->redirect(array('controller'=>'ensaios_fotograficos','action'=>'admin_index'));
			  } else {
          //$this->Session->setFlash(__('Não foi possível editar usuário.', true));
          //$this->redirect(array('controller'=>'usuarios','action'=>'admin_index'));
			  }
		  }
		  if (empty($this->data)) {
        $this->data = $this->EnsaiosFotografico->find('first',array(
          'conditions'=>array('EnsaiosFotografico.id'=>$id)
        ));
		  }

      $fotos      = $this->EnsaiosFotografico->Foto->find('all',array('order'=>'id DESC'));
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

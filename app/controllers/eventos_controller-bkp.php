<?php
  class EventosController extends AppController{
    var $name = "eventos";
    var $helpers = array('PhotoGallery','BdImages');

   /* FRONTEND */
    function index($categoria=null) {
      $max_count = $this->Evento->Categoria->find('first',array(
       'fields'=>array('SUM(clicks) as max_count')));

      $this->set('max_count',$max_count[0]['max_count']);
      $this->set('categorias',$this->Evento->Categoria->find('all'));
      $conditions = array();
      if($categoria)
       $conditions['Categoria.name'] = $categoria;

      $this->set('eventos',$this->Evento->find('all',array('conditions'=>$conditions)));
      $this->set(compact('categoria'));
      $this->set("title_for_layout",'Eventos'. (!empty($categoria) ? ' &raquo; '.$categoria :''));
   }

   /* ADMIN */
    function admin_index(){
      $this->layout = "admin";
      $this->set("title_for_layout","Eventos");

      $this->Evento->recursive = 0;
      //Filtrar condições
      $conditions = array();
      if(empty($this->data))
        $index_qtde = 1;
      else
        $index_qtde  = $this->data['Evento']['qtde'];

      if(!empty($this->data['Evento']['categoria_id'])){
        $conditions['categoria_id'] = $this->data['Evento']['categoria_id'];
      }

      $this->paginate = array(
        'conditions' => array($conditions),
        'order'=>'Evento.id DESC',
        'limit'=>$this->qtde[$index_qtde]);

      $eventos = $this->paginate('Evento');
      $categorias = $this->Evento->Categoria->find('list',array('order'=>'name'));
      array_unshift($categorias,"Todas");
      $this->set(compact('eventos','categorias'));
    }

    function admin_view($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Eventos &raquo; Visualizar");

      if (!$id) {
			  $this->Session->setFlash(__('Evento Inválido', true));
        $this->redirect(array('controller'=>'eventos','action'=>'admin_index'));
		  }
      $evento =  $this->Evento->read(null, $id);
      $this->set(compact('evento'));
    }

    function admin_add(){
      $this->layout = "admin";
      $this->set("title_for_layout","Eventos &raquo; Cadastrar");
      $destination = Configure::read('File.destination_fotos'); 
      if (!empty($this->data)) {

        if($this->data['Evento']['foto']['error']==0){
		    // set the upload destination folder
		    $destination = realpath('../../app/webroot/img/fotos') . '/';

		    // grab the file
		    $file = $this->data['Evento']['foto'];
        $id =  $this->Evento->Foto->find('first',array(
          'fields'=>array('id'),
          'order'=>'id DESC'));


        $name = "foto_".($id['Foto']['id']+1).".jpg";

		    //upload the image using the upload component
		    $result = $this->Upload->upload($file, $destination, $name, array('type' => 'resize', 'size' => array('380', '252'), 'output' => 'jpg'));

		    if (!$result){
			    $this->data['Foto']['foto'] = $this->Upload->result;

          if ($this->Evento->Foto->save($this->data)) {
             $this->data['Evento']['foto_id'] = $this->Evento->Foto->id;
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
        $this->Evento->create();
        if ($this->Evento->save($this->data)) {
            $this->Session->setFlash(__('Evento criado com sucesso.', true));
            $this->redirect(array("action" => "admin_edit"));
			  } else {
         //Erro ao cadastrar categoria
         //$this->Session->setFlash(__('Não foi possível cadastrar categoria. Por favor,
         //contacte o administrador do site.', true));
        }
      }
      $fotos      = $this->Evento->Foto->find('all',array('order'=>'id DESC'));
      $categorias = $this->Evento->Categoria->find('list',array('order'=>'name'));
      $this->set(compact('categorias','fotos'));
    }

    function admin_edit($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Eventos &raquo; Editar");

      if (!$id && empty($this->data)) {
        $this->Session->setFlash(__('Evento Inválido', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if (!empty($this->data)) {
		    //verifica se foi enviada nova foto

       	if($this->data['Evento']['foto']['error']==0){
		    // set the upload destination folder
		    $destination = realpath('../../app/webroot/img/fotos') . '/';

		    // grab the file
		    $file = $this->data['Evento']['foto'];
        $id =  $this->Evento->Foto->find('first',array(
          'fields'=>array('id'),
          'order'=>'id DESC'));

        $name = "foto_".($id['Foto']['id']+1).".jpg";

		    //upload the image using the upload component
		    $result = $this->Upload->upload($file, $destination, $name, array('type' => 'resize', 'size' => array('380', '252'), 'output' => 'jpg'));

		    if (!$result){
			    $this->data['Evento']['foto'] = $this->Upload->result;

          if ($this->Evento->Foto->save($this->data)) {
             $this->data['Evento']['foto_id'] = $this->Evento->Foto->id;
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
      if ($this->Evento->save($this->data)) {
				  $this->Session->setFlash(__('O evento foi salvo.', true));
          $this->redirect(array('controller'=>'eventos','action'=>'admin_index'));
			  } else {
          //$this->Session->setFlash(__('Não foi possível editar usuário.', true));
          //$this->redirect(array('controller'=>'usuarios','action'=>'admin_index'));
			  }
		  }
		  if (empty($this->data)) {
        $this->data = $this->Evento->read(null, $id);

		  }
      $fotos      = $this->Evento->Foto->find('all',array('order'=>'id DESC'));
      $categorias = $this->Evento->Categoria->find('list',array('order'=>'name'));
      $this->set(compact('categorias','fotos'));
    }
    function admin_delete($id = null){
      if (!$id) {
			  $this->Session->setFlash(__('Evento Inválido', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if ($this->Evento->delete($id)) {
			  $this->flash(__('Evento excluído', true), array('action'=>'admin_index'));
        $this->redirect(array("action" => "admin_index"));
		  }
    }
  }
?>

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

      if (isset($this->data)) {
			  $this->Evento->set($this->data);
        if ($this->Evento->validates()) {
         if(!empty($this->data['Evento']['upload']['size'])){

            $file = $this->data['Evento']['upload'];
            $this->Evento->Foto->save();
            $id = $this->Evento->Foto->id;
            $result = parent::_upload_file($file, $destination, $id);

            //Atualiza campo foto no banco
            $this->data['Foto']['foto'] = $result;
            $this->data['Foto']['id'] = $id;
            $this->Evento->Foto->save($this->data);
            $this->data['Evento']['foto_id'] = $this->Evento->Foto->id;
          }
          $this->Evento->create(true);
          if ($this->Evento->save($this->data)) {
            $this->Session->setFlash(__('Evento criado com sucesso.', true));
            $this->redirect(array("action" => "index"));
			    } else {
            //Erro ao cadastrar evento
            $this->Session->setFlash(__('Preencha os campos corretamente', true));
          }
        }
		  }
      $fotos      = $this->Evento->Foto->find('all',array('order'=>'id DESC'));
      $categorias = $this->Evento->Categoria->find('list',array('order'=>'name'));
      $this->set(compact('categorias','fotos'));
    }

    function admin_edit($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Eventos &raquo; Editar");
      $destination = Configure::read('File.destination_fotos');

      if (isset($this->data)) {
        $this->Evento->set($this->data);
        if ($this->Evento->validates()) {
          if(!empty($this->data['Evento']['upload']['size'])){

            $file = $this->data['Evento']['upload'];
            $this->Evento->Foto->save();
            $id = $this->Evento->Foto->id;
            $result = parent::_upload_file($file, $destination, $id);

            //Atualiza campo foto no banco
            $this->data['Foto']['foto'] = $result;
            $this->data['Foto']['id'] = $id;
            $this->Evento->Foto->save($this->data);
            $this->data['Evento']['foto_id'] = $this->Evento->Foto->id;
          }
          $this->Evento->create(false);
          if ($this->Evento->save($this->data)) {
				    $this->Session->setFlash(__('O evento foi salvo.', true));
            $this->redirect(array('action'=>'index'));
			    } else {
            $this->Session->setFlash(__('Preencha os campos corretamente', true));
          }
        }
      }  else {
			  if ($id != NULL) {
				  $evento = $this->Evento->findById($id);
          $this->data = $evento;
			  } else {
				  $this->Session->setFlash('Evento não encontrado!');
				  $this->redirect('index');
			  }
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

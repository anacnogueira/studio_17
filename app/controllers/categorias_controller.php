<?php
  class CategoriasController extends AppController{
    var $name = "categorias";

    /* FRONTEND */
    function index() {}

     function add_click(){
      $this->autoRender = false;
      $categoria_name = $this->data['categoria_name'];

      $this->Categoria->updateAll(
        array('clicks'=>'clicks+1'),
        array('Categoria.name'=>$categoria_name));

     print_r($this->Categoria->find('first',array(
      'conditions'=>array('name'=>$categoria_name))));
    }

    /* ADMIN */
     function admin_index(){
      $this->layout = "admin";
      $this->set("title_for_layout","Categorias");

      $this->Categoria->recursive = 1;
      //Filtrar condições
      $conditions = array();
      if(empty($this->data))
        $index_qtde = 1;
      else
        $index_qtde  = $this->data['Categoria']['qtde'];

      if(!empty($this->data['Categoria']['nome'])){
        $conditions['name LIKE'] = '%'.$this->data['Categoria']['nome'].'%';
      }

      $this->paginate = array(
        'limit'=>$this->qtde[$index_qtde],
        'conditions' => array($conditions),
        'fields' => array('Categoria.*'));

      $categorias = $this->paginate('Categoria');
      $this->set(compact('categorias'));
    }
     function admin_view($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Categorias &raquo; Visualizar");

      if (!$id) {
			  $this->Session->setFlash(__('Categoria Inválida', true));
        $this->redirect(array('controller'=>'categorias','action'=>'admin_index'));
		  }
      $categoria =  $this->Categoria->read(null, $id);
      $this->set(compact('categoria'));
    }

    function admin_add(){
      $this->layout = "admin";
      $this->set("title_for_layout","Categorias &raquo; Cadastrar");

      if (!empty($this->data)) {
        $this->Categoria->create();

        if ($this->Categoria->save($this->data)) {
            $this->Session->setFlash(__('Categoria criada com sucesso.', true));
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
      $this->set("title_for_layout","Categorias &raquo; Editar");

      if (!$id && empty($this->data)) {
        $this->Session->setFlash(__('Categoria Inválida', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if (!empty($this->data)) {
        if ($this->Categoria->save($this->data)) {
				  $this->Session->setFlash(__('A categoria foi salva.', true));
          $this->redirect(array('controller'=>'categorias','action'=>'admin_index'));
			  } else {
          //$this->Session->setFlash(__('Não foi possível editar usuário.', true));
          //$this->redirect(array('controller'=>'usuarios','action'=>'admin_index'));
			  }
		  }
		  if (empty($this->data)) {
        $this->data = $this->Categoria->read(null, $id);

		  }
    }
     function admin_delete($id=null){
       if (!$id) {
			  $this->Session->setFlash(__('Categoria Inválida', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if ($this->Categoria->delete($id)) {
			  $this->flash(__('Categoria excluída', true), array('action'=>'admin_index'));
        $this->redirect(array("action" => "admin_index"));
		  }
    }
  }
?>

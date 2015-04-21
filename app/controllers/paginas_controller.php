<?php
  class PaginasController extends AppController{
    var $name = "paginas";

    /* FRONTEND */
    function display($permalink = null) {
      if (!$permalink) {
			  $this->flash(__('Página não encontrada', true), array('action'=>'index'));
      }
      $pagina = $this->Pagina->find('first',array('conditions'=>array('permalink'=>$permalink)));
      $this->set('pagina', $pagina);
      $this->set("title_for_layout",$pagina['Pagina']['titulo']);
	  }


    /* ADMIN */
    function admin_index() {
	    $this->layout = 'admin';
      $this->set("title_for_layout","Páginas");
	    $this->Pagina->recursive = 0;
		  //Filtrar condições
      $conditions = array();
      if(empty($this->data))
        $index_qtde = 1;
      else
      $index_qtde  = $this->data['Pagina']['qtde'];

      if(!empty($this->data['Pagina']['permalink'])){
        $conditions['permalink  LIKE'] = '%'.$this->data['Pagina']['permalink'].'%';
      }
      if(!empty($this->data['Pagina']['titulo'])){
        $conditions['titulo LIKE'] = '%'.$this->data['Pagina']['titulo'].'%';
      }

     $this->paginate = array(
      'limit'=>$this->qtde[$index_qtde],
      'conditions' => array($conditions),
      'fields' => array('Pagina.*'));

      $paginas = $this->paginate('Pagina');
      $this->set(compact('paginas'));
	  }

	  function admin_view($id = null) {
	    $this->layout = 'admin';
      $this->set("title_for_layout","Páginas &raquo; Visualizar");

		  if (!$id) {
			  $this->Session->setFlash(__('Página Inválida', true));
        $this->redirect(array('action'=>'admin_index'));
		  }
		  $this->set('pagina', $this->Pagina->read(null,$id));
	  }

	  function admin_add() {
	    $this->layout = 'admin';
      $this->set("title_for_layout","Páginas &raquo; Nova Página");

		  if (!empty($this->data)) {
			  $this->Pagina->create();
			  if ($this->Pagina->save($this->data)) {
				  $this->Session->setFlash(__('Página salva.', true));
          $this->redirect(array('action'=>'admin_index'));
			  } else {
			  }
	  	}
	  }

	  function admin_edit($id = null) {
	    $this->layout = 'admin';
      $this->set("title_for_layout","Páginas &raquo; Editar Página");

		  if (!$id && empty($this->data)) {
			  $this->Session->setFlash(__('Página inválida', true));
		  }
		  if (!empty($this->data)) {
			  if ($this->Pagina->save($this->data)) {
				  $this->Session->setFlash(__('A página foi salva.', true));
          $this->redirect(array('action'=>'admin_index'));
			  } else {
			  }
		  }
	  	if (empty($this->data)) {
			  $this->data = $this->Pagina->read(null, $id);
		  }
	  }

	  function admin_delete($id = null) {
	    $this->layout = 'admin';
		  if (!$id) {
			  $this->Session->setFlash(__('Página Inválida', true));
        $this->redirect(array('action'=>'admin_index'));
		  }
		  if ($this->Pagina->delete($id)) {
			  $this->Session->setFlash(__('Página excluída', true));
        $this->redirect(array('action'=>'admin_index'));
		  }
	  }
  }
?>
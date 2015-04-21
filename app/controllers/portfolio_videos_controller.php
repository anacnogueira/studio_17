<?php
  class PortfolioVideosController extends AppController{
    var $name = "portfolio_videos";
    var $helpers = array('VideoGallery');

    /* FRONTEND */
    function index() {
      $this->set('videos',$this->PortfolioVideo->find('all'));
      $this->set("title_for_layout","Portfolio &raquo; Vídeos");
    }

    /* ADMIN */
    function admin_index(){
      $this->layout = "admin";
      $this->set("title_for_layout","Portfolio &raquo; Vídeos");

      $this->PortfolioVideo->recursive = 1;
      //Filtrar condições
      $conditions = array();
      if(empty($this->data))
        $index_qtde = 1;
      else
        $index_qtde  = $this->data['PortfolioVideo']['qtde'];

      if(!empty($this->data['PortfolioVideo']['descricao'])){
        $conditions['descricao LIKE'] = '%'.$this->data['PortfolioVideo']['descicao'].'%';
      }

      $this->paginate = array(
        'limit'=>$this->qtde[$index_qtde],
        'conditions' => array($conditions),
        'fields' => array('PortfolioVideo.*'));

      $videos = $this->paginate('PortfolioVideo');
      $this->set(compact('videos'));
    }
    
    function admin_view($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Portfolio &raquo; Vídeos &raquo; Visualizar");

      if (!$id) {
			  $this->Session->setFlash(__('Vídeo Inválido', true));
        $this->redirect(array('controller'=>'videos','action'=>'admin_index'));
		  }
      $video =  $this->PortfolioVideo->read(null, $id);
      $this->set(compact('video'));
    }
    
    function admin_add(){
      $this->layout = "admin";
      $this->set("title_for_layout","Portfolio &raquo; Vídeos &raquo; Cadastrar");

      if (!empty($this->data)) {
        $this->PortfolioVideo->create();

        if ($this->PortfolioVideo->save($this->data)) {
            $this->Session->setFlash(__('Vídeo criado com sucesso.', true));
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
      $this->set("title_for_layout","Portfolio &raquo; Vídeos &raquo; Editar");

      if (!$id && empty($this->data)) {
        $this->Session->setFlash(__('Vídeo Inválido', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if (!empty($this->data)) {
        if ($this->PortfolioVideo->save($this->data)) {
				  $this->Session->setFlash(__('O Vídeo foi salvo.', true));
          $this->redirect(array('controller'=>'portfolio_videos','action'=>'admin_index'));
			  } else {
          //$this->Session->setFlash(__('Não foi possível editar usuário.', true));
          //$this->redirect(array('controller'=>'usuarios','action'=>'admin_index'));
			  }
		  }
		  if (empty($this->data)) {
        $this->data = $this->PortfolioVideo->read(null, $id);
		  }
    }
    
    function admin_delete($id = null){
       if (!$id) {
			  $this->Session->setFlash(__('Vídeos Inválido', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if ($this->PortfolioVideo->delete($id)) {
			  $this->flash(__('Vídeo excluído', true), array('action'=>'admin_index'));
        $this->redirect(array("action" => "admin_index"));
		  }
    }
  } 
?>

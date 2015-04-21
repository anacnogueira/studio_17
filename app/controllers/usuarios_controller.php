<?php
  class UsuariosController extends AppController{
    var $name = "usuarios";
    var $helpers = array('Status');

    /* ADMIN */
   function login(){
      $this->layout = "admin";
      $this->set("title_for_layout","Login");
      $redirect = '/admin/fotos';
      if($this->Session->read('usuario'))
       $this->redirect($redirect);
      else{
        if(!empty($this->data)){
          $this->Usuario->set($this->data);
          if($this->Usuario->validates(array('fieldList' => array('username','senha')))) {
            $email    = $this->data['Usuario']['username'];
            $password = Security::hash(trim($this->data['Usuario']['senha']));
            $usuario = $this->Usuario->find('first',array(
              'conditions'=>array('email'=>$email,'password'=>$password),
              'recursive'=>0,
              'fields'=>array('Usuario.id','Usuario.nome','Usuario.email','Usuario.ativo')
            ));

            //Validar e-mail e senha
            if(!$usuario)
              $this->Session->setFlash(__('Usuário e/ou senha inválidos.',true));
            else{
              $this->Session->write('usuario',$usuario['Usuario']);
              $this->redirect($redirect);
            }
          }
        }
      }
    }
    
    function logout() {
      $redirect = '/admin/login';
      $this->Session->delete('usuario');
      $this->Session->destroy();
      $this->Session->setFlash('Sessão encerrada.');
      $this->redirect($redirect);
    }
    
    function admin_esqueci_senha(){
      $this->layout = "admin";
      $this->set("title_for_layout","Esqueci a senha");
      if($this->data){
        // Check for data validation
        $this->Usuario->set($this->data);
        if($this->Usuario->validates(array('fieldList' => array('email')))) {
          $data = $this->Usuario->find('first',
            array('conditions'=>array('email'=>$this->data['Usuario']['email']),
            'recursive'=>-1));

          if(!empty($data))  //Verificar se o e-mail esta cadastrado
            $this->redirect(array("action"=>"admin_cadastrar_nova_senha",$data["Usuario"]["id"]));
          else{
            $msg = "E-mail desconhecido.";
            $this->set("msg",$msg);
          }
        }
      }
    }
    
    function admin_alterar_dados($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Alterar dados");

      if(!$id)
        $id = $this->Session->read('usuario.id');

      if (!$id && empty($this->data)) {
        $this->Session->setFlash(__('Usuário Inválido', true));
		  }
		  if(!empty($this->data)) {
		    $this->Usuario->set($this->data);

        if($this->Usuario->validates()) {
          $user = array();
          $user['nome']            = "'".$this->data['Usuario']['nome']."'";
          $user['email']           = "'".$this->data['Usuario']['email']."'";
          $user['cpf']             = "'".$this->data['Usuario']['cpf']."'";
          $user['telefone']        = "'".$this->data['Usuario']['telefone']."'";
          $user['celular']         = "'".$this->data['Usuario']['celular']."'";

			    if ($this->Usuario->updateAll($user,array('Usuario.id'=>$id))) {
				    $this->Session->setFlash(__('Dados alterados com sucesso', true));
          }
			    else {
            $this->Session->setFlash(__('Não foi possível salvar usuário', true));
			    }
        }
		  }
		  if (empty($this->data)) {
        $this->data = $this->Usuario->read(null, $id);
        if(!empty($this->data['Usuario']['data_nascimento'])){
          $this->data['Usuario']['data_nascimento'] = parent::format_date($this->data['Usuario']['data_nascimento'],1);
        }
		  }
    }
    
    function admin_alterar_senha($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Alterar senha");
      
      if(!$id)
        $id = $this->Session->read('usuario.id');

      if (!$id && empty($this->data)) {
        $this->Session->setFlash(__('Usuário Inválido', true));
      }
		  if(!empty($this->data)) {
		    $this->Usuario->set($this->data);
        $fields = array('senhaAtual','password1','password2');

        if($this->Usuario->validates(array('fieldList' => $fields))) {
          $user = array();
          $user['password']            = "'".Security::hash($this->data['Usuario']['password1'])."'";
          if ($this->Usuario->updateAll($user,array('Usuario.id'=>$id))) {
				    $this->Session->setFlash(__('Senha alterada com sucesso', true));
          } else {
            $this->Session->setFlash(__('Não foi possível salvar usuário', true));
			    }
        }
		  }
		  if (empty($this->data)) {
        $this->data = $this->Usuario->read(null, $id);

		  }
    }
    
    function admin_index(){
      $this->layout = "admin";
      $this->set("title_for_layout","Usuários");
      $this->Usuario->recursive = 1;
      //Filtrar condições
      $conditions = array();
      if(empty($this->data))
        $index_qtde = 1;
      else
        $index_qtde  = $this->data['Usuario']['qtde'];

      if(!empty($this->data['Usuario']['nome'])){
        $conditions['nome LIKE'] = '%'.$this->data['Usuario']['nome'].'%';
      }
      if(!empty($this->data['Usuario']['ativo'])){
        $conditions['ativo'] = $this->data['Usuario']['ativo'];
      }
      $this->paginate = array(
        'limit'=>$this->qtde[$index_qtde],
        'conditions' => array($conditions),
        'fields' => array('Usuario.*'));

      $usuarios = $this->paginate('Usuario');
      $this->set(compact('usuarios'));
    }
    
    function admin_view($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Usuário &raquo; Visualizar");
      
      if (!$id) {
			  $this->Session->setFlash(__('Usuário Inválido', true));
        $this->redirect(array('controller'=>'usuarios','action'=>'admin_index'));
		  }
      $usuario =  $this->Usuario->read(null, $id);
      $usuario['Usuario']['created'] = parent::format_date($usuario['Usuario']['created'],4);
      $usuario['Usuario']['modified'] = parent::format_date($usuario['Usuario']['modified'],4);
		  $this->set(compact('usuario'));
    }
    
    function admin_add(){
      $this->layout = "admin";
      $this->set("title_for_layout","Usuário &raquo; Novo usuário");

      if (!empty($this->data)) {
        //if($this->Usuario->validates()) {
          $this->Usuario->create();
          
          if ($this->Usuario->save($this->data)) {
            $this->Session->setFlash(__('Usuário criado com sucesso.', true));
            $this->redirect(array("action" => "admin_index"));
			    } else {
            //Erro ao cadastrar usuário
            $this->Session->setFlash(__('Não foi possível cadastrar usuário. Por favor,
            contacte o administrador do site.', true));
          }
        //}
      }
    }
    
    function admin_edit($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Usuário &raquo; Editar usuário");
      
      if (!$id && empty($this->data)) {
        $this->Session->setFlash(__('Usuário Inválido', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if (!empty($this->data)) {
        if ($this->Usuario->save($this->data)) {
				  $this->Session->setFlash(__('O usuário foi salvo.', true));
          $this->redirect(array('controller'=>'usuarios','action'=>'admin_index'));
			  } else {
          $this->Session->setFlash(__('Não foi possível editar usuário.', true));
          $this->redirect(array('controller'=>'usuarios','action'=>'admin_index'));
			  }
		  }
		  if (empty($this->data)) {
        $this->data = $this->Usuario->read(null, $id);
        if(!empty($this->data['Usuario']['data_nascimento'])){
          $this->data['Usuario']['data_nascimento'] = parent::format_date($this->data['Usuario']['data_nascimento'],1);
        }
		  }
    }
    
    function admin_delete($id = null){
      if (!$id) {
			  $this->Session->setFlash(__('Usuário Invalido', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if ($this->Usuario->delete($id)) {
			  $this->flash(__('Usuário excluído', true), array('action'=>'admin_index'));
        $this->redirect(array("action" => "admin_index"));
		  }
    }
  }
?>

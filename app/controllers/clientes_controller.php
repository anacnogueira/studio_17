<?php
  uses('sanitize');
  class ClientesController extends AppController{
    var $name = "clientes";
    var $helpers = array('Status','PhotoGallery');
    var $components = array('Upload');

    /* AREA DOS CLIENTES */
     function login() {
      $this->layout = "cliente";
      $this->set("title_for_layout","Login");
      $redirect = '/clientes';
      if($this->Session->read('cliente'))
       $this->redirect($redirect);
      else{
        if(!empty($this->data)){
          $this->Cliente->set($this->data);
          if($this->Cliente->validates(array('fieldList' => array('username','senha')))) {
            $email    = $this->data['Cliente']['username'];
            $password = Security::hash(trim($this->data['Cliente']['senha']));
            $usuario = $this->Cliente->find('first',array(
              'conditions'=>array('email'=>$email,'password'=>$password),
              'recursive'=>0,
              'fields'=>array('Cliente.id','Cliente.nome','Cliente.email','Cliente.ativo')
            ));

            //Validar e-mail e senha
            if(!$usuario)
              $this->Session->setFlash(__('Usuário e/ou senha inválidos.',true));
            else{
              $this->Session->write('cliente',$usuario['Cliente']);
              $this->redirect($redirect);
            }
          }
        }
      }
     }
     function logout() {
      $redirect = '/clientes/login';
      $this->Session->delete('cliente');
      $this->Session->destroy();
      $this->Session->setFlash('Sessão encerrada.');
      $this->redirect($redirect);
     }

     function esqueci_senha() {
      $this->layout = "cliente";
      $this->set("title_for_layout","Esqueci a senha");
      if($this->data){
        // Check for data validation
        $this->Cliente->set($this->data);
        if($this->Cliente->validates(array('fieldList' => array('email')))) {

          $data = $this->Cliente->find('first',
            array('fields'=>array('email','nome','id'),
            array('conditions'=>array(
              'email'=>$this->data['Cliente']['email'],
              'ativo'=>'S'),
            'recursive'=>-1)));

          if(!empty($data)){  //Verificar se o e-mail esta cadastrado
            $id = $data['Cliente']['id'];
            $this->redirect(array('action' => 'nova_senha_cadastrada',$id));
          }
          else{
            $msg = "E-mail desconhecido.";
            $this->set("msg",$msg);
          }
        }
      }
     }

    function nova_senha_cadastrada($id = null) {
      $this->set("title_for_layout","Nova senha cadastrada");
      $this->layout = 'cliente';

      if($id){
        $password = parent::_gera_passwd();
        $this->data = $this->Cliente->find('first',
          array('conditions'=>array(
            'id'=>$id,
            'ativo'=>'S'),
          'recursive'=>-1));

        //Gerar nova senha e enviar por e-mail


        if($this->Cliente->save($this->data)){
          //Enviar por e-mail
          $body = "<h1>".$this->data['Cliente']['nome'].",</h1>";
          $body .= "<p>Segue nova senha gerada </p>";
          $body .= "<strong>".$password."</strong>";

          $this->Email->smtpOptions = Configure::read("Site.smtp_config");
          $this->Email->to       =  $this->data['Cliente']['email'];
          $this->Email->subject  = '['.Configure::read('Site.name').'] Nova senha gerada';
          $this->Email->from     = Configure::read('Site.email');
          $this->Email->template = 'default';
          $this->Email->sendAs = 'html';
          $this->Email->delivery = 'smtp';
          $this->Email->send($body);
        }
        else {
          echo "Não foi possível enviar nova senha";
          exit;
        }


      }
      else {
        $this->Session->setFlash(__('Cliente Inválido', true));
      }
	  }

     function index() {
      $this->layout = "cliente";
      $this->set("title_for_layout","Área do Cliente - Minhas Fotos");
      parent::checkClienteSession();
      $fotos = $this->Cliente->find('first',array(
       'fields'=>array('folder'),
       'conditions'=>array(
        'Cliente.ativo'=>'S',
        'Cliente.id'=>$this->Session->read('cliente.id'))));
      $this->set(compact('fotos'));
     }
      
    function download($id = null) { //Alterar isso
      parent::checkClienteSession();
      $foto = $this->Cliente->ClienteFoto->find($id);

      header('Content-type: ' . $file['MyFile']['type']);
      header('Content-length: ' . $file['MyFile']['size']); // some people reported problems with this line (see the comments), commenting out this line helped in those cases
      header('Content-Disposition: attachment; filename="'.$file['MyFile']['name'].'"');
      echo $file['MyFile']['data'];

      exit();
    }
  
    function alterar_dados($id = null) {
      $this->layout = "cliente";
      $this->set("title_for_layout","Alterar dados");
      parent::checkClienteSession();
 
      if(!$id)
        $id = $this->Session->read('cliente.id');

      if (!$id && empty($this->data)) {
        $this->Session->setFlash(__('Cliente Inválido', true));
		  }
		  if(!empty($this->data)) {
		    $this->Cliente->set($this->data);

        if($this->Cliente->validates()) {
          $cliente = array();
          $cliente['nome']            = "'".$this->data['Cliente']['nome']."'";
          $cliente['email']           = "'".$this->data['Cliente']['email']."'";
          $cliente['cpf']             = "'".$this->data['Cliente']['cpf']."'";
          $cliente['telefone']        = "'".$this->data['Cliente']['telefone']."'";
          $cliente['celular']         = "'".$this->data['Cliente']['celular']."'";

			    if ($this->Cliente->updateAll($user,array('Cliente.id'=>$id))) {
				    $this->Session->setFlash(__('Dados alterados com sucesso', true));
          }
			    else {
            $this->Session->setFlash(__('Não foi possível salvar dados', true));
			    }
        }
		  }
		  if (empty($this->data)) {
        $this->data = $this->Cliente->read(null, $id);
        if(!empty($this->data['Cliente']['data_nascimento'])){
          $this->data['Cliente']['data_nascimento'] = parent::format_date($this->data['Usuario']['data_nascimento'],1);
        }
		  }
    }

    function alterar_senha($id = null) {
      $this->layout = "cliente";
      $this->set("title_for_layout","Alterar senha");
      parent::checkClienteSession();

      if(!$id)
        $id = $this->Session->read('cliente.id');

      if (!$id && empty($this->data)) {
        $this->Session->setFlash(__('Cliente Inválido', true));
      }
		  if(!empty($this->data)) {
		    $this->Cliente->set($this->data);
        $fields = array('senhaAtual','password1','password2');

        if($this->Cliente->validates(array('fieldList' => $fields))) {
          $cliente = array();
          $user['password']            = "'".Security::hash($this->data['Cliente']['password1'])."'";
          if ($this->Cliente->updateAll($user,array('Cliente.id'=>$id))) {
				    $this->Session->setFlash(__('Senha alterada com sucesso', true));
          } else {
            $this->Session->setFlash(__('Não foi possível salvar senha', true));
			    }
        }
		  }
		  if (empty($this->data)) {
        $this->data = $this->Cliente->read(null, $id);
		  }
    }

    /* ADMIN */
    function admin_index(){
      $this->layout = "admin";
      $this->set("title_for_layout","Clientes");

      $this->Cliente->recursive = 1;
      //Filtrar condições
      $conditions = array();
      if(empty($this->data))
        $index_qtde = 1;
      else
        $index_qtde  = $this->data['Cliente']['qtde'];

      if(!empty($this->data['Cliente']['nome'])){
        $conditions['nome LIKE'] = '%'.$this->data['Cliente']['nome'].'%';
      }
      if(!empty($this->data['Cliente']['ativo'])){
        $conditions['ativo'] = $this->data['Cliente']['ativo'];
      }
      $this->paginate = array(
        'limit'=>$this->qtde[$index_qtde],
        'conditions' => array($conditions),
        'fields' => array('Cliente.*'));

      $clientes = $this->paginate('Cliente');
      $this->set(compact('clientes'));
    }

     

     function admin_add(){
      $this->layout = "admin";
      $this->set("title_for_layout","Clientes &raquo; Cadastrar");

      if (!empty($this->data)) {
        //if($this->Cliente->validates()) {
          $this->Cliente->create(true);

          if ($this->Cliente->save($this->data)) {
            $this->Session->setFlash(__('Cliente criado com sucesso.', true));
            $this->redirect(array("action" => "admin_index"));
			    } else {
            //Erro ao cadastrar usuário
            //$this->Session->setFlash(__('Não foi possível cadastrar cliente. Por favor,
           // contacte o administrador do site.', true));
          }
        //}
      }
    }

     function admin_edit($id = null){
      $this->layout = "admin";
      $this->set("title_for_layout","Clientes &raquo; Editar");

      if (!$id && empty($this->data)) {
        $this->Session->setFlash(__('Cliente Inválido', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if (!empty($this->data)) {
        $this->Cliente->create(false);

        if ($this->Cliente->save($this->data)) {
				  $this->Session->setFlash(__('O cliente foi salvo.', true));
          $this->redirect(array('controller'=>'clientes','action'=>'admin_index'));
			  } else {
          //$this->Session->setFlash(__('Não foi possível editar cliente.', true));
          //$this->redirect(array('controller'=>'clientes','action'=>'admin_index'));
			  }
		  }
		  if (empty($this->data)) {
        $this->data = $this->Cliente->read(null, $id);
        if(!empty($this->data['Cliente']['data_nascimento'])){
          $this->data['Cliente']['data_nascimento'] = parent::format_date($this->data['Cliente']['data_nascimento'],1);
        } 
		  }
    }

     function admin_delete($id = null){
      if (!$id) {
			  $this->Session->setFlash(__('Cliente Inválido', true));
        $this->redirect(array("action" => "admin_index"));
		  }
		  if ($this->Cliente->delete($id)) {
			  $this->flash(__('Cliente excluído', true), array('action'=>'admin_index'));
        $this->redirect(array("action" => "admin_index"));
		  }
    }

   

    
 }
?>

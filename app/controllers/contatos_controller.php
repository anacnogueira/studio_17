<?php
  class ContatosController extends AppController{
    var $name = "contatos";
    var $components = array('Email','Session','RequestHandler');

    function index() {
      $this->set("title_for_layout","Contato");
      if ($this->RequestHandler->isPost()) {
        $this->Contato->set($this->data);
        if ($this->Contato->validates()) {
          //envia o e-mail usando o componente de email

          $this->Email->to       = Configure::read('Site.email');
          $this->Email->subject  = '['.Configure::read('Site.name').'] Mensagem de contato de '.$this->data['Contato']['nome'];
          $this->Email->from     = Configure::read('Site.email');
          $this->Email->replyTo  = $this->data['Contato']['email'];
          $this->Email->template = 'default';
          $msg = '<h1>Novo mensagem de contato</h1>';
          $msg .= '<p>Nome...............'.$this->data['Contato']['nome'].'</p>';
          $msg .= '<p>E-mail.............'.$this->data['Contato']['email'].'</p>';
          $msg .= '<p>Telefone.............'.$this->data['Contato']['telefone'].'</p>';
          $msg .= '<p>Assunto.............'.$this->data['Contato']['assunto'].'</p>';
          $msg .= '<p>'.$this->data['Contato']['mensagem'].'</p>';
          $this->Email->sendAs = 'html';
          if($this->Email->send($msg)){
            $this->Session->setFlash('Agradecemos pela sua mensagem, Em breve entraremos em contato.');
            $this->redirect(array('action'=>'enviado'));
          } else {
            $this->Session->setFlash('Não foi possível enviar seu e-mail, por favor tente novamente.');
          }
        }
      }
      $assuntos = array(
      '0'=>"Selecione...",
      'Orçamento'=>'Pedido de orçamento',
      'Dúvida'=>'Dúvida',
      'Sugestão'=>'Sugestão');
      $this->set(compact('assuntos'));
    }

    function enviado(){}
  }
?>

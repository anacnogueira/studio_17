<?php

class PagesController extends AppController {

	var $name = 'Pages';
  var $helpers = array('Html', 'Session','Text');
  var $uses = array('Foto','Pagina','Evento');


	function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}

  function home(){

    $fotos = $this->Foto->find('all',array(
      'fields'=>array('foto','descricao'),
      'conditions'=>array('show_home'=>'S'),
      'order'=>'RAND()'));

    $sobre = $this->Pagina->find('first',array(
      'fields'=>array('titulo','permalink','conteudo'),
      'conditions'=>array('permalink'=>'STUDIO17')));

      
    $eventos = $this->Evento->Categoria->find('all',array(
     'fields'=>array('( SELECT foto FROM fotos Foto
                        INNER JOIN eventos Evento ON Evento.foto_id  = Foto.id
                        WHERE Evento.categoria_id = Categoria.id  
                        ORDER BY RAND() LIMIT 1) as categoria_foto',
                       'Categoria.name')));
   
    $this->set(compact('fotos','sobre','eventos'));
    $this->set("title_for_layout","Home");
  }
}

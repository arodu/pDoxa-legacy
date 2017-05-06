<?php
App::uses('AppController', 'Controller');

class MenuController extends AppController {

    public $name = 'Menu';
    public $uses = array();
    public $layout = 'ajaxMenu';

    public function done(){
        $this->ajaxLayout("ajax");
    }

    public function content($refrescarMenu = null){
        $this->ajaxLayout("ajaxContenido");
        $this->set('refrescarMenu',$refrescarMenu);
    }

    public function configuraciones(){
        if(!$this->request->is("ajax")){
            $this->redirect(array('action'=>'content','configuraciones'));
        }
        $this->loadModel('Area');
        $this->set('areas',$this->Area->find('all', array('recursive'=>-1)));
    }

    public function proyectos(){
        if(!$this->request->is("ajax")){
            $this->redirect(array('action'=>'content','proyectos'));
        }

        if($this->Session->read('Proyecto')){
            $this->set('seleccionado',$this->Session->read('Proyecto'));
            $this->loadModel('Materia');
            $this->set('materias',$this->Materia->find('list',array('fields'=>array('Materia.id','Materia.nombre','Materia.nivel'),'conditions'=>array('Materia.pensum_id'=>$this->Session->read('Proyecto.Pensum.id')),'order'=>array('Materia.nivel','Materia.nombre'))));
        }
    }
    
    
} // Fin de MenuController
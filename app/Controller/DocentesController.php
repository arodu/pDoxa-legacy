<?php
App::uses('AppController', 'Controller');
/**
 * Docentes Controller
 *
 * @property Docente $Docente
 */
class DocentesController extends AppController {

        private function setMigajas($area_id){
                $area = $this->Docente->Area->find('first',array('conditions'=>array('Area.id'=>$area_id),'recursive'=>-1));
                
                $migajas[] = array('id'=>$area['Area']['id'],'nombre'=>$area['Area']['nombre'],'controller'=>'areas','action'=>'view');
                
                $this->set('migajas',array_reverse($migajas));
        }


//    public $components = array('RequestHandler');
//    public $helpers = array('Js'=>array('Jquery'));
/**
 * index method
 *
 * @return void
 */
	public function index($area_id) {
                $this->ajaxLayout("ajax");
		$this->Docente->recursive = 0;
                $this->paginate = array(
                        'conditions' => array('Docente.area_id' => $area_id),
                        'limit' => 20
                    );
		$this->set('docentes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
                $this->ajaxLayout("ajaxContenido");
		$this->Docente->id = $id;
		if (!$this->Docente->exists()) {
			throw new NotFoundException(__('Invalid docente'));
		}
                $docente = $this->Docente->read(null, $id);
		$this->set('docente', $docente);
                $this->setMigajas($docente['Area']['id']);
	}

/**
 * add method
 *
 * @return void
 */
	public function add($area_id) {
                $this->ajaxLayout("ajaxContenido");
		if ($this->request->is('post')) {
			$this->Docente->create();
			if ($this->Docente->save($this->request->data)) {
				$this->Session->setFlash(__('The docente has been saved'));
				$this->redirect(array('action' => 'view',$this->Docente->id));
			} else {
				$this->Session->setFlash(__('The docente could not be saved. Please, try again.'));
			}
		}
//		$areas = $this->Docente->Area->find('list');
//		$this->set(compact('areas'));
                $this->set('area_id',$area_id);
                
                $this->setMigajas($area_id);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
                $this->ajaxLayout("ajaxContenido");
		$this->Docente->id = $id;
		if (!$this->Docente->exists()) {
			throw new NotFoundException(__('Invalid docente'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Docente->save($this->request->data)) {
				$this->Session->setFlash(__('The docente has been saved'));
				$this->redirect(array('action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The docente could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Docente->read(null, $id);
		}
		$areas = $this->Docente->Area->find('list');
		$this->set(compact('areas'));
                
                $this->setMigajas($this->request->data['Docente']['area_id']);
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
                $this->ajaxLayout("ajaxContenido");
                $docente = $this->Docente->find('first',array('conditions'=>array('Docente.id'=>$id),'recursive'=>-1));
                
                
		if (!$this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->Docente->id = $id;
		if (!$this->Docente->exists()) {
			throw new NotFoundException(__('Invalid docente'));
		}
		if ($this->Docente->delete()) {
			$this->Session->setFlash(__('Docente deleted'));
                        $this->redirect(array('controller'=>'areas','action' => 'view',$docente['Docente']['area_id']));
//			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Docente was not deleted'));
		$this->redirect(array('action' => 'view',$id));
	}
}

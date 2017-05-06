<?php
App::uses('AppController', 'Controller');
/**
 * Carreras Controller
 *
 * @property Carrera $Carrera
 */
class CarrerasController extends AppController {

    
        private function setMigajas($area_id){
                $area = $this->Carrera->Area->find('first',array('conditions'=>array('Area.id'=>$area_id),'recursive'=>-1));
                
                $migajas[] = array('id'=>$area['Area']['id'],'nombre'=>$area['Area']['nombre'],'controller'=>'areas','action'=>'view');
                
                $this->set('migajas',array_reverse($migajas));
        }

/**
 * index method
 *
 * @return void
 */
/*
	public function index() {
		$this->Carrera->recursive = 0;
		$this->set('carreras', $this->paginate());
	}
*/
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
                $this->ajaxLayout("ajaxContenido");
		$this->Carrera->id = $id;
		if (!$this->Carrera->exists()) {
			throw new NotFoundException(__('Invalid carrera'));
		}
                $carrera = $this->Carrera->read(null, $id);
		$this->set('carrera', $carrera);                
                $this->setMigajas($carrera['Area']['id']);
	}

/**
 * add method
 *
 * @return void
 */
	public function add($area_id) {
                $this->ajaxLayout("ajaxContenido");
		if ($this->request->is('post')) {
			$this->Carrera->create();
			if ($this->Carrera->save($this->request->data)) {
				$this->Session->setFlash(__('The carrera has been saved'));                                
				$this->redirect(array('action' => 'view',$this->Carrera->id));
			} else {
				$this->Session->setFlash(__('The carrera could not be saved. Please, try again.'));
			}
		}
//		$areas = $this->Carrera->Area->find('list');
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
		$this->Carrera->id = $id;
		if (!$this->Carrera->exists()) {
			throw new NotFoundException(__('Invalid carrera'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Carrera->save($this->request->data)) {
				$this->Session->setFlash(__('The carrera has been saved'));
				$this->redirect(array('action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The carrera could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Carrera->read(null, $id);
		}
		$areas = $this->Carrera->Area->find('list');
		$this->set(compact('areas'));

                $this->setMigajas($this->request->data['Carrera']['area_id']);
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
                $carrera = $this->Carrera->find('first',array('conditions'=>array('Carrera.id'=>$id),'recursive'=>-1));
//              debug($carrera);
                
		if (!$this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->Carrera->id = $id;
		if (!$this->Carrera->exists()) {
			throw new NotFoundException(__('Invalid carrera'));
		}
		if ($this->Carrera->delete()) {
			$this->Session->setFlash(__('Carrera deleted'));
                        $this->redirect(array('controller'=>'areas','action' => 'view',$carrera['Carrera']['area_id']));
//			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Carrera was not deleted'));
                $this->redirect(array('action' => 'view',$id));
	}
}






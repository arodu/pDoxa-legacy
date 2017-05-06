<?php
App::uses('AppController', 'Controller');
/**
 * Direccions Controller
 *
 * @property Direccion $Direccion
 */
class DireccionsController extends AppController {



        private function setMigajas($area_id){
                $area = $this->Direccion->Area->find('first',array('conditions'=>array('Area.id'=>$area_id),'recursive'=>-1));
                
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
		$this->Direccion->recursive = 0;
		$this->set('direccions', $this->paginate());
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
		$this->Direccion->id = $id;
		if (!$this->Direccion->exists()) {
			throw new NotFoundException(__('Invalid direccion'));
		}
                $direccion = $this->Direccion->read(null, $id);
		$this->set('direccion', $direccion);
                $this->setMigajas($direccion['Area']['id']);
	}

/**
 * add method
 *
 * @return void
 */
	public function add($area_id) {
                $this->ajaxLayout("ajaxContenido");
		if ($this->request->is('post')) {
			$this->Direccion->create();
			if ($this->Direccion->save($this->request->data)) {
				$this->Session->setFlash(__('The direccion has been saved'));
				$this->redirect(array('action' => 'view',$this->Direccion->id));
			} else {
				$this->Session->setFlash(__('The direccion could not be saved. Please, try again.'));
			}
		}
//		$areas = $this->Direccion->Area->find('list');
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
		$this->Direccion->id = $id;
		if (!$this->Direccion->exists()) {
			throw new NotFoundException(__('Invalid direccion'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Direccion->save($this->request->data)) {
				$this->Session->setFlash(__('The direccion has been saved'));
				$this->redirect(array('action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The direccion could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Direccion->read(null, $id);
		}
		$areas = $this->Direccion->Area->find('list');
		$this->set(compact('areas'));
                
                $this->setMigajas($this->request->data['Direccion']['area_id']);
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
                $direccion = $this->Direccion->find('first',array('conditions'=>array('Direccion.id'=>$id),'recursive'=>-1));
		
                
                if (!$this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->Direccion->id = $id;
		if (!$this->Direccion->exists()) {
			throw new NotFoundException(__('Invalid direccion'));
		}
		if ($this->Direccion->delete()) {
			$this->Session->setFlash(__('Direccion deleted'));
                        $this->redirect(array('controller'=>'areas','action' => 'view',$direccion['Direccion']['area_id']));
//			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Direccion was not deleted'));
		$this->redirect(array('action' => 'view',$id));
	}
}

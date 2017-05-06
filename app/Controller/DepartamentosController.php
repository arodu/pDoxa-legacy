<?php
App::uses('AppController', 'Controller');
/**
 * Departamentos Controller
 *
 * @property Departamento $Departamento
 */
class DepartamentosController extends AppController {

    
        private function setMigajas($direccion_id){
                $direccion = $this->Departamento->Direccion->find('first',array('conditions'=>array('Direccion.id'=>$direccion_id),'recursive'=>0));

                $migajas[] = array('id'=>$direccion['Direccion']['id'],'nombre'=>$direccion['Direccion']['nombre'],'controller'=>'direccions','action'=>'view');
                $migajas[] = array('id'=>$direccion['Area']['id'],'nombre'=>$direccion['Area']['nombre'],'controller'=>'areas','action'=>'view');
                
                $this->set('migajas',array_reverse($migajas));
        }
    
    
    
/**
 * index method
 *
 * @return void
 */
/*	public function index() {
		$this->Departamento->recursive = 0;
		$this->set('departamentos', $this->paginate());
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
		$this->Departamento->id = $id;
		if (!$this->Departamento->exists()) {
			throw new NotFoundException(__('Invalid departamento'));
		}

                $departamento = $this->Departamento->find('first',array('conditions'=>array('Departamento.id'=>$id),'recursive'=>0,));
                
                $departamento['Materia'] = $this->Departamento->Materia->find('all',array('conditions'=>array('Materia.departamento_id'=>$departamento['Departamento']['id']),'recursive'=>0));

                $this->set('departamento', $departamento);
                
//                debug($departamento);

                $this->setMigajas($departamento['Direccion']['id']);
	}

/**
 * add method
 *
 * @return void
 */
	public function add($direccion_id) {
                $this->ajaxLayout("ajaxContenido");
		if ($this->request->is('post')) {
			$this->Departamento->create();
			if ($this->Departamento->save($this->request->data)) {
				$this->Session->setFlash(__('The departamento has been saved'));
				$this->redirect(array('action' => 'view',$this->Departamento->id));
			} else {
				$this->Session->setFlash(__('The departamento could not be saved. Please, try again.'));
			}
		}
		$this->set('direccion_id',$direccion_id);
                
                $this->setMigajas($direccion_id);
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
		$this->Departamento->id = $id;
		if (!$this->Departamento->exists()) {
			throw new NotFoundException(__('Invalid departamento'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Departamento->save($this->request->data)) {
				$this->Session->setFlash(__('The departamento has been saved'));
				$this->redirect(array('action' => 'view',$id));
//                                $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The departamento could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Departamento->read(null, $id);
                        
		}
                
		$direccions = $this->Departamento->Direccion->find('list');
		$this->set(compact('direccions'));
                
                $this->setMigajas($this->request->data['Departamento']['direccion_id']);
                
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
            
                
		if (!$this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->Departamento->id = $id;
		if (!$this->Departamento->exists()) {
			throw new NotFoundException(__('Invalid departamento'));
		}
                $departamento = $this->Departamento->find('first',array('conditions'=>array('Departamento.id'=>$id),'recursive'=>-1));
		if ($this->Departamento->delete()) {
			$this->Session->setFlash(__('Departamento deleted'));
//			$this->redirect(array('action' => 'index'));
                        $this->redirect(array('controller'=>'direccions','action' => 'view',$departamento['Departamento']['direccion_id']));
		}
		$this->Session->setFlash(__('Departamento was not deleted'));
		$this->redirect(array('action' => 'view',$id));
	}
}

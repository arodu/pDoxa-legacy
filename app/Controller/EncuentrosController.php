<?php
App::uses('AppController', 'Controller');
/**
 * Encuentros Controller
 *
 * @property Encuentro $Encuentro
 */
class EncuentrosController extends AppController {

    
    
        private function setMigajas($materia_id){
                $materia = $this->Encuentro->Materia->find('first',array('conditions'=>array('Materia.id'=>$materia_id),'recursive'=>0));                
                
//                $pensum = $this->Materia->Pensum->find('first',array('conditions'=>array('Pensum.id'=>$pensum_id),'recursive'=>0));
                $carrera = $this->Encuentro->Materia->Pensum->Carrera->find('first',array('conditions'=>array('Carrera.id'=>$materia['Pensum']['carrera_id']),'recursive'=>0));

                $migajas[] = array('id'=>$materia['Materia']['id'],'nombre'=>$materia['Materia']['nombre'],'controller'=>'materias','action'=>'view');
                $migajas[] = array('id'=>$materia['Pensum']['id'],'nombre'=>$materia['Pensum']['nombre'],'controller'=>'pensums','action'=>'view');
                $migajas[] = array('id'=>$carrera['Carrera']['id'],'nombre'=>$carrera['Carrera']['nombre'],'controller'=>'carreras','action'=>'view');
                $migajas[] = array('id'=>$carrera['Area']['id'],'nombre'=>$carrera['Area']['nombre'],'controller'=>'areas','action'=>'view');
                
                $this->set('migajas',array_reverse($migajas));
        }
    
    
/**
 * index method
 *
 * @return void
 */
/*	public function index() {
		$this->Encuentro->recursive = 0;
		$this->set('encuentros', $this->paginate());
	}
*/
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*
	public function view($id = null) {
		$this->Encuentro->id = $id;
		if (!$this->Encuentro->exists()) {
			throw new NotFoundException(__('Invalid encuentro'));
		}
		$this->set('encuentro', $this->Encuentro->read(null, $id));
	}
*/
/**
 * add method
 *
 * @return void
 */
	public function add($materia_id) {
                $this->ajaxLayout("ajaxContenido");
                
                
		if ($this->request->is('post')) {
			$this->Encuentro->create();
			if ($this->Encuentro->save($this->request->data)) {
				$this->Session->setFlash(__('The encuentro has been saved'));
                                $this->redirect(array('controller'=>'materias','action' => 'view',$materia_id));
			} else {
				$this->Session->setFlash(__('The encuentro could not be saved. Please, try again.'));
			}
		}
		$materias = $this->Encuentro->Materia->find('list');
		$tipoAulas = $this->Encuentro->TipoAula->find('list');
		$this->set(compact('materias', 'tipoAulas'));
                
                $this->set('materia_id',$materia_id);
                
                $this->setMigajas($materia_id);
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
            
		$this->Encuentro->id = $id;
		if (!$this->Encuentro->exists()) {
			throw new NotFoundException(__('Invalid encuentro'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Encuentro->save($this->request->data)) {
				$this->Session->setFlash(__('The encuentro has been saved'));
                                $encuentro = $this->Encuentro->find('first',array('conditions'=>array('Encuentro.id'=>$id),'recursive'=>-1));
                                $this->redirect(array('controller'=>'materias','action' => 'view',$encuentro['Encuentro']['materia_id']));
//				$this->redirect(array('action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The encuentro could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Encuentro->read(null, $id);
		}
		$materias = $this->Encuentro->Materia->find('list');
		$tipoAulas = $this->Encuentro->TipoAula->find('list');
		$this->set(compact('materias', 'tipoAulas'));
                
                $this->setMigajas($this->request->data['Encuentro']['materia_id']);
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
		$this->Encuentro->id = $id;
		if (!$this->Encuentro->exists()) {
			throw new NotFoundException(__('Encuentro Invalido'));
		}
                $encuentro = $this->Encuentro->find('first',array('conditions'=>array('Encuentro.id'=>$id),'recursive'=>-1));
                
		if ($this->Encuentro->delete()) {
                    $this->Session->setFlash(__('Encuentro eliminado Correctamente'));
		}else{
                    $this->Session->setFlash(__('Encuentro no ha podido ser Eliminado'));
                }
                $this->redirect(array('controller'=>'materias','action' => 'view',$encuentro['Encuentro']['materia_id']));
	}
        
        
}

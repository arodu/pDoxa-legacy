<?php
App::uses('AppController', 'Controller');
/**
 * Materias Controller
 *
 * @property Materia $Materia
 */
class MateriasController extends AppController {

        private function setMigajas($pensum_id){
                $pensum = $this->Materia->Pensum->find('first',array('conditions'=>array('Pensum.id'=>$pensum_id),'recursive'=>0));
                $area = $this->Materia->Pensum->Carrera->Area->find('first',array('conditions'=>array('Area.id'=>$pensum['Carrera']['area_id']),'recursive'=>-1));

                $migajas[] = array('id'=>$pensum['Pensum']['id'],'nombre'=>$pensum['Pensum']['nombre'],'controller'=>'pensums','action'=>'view');
                $migajas[] = array('id'=>$pensum['Carrera']['id'],'nombre'=>$pensum['Carrera']['nombre'],'controller'=>'carreras','action'=>'view');
                $migajas[] = array('id'=>$area['Area']['id'],'nombre'=>$area['Area']['nombre'],'controller'=>'areas','action'=>'view');

                $this->set('migajas',array_reverse($migajas));
        }
/**
 * index method
 *
 * @return void
 */

	public function index($pensum_id) {
                $this->ajaxLayout("ajax");
		$this->Materia->recursive = 0;
                $this->paginate = array(
                        'conditions' => array('Materia.pensum_id' => $pensum_id),
                        'limit' => 10
                    );
		$this->set('materias', $this->paginate());
                $this->set('departamento',true);
	}

	public function index2($departamento_id) {
                $this->ajaxLayout("ajax");
		$this->Materia->recursive = 0;
                $this->paginate = array(
                        'conditions' => array('Materia.departamento_id' => $departamento_id),
                        'limit' => 10
                    );
		$this->set('materias', $this->paginate());
                $this->set('pensum',true);
                $this->render('index');
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
		$this->Materia->id = $id;
		if (!$this->Materia->exists()) {
			throw new NotFoundException(__('Invalid materia'));
		}
                
                $materia = $this->Materia->read(null, $id);
		$this->set('materia', $materia);
                
                $encuentros = $this->Materia->Encuentro->find('all',array('conditions'=>array('Encuentro.materia_id'=>$id)));
		$this->set('encuentros', $encuentros);

//                $carrera = $this->Materia->Pensum->Carrera->find('first',array('conditions'=>array('Carrera.id'=>$materia['Pensum']['carrera_id']),'recursive'=>0));
//                $this->set('carrera', $carrera);
                
/*                if($materia['Departamento']['id'] != null){
                    $direccion = $this->Materia->Departamento->Direccion->find('first',array('conditions'=>array('Direccion.id'=>$materia['Departamento']['direccion_id']),'recursive'=>0));
                    $this->set('direccion', $direccion);
//                    $area = $this->Materia->Departamento->Direccion->Area->find('first',array('conditions'=>array('Area.id'=>$direccion['Direccion']['area_id']),'recursive'=>-1));
//                    $this->set('direccion', $area);
                }
  */              
                $this->setMigajas($materia['Materia']['pensum_id']);
                
	}

/**
 * add method
 *
 * @return void
 */
	public function add($pensum_id) {
                $this->ajaxLayout("ajaxContenido");
		if ($this->request->is('post')) {
			$this->Materia->create();
			if ($this->Materia->save($this->request->data)) {
				$this->Session->setFlash(__('The materia has been saved'));
				$this->redirect(array('action' => 'view',$this->Materia->id));
			} else {
				$this->Session->setFlash(__('The materia could not be saved. Please, try again.'));
			}
		}

		$departamentos = $this->Materia->Departamento->find('list', array('conditions'=>array('Direccion.area_id'=>$this->buscarAreaId($pensum_id)),'fields'=>array('Departamento.id','Departamento.nombre','Direccion.nombre'),'recursive'=>0));
		$this->set('departamentos',$departamentos);

                $this->set('pensum_id',$pensum_id);

                $this->setMigajas($pensum_id);
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
		$this->Materia->id = $id;
		if (!$this->Materia->exists()) {
			throw new NotFoundException(__('Invalid materia'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Materia->save($this->request->data)) {
				$this->Session->setFlash(__('The materia has been saved'));
				$this->redirect(array('action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The materia could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Materia->read(null, $id);
		}
//		$pensums = $this->Materia->Pensum->find('list');
//		$departamentos = $this->Materia->Departamento->find('list');
//		$this->set(compact('pensums', 'departamentos'));

                $this->setMigajas($this->request->data['Materia']['pensum_id']);

		$departamentos = $this->Materia->Departamento->find('list', array('conditions'=>array('Direccion.area_id'=>$this->buscarAreaId($this->request->data['Materia']['pensum_id'])),'fields'=>array('Departamento.id','Departamento.nombre','Direccion.nombre'),'recursive'=>0));
                $this->set('departamentos',$departamentos);
	}

        
        private function buscarAreaId($pensum_id){
                $pensum = $this->Materia->Pensum->find('first',array('conditions'=>array('Pensum.id'=>$pensum_id),'recursive'=>0));
                $area = $this->Materia->Pensum->Carrera->Area->find('first',array('conditions'=>array('Area.id'=>$pensum['Carrera']['area_id']),'recursive'=>-1));
                return $area['Area']['id'];
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
		$this->Materia->id = $id;
		if (!$this->Materia->exists()) {
			throw new NotFoundException(__('Invalid materia'));
		}
                
                $materia = $this->Materia->find('first',array('conditions'=>array('Materia.id'=>$id),'recursive'=>-1));
		if ($this->Materia->delete()) {
			$this->Session->setFlash(__('Materia deleted'));
			$this->redirect(array('controller'=>'pensums','action' => 'view',$materia['Materia']['pensum_id']));
		}
		$this->Session->setFlash(__('Materia was not deleted'));
		$this->redirect(array('action' => 'view',$id));
	}
}

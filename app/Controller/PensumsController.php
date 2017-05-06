<?php
App::uses('AppController', 'Controller');
/**
 * Pensums Controller
 *
 * @property Pensum $Pensum
 */
class PensumsController extends AppController {

    
    
    
        private function setMigajas($carrera_id){
                $carrera = $this->Pensum->Carrera->find('first',array('conditions'=>array('Carrera.id'=>$carrera_id),'recursive'=>0));

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
		$this->Pensum->recursive = 0;
		$this->set('pensums', $this->paginate());
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
		$this->Pensum->id = $id;
		if (!$this->Pensum->exists()) {
			throw new NotFoundException(__('Invalid pensum'));
		}

                $pensum = $this->Pensum->read(null, $id);
		$this->set('pensum', $pensum);

                $this->setMigajas($pensum['Carrera']['id']);
	}

/**
 * add method
 *
 * @return void
 */
    public function add($carrera_id){
        $this->ajaxLayout("ajaxContenido");
        if ($this->request->is('post')) {
            $this->Pensum->create();
            if ($this->Pensum->save($this->request->data)) {
                $this->Session->setFlash(__('The pensum has been saved'));
                $this->redirect(array('action' => 'view',$this->Pensum->id));
            } else {
                $this->Session->setFlash(__('The pensum could not be saved. Please, try again.'));
            }
        }
        $this->set('carrera_id',$carrera_id);
        $this->setMigajas($carrera_id);
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
		$this->Pensum->id = $id;

		if (!$this->Pensum->exists()) {
			throw new NotFoundException(__('Invalid pensum'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Pensum->save($this->request->data)) {
				$this->Session->setFlash(__('The pensum has been saved'));
                                $this->redirect(array('action' => 'view',$id));
//				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pensum could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Pensum->read(null, $id);
//                        debug($this->request->data);
		}

		$carreras = $this->Pensum->Carrera->find('list');
		$this->set('carreras',$carreras);
                
                $this->setMigajas($this->request->data['Pensum']['carrera_id']);
                
	}

        
    public function copiar($id){
        $this->ajaxLayout("ajaxContenido");

        $pensum = $this->Pensum->find('first',array('conditions'=>array('Pensum.id'=>$id),'recursive'=>-1));
        $materias = $this->Pensum->Materia->find('all',array('conditions'=>array('Materia.pensum_id'=>$id),));

        $pensum_copia = $pensum;
        unset($pensum_copia['Pensum']['id']);
        $pensum_copia['Pensum']['nombre'] = $pensum_copia['Pensum']['nombre']."_(copia)";
        
        $ok = true;

        $this->Pensum->create();
        if ($this->Pensum->save($pensum_copia)) {

            $nuevo_pensum_id = $this->Pensum->id;
            foreach($materias as $materia){
                
                $materia_copia = $materia['Materia'];
                unset($materia_copia['id']);
                $materia_copia['pensum_id'] = $nuevo_pensum_id;
                
                $this->Pensum->Materia->create();
                
                if ($this->Pensum->Materia->save($materia_copia)) {
                    $nuevo_materia_id = $this->Pensum->Materia->id;
                    foreach($materia['Encuentro'] as $encuentro){
                        $encuentro_copia = $encuentro;
                        unset($encuentro_copia['id']);
                        $encuentro_copia['materia_id'] = $nuevo_materia_id;
                        $this->Pensum->Materia->Encuentro->create();
                        if($this->Pensum->Materia->Encuentro->save($encuentro_copia)){
                            
                        }else{
                            $ok = false;
                        }
                    }
                }else{
                    $ok = false;
                }
            }
        }else{
            $ok = false;
        }

        $this->redirect(array('action' => 'view',$nuevo_pensum_id));

        //$this->set('data',$materias);
        
        
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
//              debug($carrera);
                
		if (!$this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->Pensum->id = $id;
		if (!$this->Pensum->exists()) {
			throw new NotFoundException(__('Invalid pensum'));
		}
                $pensum = $this->Pensum->find('first',array('conditions'=>array('Pensum.id'=>$id),'recursive'=>-1));
		if ($this->Pensum->delete()) {
			$this->Session->setFlash(__('Pensum deleted'));
//			$this->redirect(array('action' => 'index'));
                        $this->redirect(array('controller'=>'carreras','action' => 'view',$pensum['Pensum']['carrera_id']));
		}
		$this->Session->setFlash(__('Pensum was not deleted'));
		$this->redirect(array('action' => 'view',$id));
	}
}

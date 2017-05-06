<?php
App::uses('AppController', 'Controller');
/**
 * Dias Controller
 *
 * @property Dia $Dia
 */
class DiasController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index($esquemaDia_id) {
      $this->layout = 'ajax';
      $this->set('esquemaDia_id',$esquemaDia_id);
		$this->set('dias', $this->Dia->find('all',array('conditions'=>array('esquema_dia_id'=>$esquemaDia_id),'recursive'=>-1)));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
      // NO LO USO
		$this->Dia->id = $id;
		if (!$this->Dia->exists()) {
			throw new NotFoundException(__('Invalid dia'));
		}
		$this->set('dia', $this->Dia->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($esquemaDia_id = null) {
      $this->layout = 'ajax';
		if ($this->request->is('post')) {
			$this->Dia->create();
			if ($this->Dia->save($this->request->data)) {
//				$this->Session->setFlash(__('The dia has been saved'));
//				$this->redirect(array('action' => 'index'));
            $this->set('ok','ok');
			} else {
//				$this->Session->setFlash(__('The dia could not be saved. Please, try again.'));
			}
		}
		$esquemaDia = $esquemaDia_id;
		$this->set(compact('esquemaDia'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
      $this->layout = 'ajax';
		$this->Dia->id = $id;
		if (!$this->Dia->exists()) {
			throw new NotFoundException(__('Invalid dia'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Dia->save($this->request->data)) {
            $this->set('ok','ok');
//				$this->Session->setFlash(__('The dia has been saved'));
//				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dia could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Dia->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null, $esquemaDia_id = null) {
      
		if (!$this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->Dia->id = $id;
		if (!$this->Dia->exists()) {
			throw new NotFoundException(__('Día Invalido'));
		}
		if ($this->Dia->delete()) {
			$this->Session->setFlash(__('Día Eliminado'));
			$this->redirect(array('controller'=>'EsquemaDias','action' => 'view', $esquemaDia_id));
		}
		$this->Session->setFlash(__('Dia was not deleted'));
      $this->redirect(array('controller'=>'EsquemaDias','action' => 'view', $esquemaDia_id));
	}
}

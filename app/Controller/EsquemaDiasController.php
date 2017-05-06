<?php
App::uses('AppController', 'Controller');
/**
 * EsquemaDias Controller
 *
 * @property EsquemaDia $EsquemaDia
 */
class EsquemaDiasController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
      $this->layout = 'ajaxContenido';
		$this->set('esquemaDias', $this->EsquemaDia->find('all',array('recursive'=>-1)));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
      $this->layout = 'ajaxContenido';
		$this->EsquemaDia->id = $id;
		if (!$this->EsquemaDia->exists()) {
			throw new NotFoundException(__('Invalid esquema dia'));
		}
		$this->set('esquemaDia', $this->EsquemaDia->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
      $this->layout = 'ajaxContenido';
		if ($this->request->is('post')) {
			$this->EsquemaDia->create();
			if ($this->EsquemaDia->save($this->request->data)) {
				$this->Session->setFlash(__('The esquema dia has been saved'));
				$this->redirect(array('action' => 'view',$this->EsquemaDia->id));
			} else {
				$this->Session->setFlash(__('The esquema dia could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
      $this->layout = 'ajaxContenido';
		$this->EsquemaDia->id = $id;
		if (!$this->EsquemaDia->exists()) {
			throw new NotFoundException(__('Invalid esquema dia'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->EsquemaDia->save($this->request->data)) {
				$this->Session->setFlash(__('The esquema dia has been saved'));
				$this->redirect(array('action' => 'view',$this->EsquemaDia->id));
			} else {
				$this->Session->setFlash(__('The esquema dia could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->EsquemaDia->read(null, $id);
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
	public function delete($id = null) {
      $this->layout = 'ajaxContenido';
		if (!$this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->EsquemaDia->id = $id;
		if (!$this->EsquemaDia->exists()) {
			throw new NotFoundException(__('Esquema dia invalido'));
		}
		if ($this->EsquemaDia->delete()){
			$this->Session->setFlash(__('Esquema dia eliminado'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Esquema dia no ha podido ser deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

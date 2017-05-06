<?php
App::uses('AppController', 'Controller');
/**
 * EsquemaHoras Controller
 *
 * @property EsquemaHora $EsquemaHora
 */
class EsquemaHorasController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->layout = 'ajaxContenido';
		$this->set('esquemaHoras', $this->EsquemaHora->find('all',array('recursive'=>-1)));
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
		$this->EsquemaHora->id = $id;
		if (!$this->EsquemaHora->exists()) {
			throw new NotFoundException(__('Invalid esquema hora'));
		}
		$this->set('esquemaHora', $this->EsquemaHora->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
      $this->layout = 'ajaxContenido';
		if ($this->request->is('post')) {
			$this->EsquemaHora->create();
			if ($this->EsquemaHora->save($this->request->data)) {
				$this->Session->setFlash(__('The esquema hora has been saved'));
				$this->redirect(array('action' => 'view',$this->EsquemaHora->id));
			} else {
				$this->Session->setFlash(__('The esquema hora could not be saved. Please, try again.'));
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
		$this->EsquemaHora->id = $id;
		if (!$this->EsquemaHora->exists()) {
			throw new NotFoundException(__('Invalid esquema hora'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->EsquemaHora->save($this->request->data)) {
				$this->Session->setFlash(__('The esquema hora has been saved'));
				$this->redirect(array('action' => 'view',$this->EsquemaHora->id));
			} else {
				$this->Session->setFlash(__('The esquema hora could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->EsquemaHora->read(null, $id);
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
		$this->EsquemaHora->id = $id;
		if (!$this->EsquemaHora->exists()) {
			throw new NotFoundException(__('Invalid esquema hora'));
		}
		if ($this->EsquemaHora->delete()) {
			$this->Session->setFlash(__('Esquema hora deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Esquema hora was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

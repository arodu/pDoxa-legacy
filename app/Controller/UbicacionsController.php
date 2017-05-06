<?php
App::uses('AppController', 'Controller');
/**
 * Ubicacions Controller
 *
 * @property Ubicacion $Ubicacion
 */
class UbicacionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
                $this->ajaxLayout("ajaxContenido");
		$this->Ubicacion->recursive = 0;
		$this->set('ubicacions', $this->paginate());
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
		$this->Ubicacion->id = $id;
		if (!$this->Ubicacion->exists()) {
			throw new NotFoundException(__('Invalid ubicacion'));
		}
		$this->set('ubicacion', $this->Ubicacion->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $this->ajaxLayout("ajaxContenido");
		if ($this->request->is('post')) {
			$this->Ubicacion->create();
			if ($this->Ubicacion->save($this->request->data)) {
				$this->Session->setFlash(__('The ubicacion has been saved'));
				$this->redirect(array('action' => 'view',$this->Ubicacion->id));
			} else {
				$this->Session->setFlash(__('The ubicacion could not be saved. Please, try again.'));
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
                $this->ajaxLayout("ajaxContenido");
		$this->Ubicacion->id = $id;
		if (!$this->Ubicacion->exists()) {
			throw new NotFoundException(__('Invalid ubicacion'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Ubicacion->save($this->request->data)) {
				$this->Session->setFlash(__('The ubicacion has been saved'));
				$this->redirect(array('action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The ubicacion could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Ubicacion->read(null, $id);
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
                $this->ajaxLayout("ajaxContenido");
		if (!$this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->Ubicacion->id = $id;
		if (!$this->Ubicacion->exists()) {
			throw new NotFoundException(__('Invalid ubicacion'));
		}
		if ($this->Ubicacion->delete()) {
			$this->Session->setFlash(__('Ubicacion deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ubicacion was not deleted'));
		$this->redirect(array('action' => 'view',$id));
	}
}

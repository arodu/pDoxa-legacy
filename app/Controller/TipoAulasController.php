<?php
App::uses('AppController', 'Controller');
/**
 * TipoAulas Controller
 *
 * @property TipoAula $TipoAula
 */
class TipoAulasController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
                $this->ajaxLayout("ajaxContenido");
		$this->TipoAula->recursive = 0;
		$this->set('tipoAulas', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*	public function view($id = null) {
                $this->ajaxLayout("ajaxContenido");
		$this->TipoAula->id = $id;
		if (!$this->TipoAula->exists()) {
			throw new NotFoundException(__('Invalid tipo aula'));
		}
		$this->set('tipoAula', $this->TipoAula->read(null, $id));
	}
*/
/**
 * add method
 *
 * @return void
 */
	public function add() {
                $this->ajaxLayout("ajaxContenido");
		if ($this->request->is('post')) {
			$this->TipoAula->create();
			if ($this->TipoAula->save($this->request->data)) {
				$this->Session->setFlash(__('The tipo aula has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo aula could not be saved. Please, try again.'));
			}
		}
                
                $modalidad = Configure::read('Modalidad');
                for($i=1; $i<=4; $i++){
                    $modalidades[$modalidad[$i]['valor']] = $modalidad[$i]['nombre'];
                }
                $this->set('modalidades',$modalidades);
                
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
		$this->TipoAula->id = $id;
		if (!$this->TipoAula->exists()) {
			throw new NotFoundException(__('Invalid tipo aula'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TipoAula->save($this->request->data)) {
				$this->Session->setFlash(__('The tipo aula has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo aula could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->TipoAula->read(null, $id);
		}
                
                $modalidad = Configure::read('Modalidad');
                for($i=1; $i<=4; $i++){
                    $modalidades[$modalidad[$i]['valor']] = $modalidad[$i]['nombre'];
                }
                $this->set('modalidades',$modalidades);
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
		$this->TipoAula->id = $id;
		if (!$this->TipoAula->exists()) {
			throw new NotFoundException(__('Invalid tipo aula'));
		}
		if ($this->TipoAula->delete()) {
			$this->Session->setFlash(__('Tipo aula deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tipo aula was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

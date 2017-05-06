<?php
App::uses('AppController', 'Controller');
/**
 * Areas Controller
 *
 * @property Area $Area
 */
class AreasController extends AppController {
    
/**
 * index method
 *
 * @return void
 */
/*	public function index() {
		$this->Area->recursive = 0;
		$this->set('areas', $this->paginate());
	}
*/
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */     
	public function view($id = null, $tabActivo=null){
                $this->ajaxLayout("ajaxContenido");
		$this->Area->id = $id;
		if (!$this->Area->exists()) {
			throw new NotFoundException(__('Invalid area'));
                }
                
                
		$this->set('area', $this->Area->read(null, $id));
                $this->set('tabActivo', $tabActivo);
	}

/**
 * add method
 *
 * @return void
 */        
	public function add() {
                $this->ajaxLayout("ajaxContenido");
                //$this->layout = 'ajaxContenido';

		if ($this->request->is('post')) {
                    //debug($this->request->data);

                      $this->Area->create();
			if ($this->Area->save($this->request->data)) {
				$this->Session->setFlash(__('The area has been saved'));
                                $this->redirect(array('action' => 'view',$this->Area->id));

			} else {
				$this->Session->setFlash(__('The area could not be saved. Please, try again.'));
			}
		}

		// $users = $this->Area->User->find('list');
                // $this->set(compact('users'));
                $this->set('user_id',$this->Auth->user('id'));
                
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
//                $this->layout = 'ajaxContenido';
                
		$this->Area->id = $id;
		if (!$this->Area->exists()) {
			throw new NotFoundException(__('Invalid area'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Area->save($this->request->data)) {
				$this->Session->setFlash(__('The area has been saved'));
				$this->redirect(array('action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The area could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Area->read(null, $id);
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
//                $this->layout = 'ajaxContenido';
                
		if (!$this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->Area->id = $id;
		if (!$this->Area->exists()) {
			throw new NotFoundException(__('Area Invalida'));
		}
		if ($this->Area->delete()) {
			$this->Session->setFlash(__('Area Eliminada'));
			$this->redirect(array('controller'=>'menu','action' => 'contenidoVacio','academicos'));
//			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Area was not deleted'));
		$this->redirect(array('action' => 'view',$id));
	}
        
}

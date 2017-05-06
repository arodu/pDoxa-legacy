<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

        //public function beforeFilter() {
          //  parent::beforeFilter();
          //  $this->Auth->allow('add', 'logout');
        //}
    
    public function denegado(){
        $this->ajaxLayout("ajaxContenido");
    }

    
/**
 * index method
 *
 * @return void
 */
	public function index() {
            $this->ajaxLayout("ajaxContenido");
            if($this->Auth->user('role') != 'admin'){
                throw new ForbiddenException('403: Acceso Denegado');
            }
            
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
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
            if(!$this->usuarioAdmin())
                $id = $this->Auth->user('id');
            
            $this->User->id = $id;

            if (!$this->User->exists()) {
                    throw new NotFoundException(__('Invalid user'));
            }
            $this->set('user', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->ajaxLayout("ajaxContenido");

        	if(!$this->usuarioAdmin())
        	    throw new ForbiddenException('403: Acceso Denegado');

			//debug($this->request);

            if ($this->request->is('post')) {
                    $this->User->create();
                    if ($this->User->save($this->request->data)) {
                            $this->Session->setFlash(__('The user has been saved'));
                            $this->redirect(array('action' => 'view',$this->User->id));
                    } else {
                            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
            if(!$this->usuarioAdmin()){ $id = $this->Auth->user('id'); }

            $this->User->id = $id;            
            if (!$this->User->exists()) {
                throw new NotFoundException(__('Invalid user'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been saved'));
                    $this->redirect(array('action' => 'view',$id));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again'));
                }
            } else {
                $this->request->data = $this->User->read(null, $id);
                unset($this->request->data['User']['password']);
            }
        }


    public function editPassword($id = null) {

        $this->ajaxLayout("ajaxContenido");

        if(!$this->usuarioAdmin()){ $id = $this->Auth->user('id'); }

        $this->User->id = $id;
        
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $password['new'] = AuthComponent::password($this->request->data['User']['password_new']);
            $password['confirm'] = AuthComponent::password($this->request->data['User']['password_confirm']);
            $password['old'] = AuthComponent::password($this->request->data['User']['password_old']);

            $result = $this->User->find('first',array('conditions'=>array('User.id'=>$this->Auth->user('id'))));
            $password['sistema'] = $result['User']['password'];

            if($password['old'] != $password['sistema']){
                $this->Session->setFlash(__('Contraseña Incorrecta'));
            }elseif($password['new'] != $password['confirm']){
                $this->Session->setFlash(__('Contraseña y Confirmación de Contraseña no son Iguales.'));
            }else{
                $this->request->data['User']['password'] = $this->request->data['User']['password_new'];

                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('Password has been saved'));
                    $this->redirect(array('action' => 'view',$id));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again'));
                }
                
            }
        }

        $this->request->data = $this->User->read(null, $id);
        unset($this->request->data['User']['password']);
        unset($this->request->data['User']['password_new']);
        unset($this->request->data['User']['password_confirm']);
        unset($this->request->data['User']['password_old']);

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
            if(!$this->usuarioAdmin())
                throw new ForbiddenException('403: Acceso Denegado');
            
		if (!$this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}

		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        

        public function login() {
            if ($this->Auth->loggedIn()) {
                $this->redirect($this->Auth->redirect());
            }
            if ($this->request->is('post')) {
                if ($this->Auth->login()) {
                    $this->Session->write('Proyecto',null); // Eliminar valores
//                    $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
                    $this->redirect($this->Auth->redirect());
                } else {
                    $this->Session->setFlash(__('Nombre de Usuario y/o contraseña no valido<br/>Por favor intentelo de nuevo.'),'default', array('title' => 'example_class'));
                }
            }
        }
        
        public function logout() {
            $this->Session->destroy();
            $this->redirect($this->Auth->logout());
        }
        
}

<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'loginAction' => array('controller' => 'users','action' => 'login'),
            'authError' => 'Es necesario iniciar sesi&oacute;n para poder acceder a esta opci&oacute;n.'
        )
    );


    //public function beforeFilter() {
        //$this->Auth->allow('index', 'view','add');
    //}
    
    public function beforeRender() {
//        parent::afterFilter();
        $usuario['loggedIn'] = $this->Auth->loggedIn();
        $usuario['isAdmin'] = $this->usuarioAdmin();
        $usuario['datos'] = $this->Auth->user();

        $this->set('usuario',$usuario);
    }
    
    public function usuarioAdmin(){
        return $this->Auth->user('role') == 'admin';
    }

    public function ajaxLayout($isAjax = "ajaxContenido", $isNotAjax = null){
        if($this->request->is("ajax")){
            if(!$this->Auth->loggedIn()){
                $this->Session->setFlash(__('Sesion no iniciada'));
                throw new ForbiddenException('Sesion no iniciada');
            }
            $this->layout = $isAjax;
        }else{
            if($isNotAjax != null){
                $this->layout = $isNotAjax;
            }elseif($isNotAjax == null && $isAjax == "ajaxContenido"){
                $this->layout = "default";
            }else{
                throw new NotFoundException('Pagina no encontrada');
            //$this->redirect('/');
            }
        }
//        $this->layout = ($this->request->is("ajax")) ? "ajaxContenido" : "default";
    }
    
    
    public function limpiarData($modelo, $campo, $valor_antes, $valor = 0){

        $this->Ticket->updateAll(
            array('Ticket.status' => 'closed'),
            array('Ticket.customer_id' => 453)
        );
        
    }


}

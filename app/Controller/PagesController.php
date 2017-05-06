<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
            
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
                $this->set('navegador',$this->obtenerNavegador($_SERVER['HTTP_USER_AGENT']));

		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}

        private function obtenerNavegador($user_agent) {
            $navegadores = array(
                    'Opera' => 'Opera',
                    'Mozilla Firefox'=> '(Firebird)|(Firefox)',
                    'Google Chrome'=>'(Chrome)',
                    'Galeon' => 'Galeon',
                    'Mozilla'=>'Gecko',
                    'MyIE'=>'MyIE',
                    'Lynx' => 'Lynx',
                    'Chrome'=>'Chrome',
                    'Netscape' => '(CHROME/23\.0\.1271\.97)|(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
                    'Konqueror'=>'Konqueror',
                    'Internet Explorer 7' => '(MSIE 7\.[0-9]+)',
                    'Internet Explorer 6' => '(MSIE 6\.[0-9]+)',
                    'Internet Explorer 5' => '(MSIE 5\.[0-9]+)',
                    'Internet Explorer 4' => '(MSIE 4\.[0-9]+)',
            );
            foreach($navegadores as $navegador=>$pattern){
                if (preg_match('/'.$pattern.'/', $user_agent))
                return $navegador;
            }
            return 'Desconocido';
        }
        
        
        public function temas(){
            
            if ($this->request->is('post')) {
                $this->request->data;
            }
            
            $this->redirect(array('action'=>'display'));
            
        }
}

<?php
App::uses('AppController', 'Controller');
/**
 * Contenidos Controller
 *
 * @property AyudaContenido $AyudaContenido
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ContenidosController extends AyudaAppController {

/**
 * Components
 *
 * @var array
 */
	public $uses = array('Ayuda.AyudaContenido');
	//public $uses = array('AyudaContenido');
	public $components = array('Paginator', 'Session');
	public $project_name = "Sistema de Ayuda";
	public $editMode = false;

	public function beforeRender(){
		parent::beforeRender();
		$this->set('editMode',$this->editMode);
		$this->set('project_name',$this->project_name);
		$this->set('index','Indice');
	}

	public function beforeFilter(){
		parent::beforeFilter();
		$actionsBlock = array('add','edit','indexEdit','delete','test','move');
		if(!$this->editMode && in_array($this->action,$actionsBlock)){
			$this->Session->setFlash(__('Contenido Bloqueado'));
			return $this->redirect(array('action' => 'index'));
		}
	}

/**
 * index method
 *
 * @return void
 */
	/*public function index() {
		$this->AyudaContenido->recursive = 0;
		$this->set('ayudaContenidos', $this->Paginator->paginate());
	}*/

	public function index(){

		$ayudaContenido = $this->AyudaContenido->find('threaded',array(
				'recursive'=>-1,
				'fields'=>array('AyudaContenido.id','AyudaContenido.titulo','AyudaContenido.parent_id'),
				'order'=>array('AyudaContenido.lft'),
			));

		//debug($ayudaContenido); exit();

		if ($this->request->is('requested')) {
			return $ayudaContenido;
		} else {
    		$this->set('ayudaContenido', $ayudaContenido);
    	}
	}

	public function viewAll(){

		$ayudaContenido = $this->AyudaContenido->find('threaded',array(
				'recursive'=>-1,
				//'fields'=>array('AyudaContenido.id','AyudaContenido.titulo','AyudaContenido.parent_id'),
				'order'=>array('AyudaContenido.lft'),
			));
		$this->set('ayudaContenido', $ayudaContenido);
	}


	public function indexEdit() {
		$data = $this->AyudaContenido->generateTreeList(
			null,
			null,
			null,
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
		);
		$this->set('ayudaContenidos', $data);
	}


	public function test($id = null){

		if (!$this->AyudaContenido->exists($id)) {
			throw new NotFoundException(__('Invalid ayuda contenido'));
		}

		$self = $this->AyudaContenido->find('first',array('conditions'=>array('AyudaContenido.id'=>$id),'recursive'=>-1));
		$this->set('test1',$self);

		$test = $this->AyudaContenido->find('neighbors',array(
				'recursive' => -1,
				'field' => 'AyudaContenido.lft',
				'value' => $self['AyudaContenido']['lft'],
				//'conditions'=>array('AyudaContenido.parent_id' => $self['AyudaContenido']['parent_id']),
				//'order'=>array('AyudaContenido.lft'),
				// 6 => Friends
			));
		$this->set('test',$test);
		//threaded
	}


	public function move($move = null, $id = null, $delta = 1) {
		$this->AyudaContenido->id = $id;
	    if (!$this->AyudaContenido->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}

		if ($delta > 0) {
			if($move == 'down'){
				$this->AyudaContenido->moveDown($this->AyudaContenido->id, abs($delta));
			} else if($move == 'up'){
				$this->AyudaContenido->moveUp($this->AyudaContenido->id, abs($delta));
			} else {
				$this->Session->setFlash('Please provide the movement has done.');
			}
		} else {
			$this->Session->setFlash('Please provide the number of positions the field should be moved down.');
		}

		return $this->redirect(array('action' => 'indexEdit'));
	}


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {

		if (!$this->AyudaContenido->exists($id)) {

			//throw new NotFoundException(__('Invalid ayuda contenido'));
			
			$self = $this->AyudaContenido->find('first', array(
				'conditions' => array('AyudaContenido.parent_id' => null),
				'recursive'=>-1,
				'order'=>array('AyudaContenido.lft'),
			));
			$id = $self['AyudaContenido']['id'];
		}

		$ayudaContenido = $this->AyudaContenido->find('first', array(
				'conditions' => array('AyudaContenido.id' => $id),
				'recursive'=>0,
				//'order'=>array('AyudaContenido.lft'),
			));
		
		$ayudaContenido['ChildAyudaContenido'] = $this->AyudaContenido->find('all', array(
				'conditions' => array(
					'AyudaContenido.parent_id' => $ayudaContenido['AyudaContenido']['id']
				),
				'recursive'=>-1,
				'order'=>array('AyudaContenido.lft'),
			));

		$ruta = $this->AyudaContenido->getPath($id, array('AyudaContenido.id','AyudaContenido.titulo'));
		//$this->set('rutaAyudaContenido', $ruta);
		$ayudaContenido['ruta'] = $ruta;

		$vecinos = $this->AyudaContenido->find('neighbors',array(
				'recursive' => -1,
				'field' => 'AyudaContenido.lft',
				'value' => $ayudaContenido['AyudaContenido']['lft'],
			));
		$ayudaContenido = array_merge($ayudaContenido, $vecinos);

		//debug($ayudaContenido); exit();

		$this->set('ayudaContenido', $ayudaContenido);
		$this->set('title_for_layout', 'Ayuda: '.$ayudaContenido['AyudaContenido']['titulo']);

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		if ($this->request->is('post')) {
			$this->AyudaContenido->create();

			if ($this->AyudaContenido->save($this->request->data)) {
				$this->Session->setFlash(__('The ayuda contenido has been saved.'));
				return $this->redirect(array('action' => 'indexEdit'));
			} else {
				$this->Session->setFlash(__('The ayuda contenido could not be saved. Please, try again.'));
			}

		}

		$parentAyudaContenidos = $this->AyudaContenido->generateTreeList(null,null,null,'+    ');
		$this->set(compact('parentAyudaContenidos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AyudaContenido->exists($id)) {
			throw new NotFoundException(__('Invalid ayuda contenido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AyudaContenido->save($this->request->data)) {
				$this->Session->setFlash(__('The ayuda contenido has been saved.'));
				return $this->redirect(array('action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The ayuda contenido could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AyudaContenido.' . $this->AyudaContenido->primaryKey => $id));
			$this->request->data = $this->AyudaContenido->find('first', $options);
		}

		$parentAyudaContenidos = $this->AyudaContenido->generateTreeList(
				//array('AyudaContenido.' . $this->AyudaContenido->primaryKey.' <>' => $id)
			);
		$this->set(compact('parentAyudaContenidos'));
	}

/**
 * delete method
 *	
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AyudaContenido->id = $id;
		if (!$this->AyudaContenido->exists()) {
			throw new NotFoundException(__('Invalid ayuda contenido'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->AyudaContenido->delete()) {
			$this->Session->setFlash(__('The ayuda contenido has been deleted.'));
		} else {
			$this->Session->setFlash(__('The ayuda contenido could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'indexEdit'));
	}
}

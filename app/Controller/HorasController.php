<?php
App::uses('AppController', 'Controller');
/**
 * Horas Controller
 *
 * @property Hora $Hora
 */
class HorasController extends AppController {

/**
 * index method
 *
 * @return void
 */
    public function index($esquemaHora_id) {
        $this->ajaxLayout("ajax","vistaImpresion");
        
        $this->set('esquemaHora_id',$esquemaHora_id);
        $this->set('esquemaHora',$this->Hora->EsquemaHora->find('first',array('conditions'=>array('EsquemaHora.id'=>$esquemaHora_id))));

//        $this->Hora->Behaviors->attach('Containable');
            
        $horas = $this->Hora->find('all',array(
            'fields'=>array('Hora.id','Hora.numero','Hora.inicio','Hora.fin'),
            'contain' => array('Turno.id','Turno.nombre'),
            'conditions'=>array('esquema_hora_id'=>$esquemaHora_id),
            'order'=>array('Hora.numero')
         ));

        $this->set('horas', $horas);
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*	public function view($id = null) {
      // NO LO USO
		$this->Hora->id = $id;
		if (!$this->Hora->exists()) {
			throw new NotFoundException(__('Invalid hora'));
		}
		$this->set('hora', $this->Hora->read(null, $id));
	}
*/
/**
 * add method
 *
 * @return void
 */
    public function add($esquemaHora_id = null) {
        $this->ajaxLayout("ajax");
        if ($this->request->is('post')) {
            $this->Hora->create();
            if ($this->Hora->save($this->request->data)) {
                //$this->Session->setFlash(__('The hora has been saved'));
                //$this->redirect(array('action' => 'index'));
                $this->set('ok','ok');
            } else {
                //$this->Session->setFlash(__('The hora could not be saved. Please, try again.'));
            }
        }
        $esquemaHora = $esquemaHora_id;
        $turnos = $this->Hora->Turno->find('list');
        $this->set(compact('esquemaHora', 'turnos'));
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        $this->ajaxLayout("ajax");
        $this->Hora->id = $id;
        if (!$this->Hora->exists()) {
            throw new NotFoundException(__('Invalid hora'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Hora->save($this->request->data)) {
                //$this->Session->setFlash(__('The hora has been saved'));
                //$this->redirect(array('action' => 'index'));
                $this->set('ok','ok');
            } else {
                //$this->Session->setFlash(__('The hora could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Hora->read(null, $id);
        }
        $turnos = $this->Hora->Turno->find('list');
        $this->set(compact('turnos'));
    }

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null, $esquemaHora_id = null) {
		if (!$this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->Hora->id = $id;
		if (!$this->Hora->exists()) {
			throw new NotFoundException(__('Invalid hora'));
		}
		if ($this->Hora->delete()) {
			$this->Session->setFlash(__('Hora deleted'));
			$this->redirect(array('controller'=>'EsquemaHoras','action' => 'view', $esquemaHora_id));
		}
		$this->Session->setFlash(__('Hora was not deleted'));
		$this->redirect(array('controller'=>'EsquemaHoras','action' => 'view', $esquemaHora_id));
	}
}

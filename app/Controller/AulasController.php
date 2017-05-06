<?php
App::uses('AppController', 'Controller');
/**
 * Aulas Controller
 *
 * @property Aula $Aula
 */
class AulasController extends AppController {

/**
 * index method
 *
 * @return void
 */
    /*public function index() {
        $this->ajaxLayout("ajaxContenido");
        $aulas = $this->Aula->find('all',array('conditions'=>array('Aula.proyecto_id'=>$this->Session->read('Proyecto.id')),'recursive'=>0,'order'=>array('Aula.tipo_aula_id','Aula.nombre+0')));
        $this->set('aulas',$aulas);
    } */
    
    public function index() {
        $this->ajaxLayout("ajaxContenido");
        $this->Aula->recursive = 0;
        $aulas = $this->paginate('Aula',array('Aula.proyecto_id'=>$this->Session->read('Proyecto.id')));
        $this->set('aulas',$aulas);
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null, $editar_bloques = false) {
        $this->ajaxLayout("ajaxContenido");
        $this->Aula->id = $id;
        if (!$this->Aula->exists()) {
            throw new NotFoundException(__('Invalid aula'));
        }

        $aula = $this->Aula->find('first', array(
            'fields'=>array('Aula.id','Aula.nombre','TipoAula.nombre','Aula.esquema_dia_id','Aula.esquema_hora_id','Ubicacion.id','Ubicacion.nombre','Ubicacion.descripcion','Ubicacion.coordenadas'),
            'conditions'=>array('Aula.id'=>$id),
            'recursive'=>0
        ));
        
        $this->set('aula',$aula);
    }


    public function verBloques($id){
        $this->ajaxLayout("ajax");
        //$this->layout = ($this->request->is("ajax")) ? "ajax" : "default";

        $this->Aula->id = $id;
        if (!$this->Aula->exists()) {
            throw new NotFoundException(__('Invalid aula'));
        }

        $aula = $this->Aula->find('first', array(
            'fields'=>array('Aula.id','Aula.nombre','TipoAula.nombre','Aula.esquema_dia_id','Aula.esquema_hora_id','Ubicacion.id','Ubicacion.nombre','Ubicacion.descripcion'),
            'conditions'=>array('Aula.id'=>$id),
            'recursive'=>0
          ));
      $this->set('aula',$aula);
      
      $dias = $this->Aula->EsquemaDia->Dia->find('all',array('conditions'=>array('Dia.esquema_dia_id'=>$aula['Aula']['esquema_dia_id']),'recursive'=>-1,'order'=>array('Dia.numero')));
      $this->set('dias',$dias);
      
      $horas = $this->Aula->EsquemaHora->Hora->find('all',array('conditions'=>array('Hora.esquema_hora_id'=>$aula['Aula']['esquema_hora_id']),'recursive'=>-1,'order'=>array('Hora.numero')));
      $this->set('horas',$horas);

      $separacion = $this->Aula->EsquemaHora->find('first',array(
          'fields'=>array('EsquemaHora.sep_num'),
          'conditions'=>array('EsquemaHora.id'=>$aula['Aula']['esquema_hora_id']),
          'recursive'=>-1
      ));
      $this->set('separacion',$separacion);
      
      $bloques = $this->Aula->Bloque->find('all',array(
          'fields'=>array('Bloque.id','Bloque.aula_id','Bloque.hora_id','Bloque.dia_id','Bloque.activo','EncuentrosSeccion.id','EncuentrosSeccion.seccion_id','EncuentrosSeccion.encuentro_id'),
          'conditions'=>array('Bloque.aula_id'=>$id),
          'order'=>array('Hora.numero','Dia.numero'),
          'recursive'=>1
      ));
      
        foreach($bloques as $bloque){
             $aux = null;
             $aux['Bloque']['aula_id'] = $bloque['Bloque']['aula_id'];
             $aux['Bloque']['id'] = $bloque['Bloque']['id'];
             $aux['Bloque']['activo'] = $bloque['Bloque']['activo'];
             if($bloque['EncuentrosSeccion']['id'] != null){
                $aux['Bloque']['EncuentrosSeccion']['id'] = $bloque['EncuentrosSeccion']['id'];
                $aux['Bloque']['EncuentrosSeccion']['seccion_id'] = $bloque['EncuentrosSeccion']['seccion_id'];
                $aux['Bloque']['EncuentrosSeccion']['encuentro_id'] = $bloque['EncuentrosSeccion']['encuentro_id'];
                $encuentro = $this->Aula->Bloque->EncuentrosSeccion->Encuentro->find('first',array('conditions'=>array('Encuentro.id'=>$aux['Bloque']['EncuentrosSeccion']['encuentro_id'])));
                $aux['Bloque']['Encuentro']['id'] = $bloque['EncuentrosSeccion']['encuentro_id'];
                $aux['Bloque']['Encuentro']['cant_horas'] = $encuentro['Encuentro']['cant_horas'];

                $seccion = $this->Aula->Bloque->EncuentrosSeccion->Seccion->find('first',array('conditions'=>array('Seccion.id'=>$bloque['EncuentrosSeccion']['seccion_id']),));
                //$log = $this->Aula->getDataSource()->getLog(false, false);
                //debug($log);
                //debug($seccion);

                $aux['Bloque']['Seccion']['id'] = $bloque['EncuentrosSeccion']['seccion_id'];
                $aux['Bloque']['Seccion']['cupo'] = $seccion['Seccion']['cupo'];
                $aux['Bloque']['Seccion']['nombre'] = $seccion['Seccion']['nombre'];
                $aux['Bloque']['Seccion']['Materia']['nombre'] = $seccion['Materia']['nombre'];
                $aux['Bloque']['Seccion']['Materia']['avr'] = $seccion['Materia']['avr'];
                $aux['Bloque']['Seccion']['Materia']['nivel'] = $seccion['Materia']['nivel'];
                $aux['Bloque']['Seccion']['Docente'] = $seccion['Docente'];
                /*******************************************/
                /* Revisar info extra sobre los encuentros */
                /*******************************************/
            }
            //debug($aux);
            $cuadros[$bloque['Bloque']['hora_id']][$bloque['Bloque']['dia_id']] = $aux;
        }
        //debug($cuadros);
        $this->set('bloques',$cuadros);
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        $this->ajaxLayout("ajaxContenido");

        if ($this->request->is('post')) {
            $aulas_nombres = explode(",",trim($this->request->data['Aula']['nombre'],','));

            $realizado = false;
            
            foreach($aulas_nombres as $aula_nombre){

                $this->request->data['Aula']['nombre'] = trim($aula_nombre,' ');
                
                $this->Aula->create();

                if ($this->Aula->save($this->request->data)){
                    $mensaje = 'Nueva Aula Creada';
                    
                    $subsql = 'SELECT aulas.id as \'aula_id\', dias.id as \'dia_id\', horas.id as \'hora_id\', \'1\' as \'activo\', \''.date("Y-m-d H:i:s").'\' as \'created\', \''.date("Y-m-d H:i:s").'\' as \'updated\' FROM horas, dias, aulas WHERE horas.esquema_hora_id = '.$this->request->data['Aula']['esquema_hora_id'].' and dias.esquema_dia_id = '.$this->request->data['Aula']['esquema_dia_id'].' and aulas.id = '.$this->Aula->id;
                    $sql = 'INSERT INTO bloques (aula_id, dia_id, hora_id, activo, created, updated)
                          ('.$subsql.')';
                    
                    if($this->Aula->Bloque->query($sql)){
                        $mensaje += '<br />Bloques creados';
                    }
                    
                    $this->Session->setFlash(__($mensaje));
                    $realizado = true;
                    
                } else {
                    $this->Session->setFlash(__('No se ha podido crear el Aula, Intetelo de nuevo'));
                }
            }

            if($realizado){
                $this->redirect(array('action' => 'index'));
            }else
            $this->request->data['Aula']['nombre'] = implode(',',$aulas_nombres);
        }

        $tipoAulas = $this->Aula->TipoAula->find('list');
        $ubicacions = $this->Aula->Ubicacion->find('list');
        $proyecto = $this->Session->read('Proyecto.id');
        $esquemaDias = $this->Aula->EsquemaDia->find('list');
        $esquemaHoras = $this->Aula->EsquemaHora->find('list');
        $this->set(compact('tipoAulas', 'ubicacions', 'proyecto', 'esquemaDias', 'esquemaHoras'));
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
            
		$this->Aula->id = $id;
		if (!$this->Aula->exists()) {
                    throw new NotFoundException(__('Aula Invalida'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
                    if ($this->Aula->save($this->request->data)) {
                        $this->Session->setFlash(__('Cambios en el Aula han sido guardados'));
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__('No se han podido guardar los cambios. Por favor intentelo de nuevo'));
                    }
		} else {
                    $this->request->data = $this->Aula->read(null, $id);
		}

		$tipoAulas = $this->Aula->TipoAula->find('list');
		$ubicacions = $this->Aula->Ubicacion->find('list');
//		$proyectos = $this->Aula->Proyecto->find('list');
//		$esquemaDias = $this->Aula->EsquemaDia->find('list');
//		$esquemaHoras = $this->Aula->EsquemaHora->find('list');
		$this->set(compact('tipoAulas', 'ubicacions'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null){
                $this->layout = ($this->request->is("ajax")) ? "ajaxContenido" : "default";
		if (!$this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->Aula->id = $id;
		if (!$this->Aula->exists()) {
			throw new NotFoundException(__('Aula Invalida'));
		}
		if ($this->Aula->delete()) {
			$this->Session->setFlash(__('Aula deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Aula was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
        
    public function maestroAulas(){
        $this->ajaxLayout("ajaxContenido");
    
        $proyecto_id = $this->Session->read('Proyecto.id');
        $aulas = $this->Aula->find('list', array('conditions'=>array('Aula.proyecto_id'=>$proyecto_id),'order'=>array('Aula.tipo_aula_id','Aula.nombre+0','Aula.nombre')));
        if(count($aulas)==0){
            $this->Session->setFlash(__('No se han creado aulas para este proyecto'));
            $this->redirect(array('controller' => 'aulas', 'action' => 'add'));
        }
        $this->set('aulas', $aulas);
    }

    public function maestroAulaUnica($aula_id){
        $this->ajaxLayout("ajaxContenido");

        $proyecto_id = $this->Session->read('Proyecto.id');
        
        $aulas = $this->Aula->find('list', array('conditions'=>array('Aula.id'=>$aula_id,'Aula.proyecto_id'=>$proyecto_id),'order'=>array('Aula.tipo_aula_id','Aula.nombre+0')));
        if(count($aulas)==0){
            $this->Session->setFlash(__('No se han creado aulas para este proyecto'));
            $this->redirect(array('controller' => 'aulas', 'action' => 'add'));
        }
        $this->set('aulas', $aulas);
        $this->render('maestro_aulas');
    }    
    
   
   
   public function categoriasMaestroAulas(){
        $this->ajaxLayout("ajaxContenido");
        $proyecto_id = $this->Session->read('Proyecto.id');
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $conditions['Aula.proyecto_id'] = $proyecto_id;

            if(isset($this->request->data['tipoAula'])){
                $conditions['Aula.tipo_aula_id'] = $this->request->data['tipoAula'];
            }

            if(isset($this->request->data['ubicacion'])){
                $conditions['Aula.ubicacion_id'] = $this->request->data['ubicacion'];
            }
            if(isset($this->request->data['esquemaDia'])){
                $conditions['Aula.esquema_dia_id'] = $this->request->data['esquemaDia'];
            }
            if(isset($this->request->data['esquemaHora'])){
                $conditions['Aula.esquema_hora_id'] = $this->request->data['esquemaHora'];
            }

            $aulas = $this->Aula->find('list',array('conditions'=>$conditions,'order'=>array('Aula.tipo_aula_id','Aula.nombre+0','Aula.nombre')));

            if(count($aulas)==0){
                $this->Session->setFlash(__('No se han encontrado aulas con la informacion suministrada'));
                $this->redirect(array('action' => 'categoriasMaestroAulas'));
            }

            $this->set('aulas', $aulas);
            $this->render('maestro_aulas');
            
        }else{
            $tiposAulas = $this->Aula->find('list',array('conditions'=>array('Aula.proyecto_id'=>$proyecto_id),'fields'=>array('TipoAula.id','TipoAula.nombre'),'group' => 'TipoAula.id','recursive'=>0));
            $this->set('tiposAulas',$tiposAulas);

            $ubicaciones = $this->Aula->find('list',array('conditions'=>array('Aula.proyecto_id'=>$proyecto_id),'fields'=>array('Ubicacion.id','Ubicacion.nombre'),'group' => 'Ubicacion.id','recursive'=>0));
            $this->set('ubicaciones',$ubicaciones);
            
            $esquemaDias = $this->Aula->find('list',array('conditions'=>array('Aula.proyecto_id'=>$proyecto_id),'fields'=>array('EsquemaDia.id','EsquemaDia.nombre'),'group' => 'EsquemaDia.id','recursive'=>0));
            $this->set('esquemaDias',$esquemaDias);
            

            $esquemaHoras = $this->Aula->find('list',array('conditions'=>array('Aula.proyecto_id'=>$proyecto_id),'fields'=>array('EsquemaHora.id','EsquemaHora.nombre'),'group' => 'EsquemaHora.id','recursive'=>0));
            $this->set('esquemaHoras',$esquemaHoras);
            
        }        

   }
        
   
}

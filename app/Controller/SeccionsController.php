<?php
App::uses('AppController', 'Controller');
/**
 * Seccions Controller
 *
 * @property Seccion $Seccion
 */
class SeccionsController extends AppController {


    public function revisarChoqueSecciones($encuentro_seccion_id){

        /*
         * Hacer revision por nivel
         * revisar la seccion_id, en el dia y las horas correspondientes
         */
        
/*            $cant_choques = $this->Seccion->Bloque->find('count',
                        array('conditions'=>
                            array(
                                'Aula.proyecto_id'=>$this->Session->read('Proyecto.id'),
                                'EncuentrosSeccion.seccion_id'=>$seccion_id,
                                'Bloque.dia_id'=>$dia_id,
                                'Bloque.hora_id'=>$horas_id,
                                'not'=>array('Bloque.encuentros_seccion_id'=>null)
                            )
                        )
                    );

            
            if($cant_choques>0){
                return true;
            }else{
                return false;
            }
*/
    }
 

    /**
     * index method
     *
     * @return void
     * 
     */
	public function index() {
            $this->ajaxLayout("ajaxContenido");
            $this->Seccion->recursive = 1;
            $seccions = $this->paginate('Seccion',array('Seccion.proyecto_id'=>$this->Session->read('Proyecto.id')));
            $this->set('seccions',$seccions);
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
            $this->Seccion->id = $id;
            if (!$this->Seccion->exists()) {
                throw new NotFoundException(__('Invalid seccion'));
            }
            $seccion = $this->Seccion->read(null, $id);
            $this->set('seccion', $seccion);
	}

/**
 * add method
 *
 * @return void
 */
    public function add() {
        $this->ajaxLayout("ajaxContenido");
        if ($this->request->is('post')) {
            
            $secciones_nombres = explode(",",trim($this->request->data['Seccion']['nombre'],','));

            $realizado = true;
            foreach($secciones_nombres as $seccion_nombre){
                $this->request->data['Seccion']['nombre'] = trim($seccion_nombre,' ');
                $this->request->data['Encuentro']['Encuentro'] = $this->Seccion->Materia->Encuentro->find('list',array('conditions'=>array('materia_id'=>$this->request->data['Seccion']['materia_id'])));

                $this->Seccion->create();
                if ($this->Seccion->save($this->request->data)){
                    // Realizado
                } else {
                    $error[] = $seccion_nombre;
                    $realizado = false;
                }
            }

            if($realizado){
                $this->Session->setFlash(__('Se han guardado todas las Secciones.'));
                $this->redirect(array('action' => 'index'));
            }else{
                $this->request->data['Seccion']['nombre'] = implode(",", $secciones_nombres);
            }
        }
        
        $materias = $this->Seccion->Materia->find('list',array(
            'fields'=>array('Materia.id','Materia.nombre','Materia.nivel'),
            'conditions'=>array('Materia.pensum_id'=>$this->Session->read('Proyecto.Pensum.id')),
            'order'=>array('Materia.nivel','Materia.nombre')
        ));
        $proyecto = $this->Session->read('Proyecto.id');
        $turnos = $this->Seccion->Turno->find('list');
        
        $docentes = $this->Seccion->Docente->find('list',array(
            'conditions'=>array('Docente.area_id'=>$this->Session->read('Proyecto.Area.id')),
            'fields'=>array('Docente.id','Docente.nombre_completo'),
            'order'=>array('Docente.nombres','Docente.apellidos')
        ));


        $this->set(compact('materias', 'proyecto', 'turnos', 'docentes'));
}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null,$popup = false) {
        $this->ajaxLayout("ajax");
        $this->Seccion->id = $id;
        
        if (!$this->Seccion->exists()) {
            throw new NotFoundException(__('Invalid seccion'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            $seccion_current = $this->Seccion->find('first',array('conditions'=>array('id'=>$id),'recursive' => -1));
            if($seccion_current['Seccion']['nombre'] != $this->request->data['Seccion']['nombre']){
                    $seccion_otro = $this->Seccion->find('first',array('conditions'=>array('nombre'=>$this->request->data['Seccion']['nombre'],'materia_id' => $seccion_current['Seccion']['materia_id'],'proyecto_id' => $seccion_current['Seccion']['proyecto_id']),'recursive' => -1));
            }
            
            //$encuentros = $this->Seccion->Materia->Encuentro->find('list',array('conditions'=>array('materia_id'=>$seccion_current['Seccion']['materia_id'])));
            //debug($encuentros);
            //die;

            if ($this->Seccion->save($this->request->data)){
                if($seccion_otro){
                    $this->Seccion->id = $seccion_otro['Seccion']['id'];
                    $this->Seccion->saveField('nombre', $seccion_current['Seccion']['nombre']);
                }
                
                // Revisar Encuentros !!!
                
                
                if($popup)  $this->redirect(array('controller'=>'menu','action' => 'done'));
                    else    $this->redirect(array('action' => 'view',$id));

            } else {
                $this->Session->setFlash(__('The seccion could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Seccion->read(null, $id);
        }
        
        $materias = $this->Seccion->Materia->find('list',array('conditions'=>array('Materia.id'=>$this->request->data['Seccion']['materia_id'])));
        $turnos = $this->Seccion->Turno->find('list');
        $this->set(compact('turnos','materias'));
        
        $docentes = $this->Seccion->Docente->find('list',array('conditions'=>array('Docente.area_id'=>$this->Session->read('Proyecto.Area.id')),'fields'=>array('Docente.id','Docente.nombre_completo'),'order'=>array('Docente.nombres','Docente.apellidos')));        
        
        $this->set('docentes', $docentes);
        $this->set('popup', $popup);
        
        
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
        
        $this->Seccion->id = $id;
        if (!$this->Seccion->exists()) {
            throw new NotFoundException(__('Seccion Invalida'));
        }

        $encuentrosSeccion_id = $this->Seccion->EncuentrosSeccion->find('list',array(
            'fields'=>array('EncuentrosSeccion.id'),
            'conditions'=>array('EncuentrosSeccion.seccion_id'=>$id)
        ));
        
        $this->Seccion->Proyecto->Aula->Bloque->updateAll(
            array('Bloque.encuentros_seccion_id'=>null),
            array('Bloque.encuentros_seccion_id'=>$encuentrosSeccion_id)
        );

        if ($this->Seccion->delete()) {
            $this->Session->setFlash(__('Sección eliminada'));
            $this->redirect(array('action' => 'index'));
        }

        $this->Session->setFlash(__('err. Sección no ha podido ser eliminada'));
        $this->redirect(array('action' => 'index'));
    }

   
   
    public function seleccionar($materia_id = null){
        $this->ajaxLayout("ajax");
        if($materia_id){
            $this->set('secciones',$this->Seccion->find('list',array('fields'=>array('Seccion.id','Seccion.nombre'),'conditions'=>array('Seccion.materia_id'=>$materia_id,'Seccion.proyecto_id'=>$this->Session->read('Proyecto.id')),'recursive'=>1,'order'=>'Seccion.nombre+0')));
        }else{
            $this->set('secciones',array());
        }
    }
   
    public function seleccionarEncuentros($seccion_id = null){
        $this->ajaxLayout("ajax");

        App::import('Model','Bloque');
        $MoBloque = new Bloque();
      
        if($seccion_id){
            $encuentrosSeccion = $this->Seccion->EncuentrosSeccion->find('all',array('recursive'=>-1,'conditions'=>array('EncuentrosSeccion.seccion_id'=>$seccion_id)));
         
            for($i=0; $i<count($encuentrosSeccion); $i++){
                $encuentrosSeccion[$i]['Encuentro']= $this->Seccion->Encuentro->find('first',array(
                'conditions'=>array('Encuentro.id'=>$encuentrosSeccion[$i]['EncuentrosSeccion']['encuentro_id']),
                'fields'=>array('Encuentro.id','Encuentro.cant_horas','TipoAula.nombre','TipoAula.modalidad'),
                'recursive'=>0));

                $encuentrosSeccion[$i]['Bloque'] = $MoBloque->find('first',array(
                    'conditions'=>array('Bloque.encuentros_seccion_id'=>$encuentrosSeccion[$i]['EncuentrosSeccion']['id']),
                    'fields'=>array('Aula.id','Aula.nombre','Dia.nombre','min(Hora.inicio) as inicio','max(Hora.fin) as fin')
                ));
            
                /*$encuentrosSeccion[$i]['Bloque'] = $this->Seccion->EncuentrosSeccion->Bloque->find('all',array(
                    'conditions'=>array('Bloque.encuentros_seccion_id'=>$encuentrosSeccion[$i]['EncuentrosSeccion']['id']),
                    'recursive'=>0)); */
            }

            $this->set('encuentros_seccion',$encuentrosSeccion);
         
            $seccion = $this->Seccion->find('first',array(
                'conditions'=>array('Seccion.id'=>$seccion_id),
                //'fields'=>array('Seccion.nombre', 'Materia.nombre','Materia.avr','Turno.nombre','Docente')
            ));
            //debug($seccion);
            
            $this->set('seccion',$seccion);
        }else{
            $this->set('encuentros_seccion',null);
        }
    }
   
    public function seccionesNivel($nivel, $impresion=null){
        if($impresion != null){
            $this->layout = "vistaImpresion";
        }else{
            $this->ajaxLayout("ajax");
        }
        
        //$this->layout = 'ajax';
      
        $this->set('nivel',$nivel);

        $horarios = $this->Seccion->query('SELECT * FROM `v_resumen` as `Resumen` WHERE `Resumen`.`materia_nivel` = '.$nivel.' AND `Resumen`.`proyecto_id` = '.$this->Session->read('Proyecto.id').' ORDER BY `Resumen`.`dia_numero` ASC;');

        $resumen = null;
        foreach($horarios as $horario){
            if( !isset( $resumen[$horario['Resumen']['seccion_detalle_id']][$horario['Resumen']['materia_id']]) ){
                $resumen[$horario['Resumen']['seccion_detalle_id']][$horario['Resumen']['materia_id']]['Seccion'] = $horario['Resumen'];
                unset($resumen[$horario['Resumen']['seccion_detalle_id']][$horario['Resumen']['materia_id']]['Seccion']['encuentros_seccion_id']);
                unset($resumen[$horario['Resumen']['seccion_detalle_id']][$horario['Resumen']['materia_id']]['Seccion']['encuentros_seccion_id_exist']);
                unset($resumen[$horario['Resumen']['seccion_detalle_id']][$horario['Resumen']['materia_id']]['Seccion']['aula_id']);
                unset($resumen[$horario['Resumen']['seccion_detalle_id']][$horario['Resumen']['materia_id']]['Seccion']['aula_nombre']);
                unset($resumen[$horario['Resumen']['seccion_detalle_id']][$horario['Resumen']['materia_id']]['Seccion']['dia_numero']);
                unset($resumen[$horario['Resumen']['seccion_detalle_id']][$horario['Resumen']['materia_id']]['Seccion']['dia_nombre']);
                unset($resumen[$horario['Resumen']['seccion_detalle_id']][$horario['Resumen']['materia_id']]['Seccion']['hora_numero_inicio']);
                unset($resumen[$horario['Resumen']['seccion_detalle_id']][$horario['Resumen']['materia_id']]['Seccion']['hora_inicio']);
                unset($resumen[$horario['Resumen']['seccion_detalle_id']][$horario['Resumen']['materia_id']]['Seccion']['hora_numero_fin']);
                unset($resumen[$horario['Resumen']['seccion_detalle_id']][$horario['Resumen']['materia_id']]['Seccion']['hora_fin']);
            }
         
            $encuentro = null;
            $encuentro['encuentros_seccion_id'] = $horario['Resumen']['encuentros_seccion_id_exist'];
            $encuentro['aula_id'] = $horario['Resumen']['aula_id'];
            $encuentro['aula_nombre'] = $horario['Resumen']['aula_nombre'];
            $encuentro['dia_numero'] = $horario['Resumen']['dia_numero'];
            $encuentro['dia_nombre'] = $horario['Resumen']['dia_nombre'];
            $encuentro['hora_numero_inicio'] = $horario['Resumen']['hora_numero_inicio'];
            $encuentro['hora_inicio'] = $horario['Resumen']['hora_inicio'];
            $encuentro['hora_numero_fin'] = $horario['Resumen']['hora_numero_fin'];
            $encuentro['hora_fin'] = $horario['Resumen']['hora_fin'];
            $encuentro['modalidad'] = $horario['Resumen']['encuentro_modalidad'];
            $encuentro['cant_horas'] = $horario['Resumen']['encuentro_cant_horas'];
            //$encuentro['choque_materia'] = $this->revisarChoqueSecciones($horario['Resumen']['seccion_id'], $horario['Resumen']['seccion_id'], $horario['Resumen']['dia_id']);
            $encuentro['choque_materia'] = false;
         
            $resumen[$horario['Resumen']['seccion_detalle_id']][$horario['Resumen']['materia_id']]['Encuentros'][] = $encuentro;
        }

        $this->set('horarios',$resumen);

        $materias = $this->Seccion->Materia->find('all',array(
            'field'=>array('Materia.id','Materia.nombre','Materia.avr'),
            'conditions' => array('Materia.pensum_id'=>$this->Session->read('Proyecto.Pensum.id'), 'Materia.nivel'=>$nivel),
            'order'=>array('Materia.nombre'),
            'recursive'=>-1
        ));
        $this->set('materias',$materias);

        $secciones = $this->Seccion->query('SELECT `Seccion`.`seccion_detalle_id` as `id`,`Seccion`.`seccion_nombre` as `nombre` FROM `v_secciones_enc` as Seccion WHERE `proyecto_id` = '.$this->Session->read('Proyecto.id').' AND `materia_nivel` = '.$nivel.' GROUP BY `seccion_detalle_id`,`seccion_nombre` ORDER BY `seccion_nombre`+0');
        $this->set('secciones',$secciones);

        $pensum = $this->Seccion->Proyecto->Pensum->find('first',array('conditions'=>array('Pensum.id'=>$this->Session->read('Proyecto.Pensum.id')),'recursive'=>-1));
        $this->set('pensum',$pensum);

        //debug($this->Session->read('Proyecto'));
    }

   
} // Fin de la Clase SeccionsController

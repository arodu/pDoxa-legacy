<?php
App::uses('AppController', 'Controller');

class ProyectosController extends AppController {

    public function restricciones(){    
        $this->ajaxLayout("ajaxContenido");

        if ($this->request->is('post')) {
//            debug($this->request->data);
//            if(isArray($this->request->data["Proyecto"]["restricciones"])){
                $this->declararRestricciones(true);
                foreach($this->request->data["Proyecto"]["restricciones"] as $asignados){
                    $this->Session->write('Restriccion.'.$asignados.'.valor', true);
                }
                $this->Session->setFlash(__('Los cambios han sido guardados!'));
//            }
//)            $this->request->data
        }
    }

    private function declararRestricciones($anular = false){
        if($anular){
            $this->Session->write('Restriccion.tipoAula.valor', false);
            $this->Session->write('Restriccion.mismoDia.valor', false);
            //$this->Session->write('Restriccion.turno.valor', false);
            //$this->Session->write('Restriccion.choqueDocente.valor', false);
        }else{
            $this->Session->write('Restriccion.tipoAula', array('tipo'=>'Tipo de Aula a Asignar','valor'=>true, 'mensaje'=>'Solo se guardaran las secciones en el Tipo de Aula que le corresponde.'));
            $this->Session->write('Restriccion.mismoDia', array('tipo'=>'Día del Encuentro','valor'=>true, 'mensaje'=>'Solo se guardaran los encuentros en Diferentes Dias'));
            //$this->Session->write('Restriccion.turno', array('tipo'=>'Turno de la Seccion','valor'=>true, 'mensaje'=>'Solo se guardaran las secciones en el Turno que le corresponde.'));
            //$this->Session->write('Restriccion.choqueDocente', array('tipo'=>'Choque de Horario Docente','valor'=>true, 'mensaje'=>'No se permitira el choque de horario de un docente.'));
        }
    }
/**
 * index method
 *
 * @return void
 */
/*    public function index() {
            $this->ajaxLayout("ajaxContenido");
            $this->Proyecto->recursive = 0;
            $this->set('proyectos', $this->paginate('Proyecto',array('Proyecto.id'=>$this->Session->read('Proyecto.id'))));
    }
*/   
    
    private function proyectoSeleccionado($proyecto_id){
      if($proyecto_id != null){
//          debug($this->request->data['Proyecto']['seleccion']);
            $seleccionado = $this->Proyecto->find('first',array('conditions'=>array('Proyecto.id'=>$proyecto_id), 'recursive'=>-1));
            $carrera = $this->Proyecto->Pensum->find('first',array('fields'=>array('Carrera.id', 'Carrera.nombre', 'Carrera.area_id', 'Pensum.nombre', 'Pensum.regimen'),'conditions'=>array('Pensum.id'=>$seleccionado['Proyecto']['pensum_id']), 'recursive'=>0));
            $area = $this->Proyecto->Pensum->Carrera->Area->find('first',array('conditions'=>array('Area.id'=>$carrera['Carrera']['area_id']),'recursive'=>-1));

            $this->Session->write('Proyecto',array()); // Eliminar valores anteriores
            $this->Session->write('Proyecto.id',$seleccionado['Proyecto']['id']);
            $this->Session->write('Proyecto.nombre',$seleccionado['Proyecto']['nombre']);
            $this->Session->write('Proyecto.lapso_academico',$seleccionado['Proyecto']['lapso_academico']);

            $this->Session->write('Proyecto.Detalles.fecha_memo',$seleccionado['Proyecto']['fecha_memo']);
            $this->Session->write('Proyecto.Detalles.observaciones',$seleccionado['Proyecto']['observaciones']);

            $this->Session->write('Proyecto.Pensum.id',$seleccionado['Proyecto']['pensum_id']);
            $this->Session->write('Proyecto.Pensum.nombre', $carrera['Pensum']['nombre']);
            $this->Session->write('Proyecto.Pensum.regimen', $carrera['Pensum']['regimen']);
            $this->Session->write('Proyecto.Carrera.id', $carrera['Carrera']['id']);
            $this->Session->write('Proyecto.Carrera.nombre', $carrera['Carrera']['nombre']);
            $this->Session->write('Proyecto.Area.id', $area['Area']['id']);
            $this->Session->write('Proyecto.Area.nombre', $area['Area']['nombre']);

            $this->declararRestricciones();
      }else{
            $this->Session->write('Proyecto',null); // Eliminar valores
            $this->declararRestricciones(true);
      }
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
		$this->Proyecto->id = $id;
		if (!$this->Proyecto->exists()) {
			throw new NotFoundException(__('Invalid proyecto'));
		}
		$this->set('proyecto', $this->Proyecto->read(null, $id));
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
            $this->Proyecto->create();
            if ($this->Proyecto->save($this->request->data)) {
                $this->proyectoSeleccionado($this->Proyecto->id);
                $this->Session->setFlash(__('El Proyecto ha sido creado'));
                $this->redirect(array('action' => 'seleccionar'));
            } else {
                $this->Session->setFlash(__('No se ha podido crear el proyecto, Intentelo de nuevo!'));
            }
        }
        $pensums = $this->Proyecto->Pensum->find('list',array('fields'=>array('Pensum.id','Pensum.nombre','Carrera.nombre'),'recursive'=>0));
        $this->set(compact('pensums'));
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

        $this->Proyecto->id = $id;
        if (!$this->Proyecto->exists()) {
            throw new NotFoundException(__('Invalid proyecto'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Proyecto->save($this->request->data)) {
                $this->Session->setFlash(__('The proyecto has been saved'));
                $this->proyectoSeleccionado($id);
                $this->redirect(array('action' => 'seleccionar'));
            } else {
                $this->Session->setFlash(__('The proyecto could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Proyecto->read(null, $id);
        }
        $pensums = $this->Proyecto->Pensum->find('list',array('fields'=>array('Pensum.id','Pensum.nombre','Carrera.nombre'),'recursive'=>0));
        $this->set(compact('pensums'));
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

        $this->Proyecto->id = $id;
        if (!$this->Proyecto->exists()) {
            throw new NotFoundException(__('Invalid proyecto'));
        }
        if ($this->Proyecto->delete()) {
            $this->Session->setFlash(__('Proyecto eliminado'));
            $this->Session->write('Proyecto',null); // Eliminar valores anteriores
            $this->redirect(array('action' => 'seleccionar'));
        }
        $this->Session->setFlash(__('Proyecto was not deleted'));
        $this->redirect(array('action' => 'seleccionar'));
    }

        
        
    public function seleccionar(){
        $this->ajaxLayout("ajaxContenido");
                
        if ($this->request->is('post')) {
            if($this->request->data['Proyecto']['seleccion'] == ''){
                $this->Session->setFlash(__('Seleccione una Opci&oacute;n'));
            }else{
                $this->proyectoSeleccionado($this->request->data['Proyecto']['seleccion']);
            }
        }
        
        if($this->Session->read('Proyecto')){
            $seleccionado = $this->Proyecto->find('first',array('recursive'=>0,'conditions'=>array('Proyecto.id'=>$this->Session->read('Proyecto.id'))));
            $this->set('seleccionado',$seleccionado);
            $selec_carrera = $this->Proyecto->Pensum->Carrera->find('first',array('recursive'=>0,'conditions'=>array('Carrera.id'=>$seleccionado['Pensum']['carrera_id'])));
            $this->set('selec_carrera',$selec_carrera);
            $secciones = $this->Proyecto->Seccion->find('list', array('conditions'=>array('Seccion.proyecto_id'=>$seleccionado['Proyecto']['id'])));
            $this->set('secciones',count($secciones));

            $aulas = $this->Proyecto->Aula->find('list', array('conditions'=>array('Aula.proyecto_id'=>$seleccionado['Proyecto']['id']),'fields'=>array('Aula.id')));
            $this->set('aulas',count($aulas));
            
            $bloques['disponibles'] = $this->Proyecto->Aula->Bloque->find('count',array('conditions'=>array('Bloque.activo'=>'1','Bloque.aula_id'=>$aulas,'Bloque.encuentros_seccion_id'=>null)));
            $bloques['totales'] = $this->Proyecto->Aula->Bloque->find('count',array('conditions'=>array('Bloque.activo'=>'1','Bloque.aula_id'=>$aulas)));
            $this->set('bloques',$bloques);

        }

        
        /** ARREGLAR **/
        //$result = $this->Proyecto->Pensum->find('all',array('recursive'=>0));
        //debug($result);
        $proyectos = $this->Proyecto->query('SELECT `Proyecto`.`id`, `Proyecto`.`nombre`, `Carrera`.`nombre` FROM `proyectos` as `Proyecto` LEFT JOIN `pensums` as `Pensum` ON (`Pensum`.`id` = `Proyecto`.`pensum_id`) LEFT JOIN `carreras` as `Carrera` ON (`Carrera`.`id` = `Pensum`.`carrera_id`) WHERE 1 ORDER BY `Proyecto`.`fecha` DESC');
        $env_proyectos = null;
        foreach($proyectos as $proyecto){
            $env_proyectos[$proyecto['Carrera']['nombre']][$proyecto['Proyecto']['id']] = $proyecto['Proyecto']['nombre'];
        }
        $this->set('proyectos',$env_proyectos);
    }


    public function cerrar(){
        $this->proyectoSeleccionado(null);
        $this->redirect(array('action' => 'seleccionar'));
    }
   
/*    public function mostrarSecciones($id = null) {
        $this->ajaxLayout("ajaxContenido");
                
        $this->Proyecto->id = $id;
        if (!$this->Proyecto->exists()) {
            throw new NotFoundException(__('Invalid proyecto'));
        }
        $secciones = $this->Proyecto->Seccion->find('all',
            array(
                'conditions'=>array('Seccion.proyecto_id'=>$id)
            ));
        debug($secciones);
    } */
   
/*   public function resumen($empotrado = null){

      $this->ajaxLayout("ajaxContenido");
      
      $this->set('title_for_layout','Resumen de Horarios Semanales');
      $this->set('menu','resumen');

      if($empotrado == 1){
         $this->ajaxLayout("ajaxContenido");
      }
//      $this->layout = 'ajaxContenido';
      $niveles = $this->Proyecto->Pensum->Materia->find('all',array(
          'fields'=>array('Materia.nivel'),
          'conditions'=>array('Materia.pensum_id'=>$this->Session->read('Proyecto.Pensum.id')),
          'group'=>array('Materia.nivel'),
          'order'=>array('Materia.nivel'),
          'recursive'=>-1
      ));
      $this->set('niveles',$niveles);
      
      $pensum = $this->Proyecto->Pensum->find('first',array('conditions'=>array('Pensum.id'=>$this->Session->read('Proyecto.Pensum.id')),'recursive'=>-1));
      $this->set('pensum',$pensum);
      
      
   } */
   
   // REVISAR POR QUE NO FUNCIONA BIEN
/*   public function asistenciaDocentePrincipal(){
        $this->ajaxLayout("ajaxContenido");
        
        $sql = 'SELECT DISTINCT Resumen.direccion_id, Resumen.direccion_nombre FROM v_resumen as Resumen WHERE Resumen.proyecto_id = '.$this->Session->read('Proyecto.id').';';
        $direccions_R = $this->Proyecto->query($sql);
        foreach($direccions_R as $direccion){
            $direccions[$direccion['Resumen']['direccion_id']] = $direccion['Resumen']['direccion_nombre'];
        }
        $this->set('direccions',$direccions);
   } */

/*   public function asistenciaDocente($direccion_id=1, $dia_numero = 1, $impresion = null){
        if($impresion != null){
            $this->layout = "vistaImpresion";
        }else{
            $this->ajaxLayout("ajaxContenido");
        }

                if($this->request->is('post')){
                    $direccion_id =  $this->request->data['Proyecto']['Direcciones'];
                    $dia_numero = $this->request->data['Proyecto']['Dias'];
                }

                $sql = 'SELECT * FROM v_resumen as Resumen WHERE Resumen.proyecto_id = '.$this->Session->read('Proyecto.id').' AND Resumen.dia_numero IS NOT NULL AND Resumen.dia_numero = '.$dia_numero.' AND Resumen.direccion_id = '.$direccion_id.' ORDER BY Resumen.dia_numero, Resumen.hora_inicio, Resumen.hora_fin, Resumen.materia_nivel, Resumen.materia_nombre, Resumen.seccion_nombre;';
                //debug ($sql);
                $resumen = $this->Proyecto->query($sql);
                $this->set('resumen',$resumen);

                $sql = 'SELECT DISTINCT Resumen.direccion_id, Resumen.direccion_nombre FROM v_resumen as Resumen WHERE Resumen.direccion_id IS NOT NULL AND Resumen.proyecto_id = '.$this->Session->read('Proyecto.id').';';
                $direccions_R = $this->Proyecto->query($sql);
                foreach($direccions_R as $direccion){
                    $direccions[$direccion['Resumen']['direccion_id']] = $direccion['Resumen']['direccion_nombre'];
                }
                $this->set('direccions',$direccions);


                $sql = 'SELECT DISTINCT Resumen.dia_numero, Resumen.dia_nombre FROM v_resumen as Resumen WHERE Resumen.proyecto_id = '.$this->Session->read('Proyecto.id').';';
                $dias_R = $this->Proyecto->query($sql);
                foreach($dias_R as $dia){
                    $dias[$dia['Resumen']['dia_numero']] = $dia['Resumen']['dia_nombre'];
                }
                $this->set('dias',$dias);        

                //$this->set('title_for_layout','Asistencia Docente - '.$direccions[$direccion_id].' - '.$dias[$dia_numero]);
   } */
   
/*   public function verificacionAsistenciaDocente(){
        $this->set('num_semanas','16');
        $this->layout = 'html';

        $sql = 'SELECT * FROM v_resumen as Resumen WHERE Resumen.proyecto_id = '.$this->Session->read('Proyecto.id').' ORDER BY Resumen.materia_nivel, Resumen.materia_nombre';
        $resumen = $this->Proyecto->query($sql);
        $docente = null;
        foreach ($resumen as $registro){
            $docente[$registro['Resumen']['materia_id']][$registro['Resumen']['seccion_id']][] = $registro;
        }
        $this->set('resumen',$docente);
   } */

/*   public function cargaDocente($impresion = null){
        if($impresion != null){
            $this->layout = "vistaImpresion";
        }else{
            $this->ajaxLayout("ajaxContenido");
        }

//        $this->set('title_for_layout','Carga Horaria Docente');
        $sql = 'SELECT * FROM v_resumen as Resumen WHERE Resumen.docente_id IS NOT NULL AND Resumen.proyecto_id = '.$this->Session->read('Proyecto.id').' ORDER BY Resumen.direccion_id, Resumen.departamento_id, Resumen.materia_id, Resumen.seccion_id, Resumen.dia_numero';
        $resumen = $this->Proyecto->query($sql);
        $docente = null;
        foreach ($resumen as $registro){
            $docente[$registro['Resumen']['docente_id']][$registro['Resumen']['departamento_id']][] = $registro;
        }
        $this->set('resumen',$docente);
   } */
   
} // Fin de ProyectosController




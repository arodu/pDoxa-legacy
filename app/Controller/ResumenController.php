<?php
App::uses('AppController', 'Controller');

class ResumenController extends AppController {

    public $uses = array('Resumen','Asistencia');

    public function view($proyecto_id = null){
        $this->ajaxLayout("ajaxContenido");
        if(!$proyecto_id){
            $proyecto_id = $this->Session->read('Proyecto.id');
        }
        
        $resumen = $this->Resumen->find('agrupacion',array('conditions'=>array('Resumen.Proyecto_id'=>$proyecto_id)));
        $this->set('resumen',$resumen);
    }


    public function lista($proyecto_id=null){

        $this->ajaxLayout("ajaxContenido","vistaImpresion");
        if(!$proyecto_id){ $proyecto_id = $this->Session->read('Proyecto.id'); }

        $results = $this->Resumen->find('agrupacion',array(
            'conditions'=>array('Resumen.Proyecto_id'=>$proyecto_id),
            'order'=>array('Resumen.Materia_nivel','Resumen.Materia_nombre','Resumen.Seccion_nombre','Resumen.Dia_numero','Resumen.Hora_inicio','Resumen.Hora_fin'),
            ));

        if(is_array($results)){
            $aux = null;
            foreach ($results as $result){
                $seccion = null;
                $seccion['Seccion'] = $result['Resumen']['Seccion'];
                //$seccion['Carrera'] = $result['Resumen']['Carrera'];
                //$seccion['Proyecto'] = $result['Resumen']['Proyecto'];
                $seccion['Materia'] = $result['Resumen']['Materia'];
                $seccion['Docente'] = $result['Resumen']['Docente'];

                $encuentro = null;
                $encuentro = $result['Resumen']['Encuentro'];
                $encuentro['Hora'] = $result['Resumen']['Hora'];
                $encuentro['Dia'] = $result['Resumen']['Dia'];
                $encuentro['Aula'] = $result['Resumen']['Aula'];
                $encuentro['TipoAula'] = $result['Resumen']['TipoAula'];
                $encuentro['EncuentrosSeccion'] = $result['Resumen']['EncuentrosSeccion'];

                $aux[$result['Resumen']['Seccion']['id']]['Datos'] = $seccion;
                $aux[$result['Resumen']['Seccion']['id']]['Encuentro'][] = $encuentro;
            }
            $this->set('resumen',$aux);
        }else{
            $this->render('/Elements/noInfo');
        }
        
    }
    
    public function memoCargaDocente($departamento_id = null){

        $this->ajaxLayout("ajaxContenido","vistaImpresion");
        $this->loadModel('Departamento');

        if($departamento_id === null){

            $direcciones = $this->Departamento->Direccion->find('list',array('conditions'=>array('Direccion.area_id'=>$this->Session->read('Proyecto.Area.id'))));
            foreach ($direcciones as $key => $value) {
                $direcciones_alt[] = $key;
            }

            $departamentos = $this->Departamento->find('list',array('conditions'=>array('Departamento.direccion_id'=>$direcciones_alt)));

            $this->set('departamentos', $departamentos);

        }else{
            $this->cargaDocente($departamento_id);

            
            $results = $this->Departamento->find('all',array('recursive'=>0,));

            $departamento = array();
            foreach($results as $result){
                $departamento[$result['Departamento']['id']] = $result;
            }
            $this->set('datosDepartamento',$departamento);
            $this->set('fecha_memo', $this->Session->read('Proyecto.Detalles.fecha_memo'));
        }
        
        $this->set('departamento_id',$departamento_id);
    }

    
    public function cargaDocente($departamento_id = null){
        $this->loadModel('Docente');
        $this->ajaxLayout("ajaxContenido","vistaImpresion");

        $docentes = $this->Docente->find('all',array(
            'conditions'=>array('Docente.area_id'=>$this->Session->read('Proyecto.Area.id'),),
        ));

        if($docentes){
            $aux2 = null;
            foreach($docentes as $docente){

                if(!empty($docente['Seccion'])){
                    $aux = null;
                    $aux['Docente'] = $docente['Docente'];

                    $seccions=null;
                    foreach($docente['Seccion'] as $seccion){
                        $seccions[] = $seccion['id'];
                    }
                    
                    $conditions = array('Resumen.Seccion_id'=>$seccions,'Resumen.Proyecto_id'=>$this->Session->read('Proyecto.id'),);  
                    if($departamento_id != null){
                        $conditions['Resumen.Departamento_id'] = $departamento_id;
                    }

                    $results = $this->Resumen->find('agrupacion',array(
                        'conditions'=>$conditions,
                        'order'=>array('Resumen.Direccion_id','Resumen.Departamento_id','Resumen.Materia_id','Resumen.Seccion_nombre','Resumen.Dia_numero'),
                        'recursive'=>-1,
                    ));

                    if($results){
                        foreach($results as $result){
                                $aux['Departamentos'][$result['Resumen']['Departamento']['id']]['Departamento'] = $result['Resumen']['Departamento'];
                                $aux['Departamentos'][$result['Resumen']['Departamento']['id']]['Direccion'] = $result['Resumen']['Direccion'];

                                $aux['Departamentos'][$result['Resumen']['Departamento']['id']]['EncuentrosSeccions'][$result['Resumen']['EncuentrosSeccion']['id']]['EncuentrosSeccion'] = $result['Resumen']['EncuentrosSeccion'];
                                $aux['Departamentos'][$result['Resumen']['Departamento']['id']]['EncuentrosSeccions'][$result['Resumen']['EncuentrosSeccion']['id']]['Encuentro'] = $result['Resumen']['Encuentro'];
                                $aux['Departamentos'][$result['Resumen']['Departamento']['id']]['EncuentrosSeccions'][$result['Resumen']['EncuentrosSeccion']['id']]['Materia'] = $result['Resumen']['Materia'];
                                $aux['Departamentos'][$result['Resumen']['Departamento']['id']]['EncuentrosSeccions'][$result['Resumen']['EncuentrosSeccion']['id']]['Aula'] = $result['Resumen']['Aula'];
                                $aux['Departamentos'][$result['Resumen']['Departamento']['id']]['EncuentrosSeccions'][$result['Resumen']['EncuentrosSeccion']['id']]['Seccion'] = $result['Resumen']['Seccion'];
                                $aux['Departamentos'][$result['Resumen']['Departamento']['id']]['EncuentrosSeccions'][$result['Resumen']['EncuentrosSeccion']['id']]['Dia'] = $result['Resumen']['Dia'];
                                $aux['Departamentos'][$result['Resumen']['Departamento']['id']]['EncuentrosSeccions'][$result['Resumen']['EncuentrosSeccion']['id']]['Hora'] = $result['Resumen']['Hora'];
                        }
                        $aux2[] = $aux;
                    }
                }
            }
            if($aux2){
                $this->set('resumen',$aux2);
            }else{
                $this->render('/Elements/noInfo');
            }
        }else{
            $this->render('/Elements/noInfo');
        }
    }
    
    public function revisionDocente($docente_id = null){
        $this->loadModel('Docente');
        
        
        if($docente_id){
            $this->ajaxLayout("ajax");
            $this->set('antes',false);
            
        $results =  $this->Resumen->find('all', array(
                        'joins' => array(
                            array(
                                'table' => 'docentes_seccions',
                                'alias' => 'DocenteSeccion',
                                'type' => 'INNER',
                                'conditions' => array(
                                    'DocenteSeccion.docente_id' => $docente_id,
                                    'DocenteSeccion.seccion_id = Resumen.Seccion_id',
                                    'Resumen.Proyecto_id'=>$this->Session->read('Proyecto.id'),
                                )
                            )
                        ),
                        'group' => 'Resumen.EncuentrosSeccion_id'
                    ));
        

                    
        
            // Revision de Choque de Horarios
                    for($i = 0; $i < count($results); $i++){
                        $auxA = $results[$i];
                        $results[$i]['Resumen']['choque']=false;
                        $modalidad = Configure::read('Modalidad');
                        
                        if($results[$i]['Resumen']['Encuentro_modalidad'] == $modalidad['Presencial']['valor'] or $results[$i]['Resumen']['Encuentro_modalidad'] == $modalidad['DistanciaHorario']['valor']){
                            for($j = 0; $j < count($results); $j++){
                                if($j != $i){
                                    $auxB = $results[$j];
                                    if($auxA['Resumen']['Dia_numero'] == $auxB['Resumen']['Dia_numero']){
                                        if((($auxB['Resumen']['Hora_numero_inicio'] >= $auxA['Resumen']['Hora_numero_inicio']) and ($auxB['Resumen']['Hora_numero_inicio'] <= $auxA['Resumen']['Hora_numero_fin'])) or (($auxB['Resumen']['Hora_numero_fin'] >= $auxA['Resumen']['Hora_numero_inicio']) and ($auxB['Resumen']['Hora_numero_fin'] <= $auxA['Resumen']['Hora_numero_fin']))){
                                            $results[$i]['Resumen']['choque']=true;
                                        }
                                    }
                                }
                            }
                        }
                    }

            
            $this->set('cargaHoraria',$results);
            
            $docente = $this->Docente->find('first',array('recursive'=>-1,'conditions'=>array('Docente.id'=>$docente_id)));
            $this->set('docente',$docente);
            
        }else{
            $this->ajaxLayout("ajaxContenido");
            $this->set('antes',true);
            $docentes = $this->Docente->find('list',array('fields'=>array('Docente.id','Docente.nombre_completo'),'conditions'=>array('Docente.area_id'=>$this->Session->read('Proyecto.Area.id'),),'order'=>'Docente.nombre_completo'));
            $this->set('docentes',$docentes);
        }
    }
    
    private function encontrarChoqueHorario($encuentro = array()){
        //$conditions = array('Resumen.Materia_nivel'=>$encuentro['Materia']['nivel'],'Resumen.Seccion_nombre'=>$encuentro['Seccion']['nombre'],'Resumen.Dia_numero'=>$encuentro['Dia']['numero'],'Resumen.Proyecto_id'=>$this->Session->read('Proyecto.id'),'not'=>array('Resumen.EncuentrosSeccion_id'=>$encuentro['EncuentrosSeccion']['id']),);

        $cant = $this->Resumen->find('count',array('recursive'=>-1,
            'conditions'=>array('Resumen.Materia_nivel'=>$encuentro['Materia']['nivel'],'Resumen.Seccion_nombre'=>$encuentro['Seccion']['nombre'],'Resumen.Dia_numero'=>$encuentro['Dia']['numero'],'Resumen.Proyecto_id'=>$this->Session->read('Proyecto.id'),'not'=>array('Resumen.EncuentrosSeccion_id'=>$encuentro['EncuentrosSeccion']['id']),
                'or'=>array(
                        array(
                            'Resumen.Hora_numero_inicio >='=>$encuentro['Hora']['numero_inicio'],
                            'Resumen.Hora_numero_inicio <='=>$encuentro['Hora']['numero_fin'],
                        ),
                        array(
                            'Resumen.Hora_numero_fin >='=>$encuentro['Hora']['numero_inicio'],
                            'Resumen.Hora_numero_fin <='=>$encuentro['Hora']['numero_fin'],
                        ),
                ),
            )));
        if($cant > 0) return true;
        else return false;
    }
    

    public function tabla($nivel = null){
        $this->loadModel('Materia');

        if(!$nivel){
            $this->ajaxLayout("ajaxContenido");
            
            $niveles = $this->Materia->find('all',array(
                        'fields'=>array('Materia.nivel','Pensum.regimen'),
                        'conditions' => array('Materia.pensum_id'=>$this->Session->read('Proyecto.Pensum.id')),
                        'order'=>array('Materia.nivel'),
                        'recursive'=>0,
                        'group'=>'Materia.nivel',
                    ));
            $this->set('niveles',$niveles);
            
            $this->set('observaciones', $this->Session->read('Proyecto.Detalles.observaciones'));

        }else{
                $this->ajaxLayout("ajax","vistaImpresion");

                $results = $this->Resumen->find('agrupacion',array('conditions'=>array('Resumen.Proyecto_id'=>$this->Session->read('Proyecto.id'),'Resumen.Materia_nivel'=>$nivel)));

                if(is_array($results)){
                    $aux = null;
                    foreach ($results as $result){
                        $seccion = null;
                        $seccion['Seccion'] = $result['Resumen']['Seccion'];
                        //$seccion['Carrera'] = $result['Resumen']['Carrera'];
                        //$seccion['Proyecto'] = $result['Resumen']['Proyecto'];
                        $seccion['Materia'] = $result['Resumen']['Materia'];
                        $seccion['Docente'] = $result['Resumen']['Docente'];

                        $encuentro = null;
                        $encuentro = $result['Resumen']['Encuentro'];
                        $encuentro['choque_materia'] = $this->encontrarChoqueHorario($result['Resumen']);
                        $encuentro['Hora'] = $result['Resumen']['Hora'];
                        $encuentro['Dia'] = $result['Resumen']['Dia'];
                        $encuentro['Aula'] = $result['Resumen']['Aula'];
                        $encuentro['TipoAula'] = $result['Resumen']['TipoAula'];
                        $encuentro['EncuentrosSeccion'] = $result['Resumen']['EncuentrosSeccion'];

                        $aux[$result['Resumen']['Seccion']['nombre']][$result['Resumen']['Materia']['id']]['Datos'] = $seccion;
                        $aux[$result['Resumen']['Seccion']['nombre']][$result['Resumen']['Materia']['id']]['Encuentro'][] = $encuentro;
                    }
                    $this->set('resumen',$aux);

                    $materias = $this->Materia->find('all',array(
                        'fields'=>array('Materia.id','Materia.nombre','Materia.avr'),
                        'conditions' => array('Materia.pensum_id'=>$this->Session->read('Proyecto.Pensum.id'), 'Materia.nivel'=>$nivel),
                        'order'=>array('Materia.nombre'),
                        'recursive'=>-1
                    ));
                    $this->set('materias',$materias);

                    $seccions = $this->Materia->Seccion->find('all',array(
                                    'fields'=>array('Seccion.nombre'),
                                    'conditions'=>array('Materia.nivel'=>$nivel,'Seccion.proyecto_id'=>$this->Session->read('Proyecto.id')),
                                    'group'=>array('Seccion.nombre'),
                                    'order'=>array('Seccion.nombre+0'),
                                    'recursive'=>0,
                                ));
                    $this->set('seccions',$seccions);
                    
                    $pensum = $this->Materia->Seccion->Proyecto->Pensum->find('first',array('conditions'=>array('Pensum.id'=>$this->Session->read('Proyecto.Pensum.id')),'recursive'=>-1));
                    $this->set('pensum',$pensum);
                    
                    $this->set('nivel',$nivel);
                }else{
                    $this->render('/Elements/noInfo');
                }        
        }
    }

    public function archivoCsv(){

        $title = str_replace(' ','_','Horario_'.$this->Session->read('Proyecto.Carrera.nombre').'_'.$this->Session->read('Proyecto.lapso_academico').'_('.date("dmyHis").')');
        $title = strtr($title,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');

        $this->set('title_for_layout', $title);

        $resumen = $this->Resumen->find('all',array(
            'conditions'=>array('Resumen.Proyecto_id'=>$this->Session->read('Proyecto.id')),
            'recursive'=>-1,
            ));

            //debug($resumen); die;
        
        if($resumen){
            $this->layout = 'csv';
            $this->set('resumen',$resumen);
        }else{
            $this->ajaxLayout("ajaxContenido");
            $this->render('/Elements/noInfo');
        }
    }

}

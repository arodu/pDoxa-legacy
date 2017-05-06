<?php

App::uses('AppController', 'Controller');

/**
 * Asistencias Controller
 *
 * @property Asistencia $Asistencia
 * @property PaginatorComponent $Paginator
 */
class AsistenciasController extends AppController {

    public $uses = array('Asistencia', 'Resumen', 'DocentesSeccion');

    /**
     * Components
     *
     * @var array
     */
    private function primerElemento($array, $clave = false) {
//debug($array);
//        foreach($array as $key=>$value)
//            if($clave) return $key;
//            else return $value;
        return 1;
    }

    public function planilla($departamento_id = null, $dia_numero = null) {

        $departamentos = $this->Resumen->find('list', array('fields' => array('Resumen.Departamento_id', 'Resumen.Departamento_nombre'), 'conditions' => array('Resumen.Proyecto_id' => $this->Session->read('Proyecto.id'), 'not' => array('Resumen.Departamento_id' => null),), 'group' => 'Resumen.Departamento_id'));
        $this->set('departamentos', $departamentos);

        $dias = $this->Resumen->find('list', array('fields' => array('Resumen.Dia_numero', 'Resumen.Dia_nombre'), 'conditions' => array('Resumen.Proyecto_id' => $this->Session->read('Proyecto.id'), 'not' => array('Resumen.Dia_numero' => null),), 'group' => 'Resumen.Dia_numero'));
        $this->set('dias', $dias);

        if ($this->request->is('post')) {
            $departamento_id = $this->request->data['Resumen']['Departamentos'];
            $dia_numero = $this->request->data['Resumen']['Dias'];
        } else {
            if ($departamento_id == null) {
                $departamento_id = $this->primerElemento($departamento_id, true);
            }
            if ($dia_numero == null) {
                $dia_numero = $this->primerElemento($dias, true);
            }
        }

        $this->set('departamento_id', $departamento_id);
        $this->set('dia_numero', $dia_numero);

        $this->ajaxLayout("ajaxContenido", "vistaImpresion");

        $results = $this->Resumen->find('agrupacion', array(
            'conditions' => array(
                'Resumen.Proyecto_id' => $this->Session->read('Proyecto.id'),
                'Resumen.Dia_numero' => $dia_numero,
                'Resumen.Departamento_id' => $departamento_id,
            ),
            'order' => array('Resumen.Hora_inicio', 'Resumen.Hora_fin', 'Resumen.Materia_nombre', 'Resumen.Seccion_nombre'),
        ));
        if ($results) {
            $this->set('resumen', $results);
        } else {
            $this->render('/Elements/noInfo');
        }
    }

    public function verificar() {
        $this->ajaxLayout("ajaxContenido");
        $fecha = null;

        if ($this->request->is('post')) {
            if (isset($this->request->data['Fecha'])) {

//debug($this->request->data);
// BUSCAR FECHA DIA QUE CORRESPONDA
                $fecha = $this->request->data['Fecha']['fecha'];
                $fecha_sql = $fecha['year'] . '-' . $fecha['month'] . '-' . $fecha['day'];
                $dia_semana['numero'] = date("w", mktime(0, 0, 0, $fecha['month'], $fecha['day'], $fecha['year']));
                $array_dias = array(0 => 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
                $dia_semana['nombre'] = $array_dias[$dia_semana['numero']];
                $dia_semana['fecha'] = $fecha;



                $this->set('dia_semana', $dia_semana);
                $this->set('lista', true);


// BUSCAR LISTADOS
                $results = $this->Resumen->find('agrupacion', array(
                    'conditions' => array(
                        'Resumen.Proyecto_id' => $this->Session->read('Proyecto.id'),
                        'Resumen.Dia_nombre' => $dia_semana['nombre'],
                        'Resumen.Departamento_id' => $this->request->data['Fecha']['departamento_id'],
                    ),
                    'order' => array('Resumen.Hora_inicio', 'Resumen.Hora_fin', 'Resumen.Materia_nombre', 'Resumen.Seccion_nombre'),
                ));

//debug($results); exit();
                $this->set('resumen', $results);

                $encuentroSeccion = null;

                if ($results) {
                    foreach ($results as $encuentro) {
                        $encuentroSeccion[] = $encuentro['Resumen']['EncuentrosSeccion']['id'];
                    }

                    $asistencias = $this->Asistencia->find('all', array(
//'fields'=>array('Asistencia.id','Asistencia.asistio','Asistencia.encuentros_seccion_id'),
                        'recursive' => -1,
                        'conditions' => array(
                            'Asistencia.encuentros_seccion_id' => $encuentroSeccion,
                            'Asistencia.fecha' => $fecha_sql,
                        ),
                    ));

                    $asistencia_aux = null;

                    foreach ($asistencias as $asistencia) {
                        $asistencia_aux[$asistencia['Asistencia']['encuentros_seccion_id']][$asistencia['Asistencia']['docente_id']] = $asistencia;
                    }

//debug($asistencia_aux); exit();
//debug($results);

                    $this->set('asistencias', $asistencia_aux);
                }
            } else {

//debug($this->request->data); exit();
                /*  array(
                  'fecha' => '2014-07-07',
                  'asistio' => array(
                  (int) 0 => array(
                  'asistio' => '1',
                  'encuentros_seccion_id' => '768',
                  'docente_id' => '1'
                  ),
                 */

                $fecha = $this->request->data['fecha'];
                $proyecto_id = $this->Session->read('Proyecto.id');
                $registros = $this->request->data['asistio'];

                $done = true;

                foreach ($registros as $registro) {


                    if (isset($registro['id'])) {
                        $data = array('id' => $registro['id'], 'asistio' => $registro['asistio']);
                    } else {
                        $this->Asistencia->create();
                        $data = array('proyecto_id' => $proyecto_id, 'encuentros_seccion_id' => $registro['encuentros_seccion_id'], 'docente_id' => $registro['docente_id'], 'asistio' => $registro['asistio'], 'fecha' => $fecha,);
                    }

                    if (!$this->Asistencia->save($data)) {
                        $done = false;
                    }
                }

                if ($done == true) {
                    $this->Session->setFlash(__('Datos Guardados Correctamente<br/>Asistencia en la Fecha:' . $fecha));
                } else {
                    $this->Session->setFlash(__('Ha ocurrido un problema guardando los datos'));
                }
            }
        }

        $departamentos = $this->Resumen->find('list', array('fields' => array('Resumen.Departamento_id', 'Resumen.Departamento_nombre'), 'conditions' => array('Resumen.Proyecto_id' => $this->Session->read('Proyecto.id'), 'not' => array('Resumen.Departamento_id' => null),), 'group' => 'Resumen.Departamento_id'));
        $this->set('departamentos', $departamentos);

//$this->set('fecha', $fecha);
    }

    public function reporte() {


        $this->ajaxLayout("ajaxContenido", "vistaImpresion");

        if ($this->request->is('post')) {

            $fecha = $this->request->data['reporte'];


            $fecha['inicio']['sql'] = $this->request->data['reporte']['inicio']['year'] . '-' . $this->request->data['reporte']['inicio']['month'] . '-' . $this->request->data['reporte']['inicio']['day'];
            $fecha['fin']['sql'] = $this->request->data['reporte']['fin']['year'] . '-' . $this->request->data['reporte']['fin']['month'] . '-' . $this->request->data['reporte']['fin']['day'];
            $sql_v = "SELECT `Docente`.`id`,`Docente`.`cedula`,`Docente`.`nombres`,`Docente`.`apellidos`,count(`Cantidad`.`docente_id`) as `cant`
					FROM 
						(SELECT `Asistencia`.`docente_id` FROM `pDoxa_respaldo05112014`.`asistencias` AS `Asistencia`   WHERE `Asistencia`.`fecha` BETWEEN '" . $fecha['inicio']['sql'] . "' AND '" . $fecha['fin']['sql'] . "' AND `Asistencia`.`asistio` = '0' AND `Asistencia`.`proyecto_id` = " . $this->Session->read('Proyecto.id') . "  GROUP BY `Asistencia`.`encuentros_seccion_id`, `Asistencia`.`docente_id`) as Cantidad,
						`docentes` as `Docente`
					WHERE `Docente`.`id` = `Cantidad`.`docente_id`
					GROUP BY `Docente`.`id`,`Docente`.`cedula`,`Docente`.`nombres`,`Docente`.`apellidos`
     				ORDER BY `Docente`.`apellidos`,`Docente`.`nombres`,`Docente`.`cedula`;";

            //debug($sql_v);
//                        debug($sql);
            // dfsdfsdfsdfsdfsdf   

            /* $inasistencias = $this->Asistencia->query("
              SELECT `Docente`.`id`,`Docente`.`cedula`,`Docente`.`nombres`,`Docente`.`apellidos`,count(`Cantidad`.`docente_id`) as `cant`
              FROM
              (SELECT `Asistencia`.`docente_id` FROM `asistencias` AS `Asistencia`   WHERE `Asistencia`.`fecha` BETWEEN \'".$fecha['inicio']['sql']."\' AND \'".$fecha['fin']['sql'].'\' AND `Asistencia`.`asistio` = 0 AND `Asistencia`.`proyecto_id` = '.$this->Session->read('Proyecto.id').'  GROUP BY `Asistencia`.`encuentros_seccion_id`, `Asistencia`.`docente_id`) as Cantidad,
              `docentes` as `Docente`
              WHERE `Docente`.`id` = `Cantidad`.`docente_id`
              GROUP BY `Docente`.`id`,`Docente`.`cedula`,`Docente`.`nombres`,`Docente`.`apellidos`
              ORDER BY `Docente`.`apellidos`,`Docente`.`nombres`,`Docente`.`cedula`;');
             */
            $sub_sql = "SELECT Docente.id AS Docente_id, Docente.cedula, Docente.nombres, "
                    . "Docente.apellidos, Asistencia.encuentros_seccion_id AS Enc_Sec_id, "
                    . "Enc.id AS Encuentro_id, Materia.codigo, Materia.nombre AS Materia_nombre, "
                    . "Seccion.nombre AS Sec_nom, "
                    . "Departamento.id AS Departamento_id, Departamento.nombre AS Departamento_nom, "
                    . "COUNT( Asistencia.asistio ) AS Clases, "
                    . "SUM( Asistencia.asistio ) AS Asist, "
                    . "(COUNT( Asistencia.asistio ) - SUM( Asistencia.asistio )) AS Inasist "
                    . "FROM docentes AS Docente "
                    . "INNER JOIN asistencias AS Asistencia "
                    . "ON Docente.id = Asistencia.docente_id, encuentros_seccions AS Enc_Sec, "
                    . "encuentros AS Enc, materias AS Materia, departamentos AS Departamento, "
                    . "seccions AS Seccion "
                    . "WHERE Asistencia.fecha BETWEEN '" . $fecha['inicio']['sql'] . "' AND '" . $fecha['fin']['sql'] . "' "
                    . "AND Asistencia.proyecto_id = '" . $this->Session->read('Proyecto.id') . "' AND Asistencia.encuentros_seccion_id = Enc_Sec.id "
                    . "AND Enc_Sec.encuentro_id = Enc.id AND Enc.materia_id = Materia.id "
                    . "AND Seccion.id = Enc_Sec.seccion_id "
                    . "AND Materia.departamento_id = Departamento.id "
                    . "GROUP BY Enc_Sec.seccion_id, Materia.id "
                    . "ORDER BY Docente.nombres, Asist";



            //werwerwerwe

            $sql = "SELECT Data . * FROM ("
                    . $sub_sql
                    . ") AS Data WHERE Data.Departamento_id ='" . $this->request->data['reporte']['departamento_id'] . "';";
            //echo $sql;
            $asistencias = $this->Asistencia->query($sql);
            $this->set('fecha', $fecha);
            //debug($asistencias);
            $this->set('asistencias', $asistencias);
        }
        $sql_dep = "SELECT id, nombre FROM departamentos AS Departamentos WHERE direccion_id=1 OR direccion_id=2";
        $departamentos = $this->Asistencia->query($sql_dep);
        foreach ($departamentos as $key => $value) {
            $dep[$value['Departamentos']['id']] = $value['Departamentos']['nombre'];
        }
        $this->set('departamentos', $dep);
    }

    public function reporte2() {


        $this->ajaxLayout("ajaxContenido", "vistaImpresion");

        if ($this->request->is('post')) {

            $fecha = $this->request->data['reporte'];


            $fecha['inicio']['sql'] = $this->request->data['reporte']['inicio']['year'] . '-' . $this->request->data['reporte']['inicio']['month'] . '-' . $this->request->data['reporte']['inicio']['day'];
            $fecha['fin']['sql'] = $this->request->data['reporte']['fin']['year'] . '-' . $this->request->data['reporte']['fin']['month'] . '-' . $this->request->data['reporte']['fin']['day'];

//            $sub_sql="SELECT Docente.id AS Docente_id, Docente.cedula, Docente.nombres, "
//                    . "Docente.apellidos, Asistencia.encuentros_seccion_id AS Enc_Sec_id, "
//                    . "Enc.id AS Encuentro_id, Materia.codigo, Materia.nombre AS Materia_nombre, "
//                    . "Seccion.nombre AS Sec_nom, "
//                    . "Departamento.id AS Departamento_id, Departamento.nombre AS Departamento_nom, "
//                    . "COUNT( Asistencia.asistio ) AS Clases, "
//                    . "SUM( Asistencia.asistio ) AS Asist, "
//                    . "(COUNT( Asistencia.asistio ) - SUM( Asistencia.asistio )) AS Inasist "
//                    . "FROM docentes AS Docente "
//                    . "INNER JOIN asistencias AS Asistencia "
//                    . "ON Docente.id = Asistencia.docente_id, encuentros_seccions AS Enc_Sec, "
//                    . "encuentros AS Enc, materias AS Materia, departamentos AS Departamento, "
//                    . "seccions AS Seccion "
//                    . "WHERE Asistencia.fecha BETWEEN '" . $fecha['inicio']['sql'] . "' AND '" . $fecha['fin']['sql'] . "' "
//                    . "AND Asistencia.proyecto_id = '" . $this->Session->read('Proyecto.id') . "' AND Asistencia.encuentros_seccion_id = Enc_Sec.id "
//                    . "AND Enc_Sec.encuentro_id = Enc.id AND Enc.materia_id = Materia.id "
//                    . "AND Seccion.id = Enc_Sec.seccion_id "
//                    . "AND Materia.departamento_id = Departamento.id "
//                    . "GROUP BY Enc_Sec.seccion_id, Docente_id "
//                    . "ORDER BY Docente.nombres, Asist";
//            
//            
//            
//            //werwerwerwe
//
//            $sql = "SELECT Data . * FROM ("
//                    . $sub_sql
//                    . ") AS Data WHERE Data.Departamento_id ='" . $this->request->data['reporte']['departamento_id'] . "';";
            $sql = "SELECT Data . *, "
                    . "COUNT(Data.Asistio) AS Clases, "
                    . "SUM(Data.Asistio) AS Asist, "
                    . "(COUNT(Data.Asistio)-SUM(Data.Asistio)) AS Inasist  "
                    . "FROM ("
                    . "SELECT Docente.id AS Docente_id, Docente.cedula, Docente.nombres AS nombres, "
                    . "Docente.apellidos, Asistencia.encuentros_seccion_id AS Enc_Sec_id, "
                    . "Enc.id AS Encuentro_id, Materia.codigo, Materia.nombre AS Materia_nombre, "
                    . "Seccion.nombre AS Sec_nom, Departamento.id AS Departamento_id, "
                    . "Departamento.nombre AS Departamento_nom, Asistencia.asistio AS Asistio "
                    . "FROM docentes AS Docente "
                    . "INNER JOIN asistencias AS Asistencia ON Docente.id = Asistencia.docente_id, "
                    . "encuentros_seccions AS Enc_Sec, encuentros AS Enc, materias AS Materia, "
                    . "departamentos AS Departamento, seccions AS Seccion "
                    . "WHERE Asistencia.fecha "
                    . "BETWEEN '" . $fecha['inicio']['sql'] . "' AND '" . $fecha['fin']['sql'] . "' "
                    . "AND Asistencia.proyecto_id = '" . $this->Session->read('Proyecto.id') . "' "
                    . "AND Asistencia.encuentros_seccion_id = Enc_Sec.id AND Enc_Sec.encuentro_id = Enc.id "
                    . "AND Enc.materia_id = Materia.id AND Seccion.id = Enc_Sec.seccion_id "
                    . "AND Materia.departamento_id = Departamento.id ORDER BY Docente.nombres"
                    . ") AS Data "
                    . "WHERE Data.Departamento_id ='" . $this->request->data['reporte']['departamento_id'] . "' "
                    . "GROUP BY Data.Docente_id "
                    . "ORDER BY Data.nombres";
            //echo $sql;
            $asistencias = $this->Asistencia->query($sql);
            $this->set('fecha', $fecha);
            //debug($asistencias);
            $this->set('asistencias', $asistencias);
        }
        $sql_dep = "SELECT id, nombre FROM departamentos AS Departamentos WHERE direccion_id=1 OR direccion_id=2";
        $departamentos = $this->Asistencia->query($sql_dep);
        foreach ($departamentos as $key => $value) {
            $dep[$value['Departamentos']['id']] = $value['Departamentos']['nombre'];
        }
        $this->set('departamentos', $dep);
    }

    public function memo($docente_id = null, $departamento_id = null) {


        $this->ajaxLayout("ajaxContenido", "vistaImpresion");

        if (isset($docente_id) && isset($departamento_id)) {

            $fecha = $this->request->data['reporte'];


            $fecha['inicio']['sql'] = $this->request->data['reporte']['inicio']['year'] . '-' . $this->request->data['reporte']['inicio']['month'] . '-' . $this->request->data['reporte']['inicio']['day'];
            $fecha['fin']['sql'] = $this->request->data['reporte']['fin']['year'] . '-' . $this->request->data['reporte']['fin']['month'] . '-' . $this->request->data['reporte']['fin']['day'];

            $sql = "SELECT Data . *, "
                    . "COUNT(Data.Asistio) AS Clases, "
                    . "SUM(Data.Asistio) AS Asist, "
                    . "(COUNT(Data.Asistio)-SUM(Data.Asistio)) AS Inasist  "
                    . "FROM ("
                    . "SELECT Docente.id AS Docente_id, Docente.cedula, Docente.nombres AS nombres, "
                    . "Docente.apellidos, Asistencia.encuentros_seccion_id AS Enc_Sec_id, "
                    . "Enc.id AS Encuentro_id, Materia.codigo, Materia.nombre AS Materia_nombre, "
                    . "Seccion.nombre AS Sec_nom, Departamento.id AS Departamento_id, "
                    . "Departamento.nombre AS Departamento_nom, Departamento.avr AS Avr, Asistencia.asistio AS Asistio "
                    . "FROM docentes AS Docente "
                    . "INNER JOIN asistencias AS Asistencia ON Docente.id = Asistencia.docente_id, "
                    . "encuentros_seccions AS Enc_Sec, encuentros AS Enc, materias AS Materia, "
                    . "departamentos AS Departamento, seccions AS Seccion "
                    . "WHERE Asistencia.fecha "
                    . "BETWEEN '" . $fecha['inicio']['sql'] . "' AND '" . $fecha['fin']['sql'] . "' "
                    . "AND Asistencia.proyecto_id = '" . $this->Session->read('Proyecto.id') . "' "
                    . "AND Asistencia.encuentros_seccion_id = Enc_Sec.id AND Enc_Sec.encuentro_id = Enc.id "
                    . "AND Enc.materia_id = Materia.id AND Seccion.id = Enc_Sec.seccion_id "
                    . "AND Materia.departamento_id = Departamento.id ORDER BY Docente.nombres"
                    . ") AS Data "
                    . "WHERE Data.Departamento_id ='" . $departamento_id . "' "
                    . "AND Data.Docente_id = '".$docente_id."' "
                    . "GROUP BY Data.Docente_id "
                    . "ORDER BY Data.nombres";
            echo $sql;
            $asistencias = $this->Asistencia->query($sql);
            $this->set('fecha', $fecha);
            //debug($asistencias);
            $this->set('asistencias', $asistencias);
        }
        $sql_dep = "SELECT id, nombre FROM departamentos AS Departamentos WHERE direccion_id=1 OR direccion_id=2";
        $departamentos = $this->Asistencia->query($sql_dep);
        foreach ($departamentos as $key => $value) {
            $dep[$value['Departamentos']['id']] = $value['Departamentos']['nombre'];
        }
        $this->set('departamentos', $dep);
    }

}

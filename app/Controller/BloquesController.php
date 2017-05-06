<?php
App::uses('AppController', 'Controller');
/**
 * Bloques Controller
 *
 * @property Bloque $Bloque
 */
class BloquesController extends AppController {

    public function editEstatus($aula_id){
        
        
        
    }
   
    public  function desasignarSeccion($encuentroSeccion_id){
        $this->Bloque->updateAll(
            array('Bloque.encuentros_seccion_id'=>null),
            array('Bloque.encuentros_seccion_id'=>$encuentroSeccion_id)
        );
    }


    public function asignarSeccion($bloque_id,$encuentroSeccion_id){
        $this->ajaxLayout("ajax");

        //$enter = '\n';
$enter = '
';

        $datosSeccion = $this->Bloque->EncuentrosSeccion->find('first',array(
            'conditions'=>array('EncuentrosSeccion.id'=>$encuentroSeccion_id),
            'fields'=>array('Encuentro.cant_horas','Encuentro.tipo_aula_id','Seccion.id','Seccion.turno_id')
        ));

        $cant_horas = $datosSeccion['Encuentro']['cant_horas'];
      
        $bloque = $this->Bloque->find('first',array('conditions'=>array('Bloque.id'=>$bloque_id)));
      
        $datosBloques = $this->Bloque->find('all',array(
            'conditions'=>array(
                'Bloque.aula_id'=>$bloque['Bloque']['aula_id'],
                'Bloque.dia_id'=>$bloque['Bloque']['dia_id'],
                'Bloque.activo'=>1,
                'OR'=>array(array('Bloque.encuentros_seccion_id'=>null),array('Bloque.encuentros_seccion_id'=>$encuentroSeccion_id)),
                'Hora.numero >='=>$bloque['Hora']['numero']
            ),
            'fields'=>array('Bloque.id','Hora.numero'),
            'order'=>array('Hora.numero'),
            'limit'=>$cant_horas
        ));

        $datosAula = $this->Bloque->Aula->find('first',array(
            'conditions'=>array('Aula.id'=>$bloque['Bloque']['aula_id']),
            'fields'=>array('EsquemaHora.sep_num','Aula.tipo_aula_id')
        ));
        
        $sep_num = $datosAula['EsquemaHora']['sep_num'];
      
        $bloques_guardar = null;
        foreach($datosBloques as $datosbloque){
            $bloques_guardar[] = $datosbloque['Bloque']['id'];
            $bloques_guardar_horas[] = $datosbloque['Hora']['numero'];
        }

//    PRECONDICION VALIDA
      $valido = true;
      $respuesta = '';
      
//    REVISAR RESTRICCIONES OBLIGATORIAS
         if(count($bloques_guardar) != $cant_horas){
            $valido = false;
            $respuesta .= 'Err.ob1: Error en cantidad de Bloques a guardar'.$enter;
         }

        $creciente = true;
        for($i = 0; $i < count($bloques_guardar_horas)-1; $i++){
            if($bloques_guardar_horas[$i]+1 != $bloques_guardar_horas[$i+1]){
                $creciente = false;
            }
        }

        if(!$creciente){
            $valido = false;
            $respuesta .= 'Err.ob2: No se puede guardar la sección en el bloque seleccionado - Cantidad de Bloques Insuficientes'.$enter;
        }
      
        $sep_num;
        $aux = true;
        for($i = 0; $i < count($bloques_guardar_horas); $i++){
            if( $bloques_guardar_horas[$i]==$sep_num and $i!=(count($bloques_guardar_horas)-1) ){
                $aux = false;
            }
        }
        
        if(!$aux){
            $valido = false;
            $respuesta .= 'Err.ob3: No se pueden guardar la seccion entre el intermedio - Cantidad de Bloques insuficientes'.$enter;
        }
//    FIN REVISAR RESTRICCIONES OBLIGATORIAS 
      
      
    // REVISAR RESTRICCIONES 
        if($this->Session->read('Restriccion.tipoAula.valor')){
        // Revisar restriccion de Tipo de Aula
            if($datosSeccion['Encuentro']['tipo_aula_id'] != $datosAula['Aula']['tipo_aula_id']){
                $valido = false;
                $respuesta .= 'Err.res1: El tipo de Aula del encuentro no corresponde al tipo de Aula Actual'.$enter;
            }
        }

        if($this->Session->read('Restriccion.mismoDia.valor')){
        // Revisar restriccion de Tipo de Aula
            if(false){
                $valido = false;
                $respuesta .= 'Err.res1: El tipo de Aula del encuentro no corresponde al tipo de Aula Actual'.$enter;
            }
        }
        

    // FIN REVISAR RESTRICCIONES
      
    // debug($datosBloques);

        if($valido){
            $this->Bloque->updateAll(array('Bloque.encuentros_seccion_id'=>null),array('Bloque.encuentros_seccion_id'=>$encuentroSeccion_id));
            $this->Bloque->updateAll(array('Bloque.encuentros_seccion_id'=>$encuentroSeccion_id),array('Bloque.id'=>$bloques_guardar));
            $respuesta= 'ok';
        }
      $this->set('respuesta',$respuesta);
   }
}

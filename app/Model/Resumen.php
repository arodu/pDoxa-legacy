<?php
App::uses('AppModel', 'Model');
class Resumen extends AppModel {
    
    public $primaryKey = 'EncuentrosSeccion.id';
    public $useTable = 'v_resumen';
    public $findMethods = array('agrupacion' =>  true);


    
    
    private function separarModeloCampo($palabra, $sep='_'){
        $array = explode($sep, $palabra);
        $return[] = array_shift($array);
        $return[] = implode($sep,$array);
        return $return;
    }
    
    protected function _findAgrupacion($state, $query, $results = array()) {

        if($state === 'before') {
            if(!isset($query['recursive'])) $query['recursive'] = $this->recursive;
            return $query;

        }elseif ($state === 'after') {
            $aux = null;

            foreach($results as $result){
                $aux2=null;
                foreach($result as $resumen){
                    foreach($resumen as $clave => $valor){
                        list($modelo, $campo) = $this->separarModeloCampo($clave);
                        $aux2[$modelo][$campo] = $valor;
                    }
                }
                if( (isset($aux2['Seccion']['id'])) && ($query['recursive'] >= 0) ){
                    App::import('Model', 'Seccion');
                    $Seccion = new Seccion();
                    $docente = $Seccion->find('first',array('fields'=>array('Seccion.id'),'conditions'=>array('Seccion.id'=>$aux2['Seccion']['id']),'recursive'=>1,));
                    $aux2['Docente'] = $docente['Docente'];
                }
                $aux[]['Resumen'] = $aux2;
            }

            return($aux);

        }
    } // Fin _findAgrupacion
}

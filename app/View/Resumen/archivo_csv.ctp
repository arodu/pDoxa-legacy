<?php
ini_set('max_execution_time', 300);
ini_set('memory_limit','200M');

    $modalidad = Configure::read('Modalidad');

    $mostrarDocente = true;
    $csv_sep = ";";
    $csv_end = "\n";
    $csv_date = "";
    $csv_time = "";    
    $csv_text = "";  //  $csv_text = "\"";

echo 'asignatura'.$csv_sep;
echo 'carrera'.$csv_sep;
echo 'seccion'.$csv_sep;
echo 'codigo'.$csv_sep;
echo 'dia'.$csv_sep;
echo 'horaInicio'.$csv_sep;
echo 'horaCulminación'.$csv_sep;
echo 'aula'.$csv_sep;
echo 'cupos'.$csv_sep;
echo 'profesor'.$csv_end;

foreach($resumen as $registro){
    if($registro['Resumen']['Encuentro_modalidad'] == $modalidad['Presencial']['valor'] || $registro['Resumen']['Encuentro_modalidad'] == $modalidad['DistanciaHorario']['valor']){
        if($registro['Resumen']['EncuentrosSeccion_id_exist']){
            echo $csv_text.$registro['Resumen']['Materia_nombre'].$csv_text.$csv_sep;
            echo $csv_text.$registro['Resumen']['Carrera_codigo'].$csv_text.$csv_sep;
            echo $csv_text.$registro['Resumen']['Seccion_nombre'].$csv_text.$csv_sep;
            echo $csv_text.$registro['Resumen']['Materia_codigo'].$csv_text.$csv_sep;
            echo $csv_text.$registro['Resumen']['Dia_nombre'].$csv_text.$csv_sep;
            echo $csv_time.date('H:i',strtotime($registro['Resumen']['Hora_inicio'])).$csv_time.$csv_sep;
            echo $csv_time.date('H:i',strtotime($registro['Resumen']['Hora_fin'])).$csv_time.$csv_sep;
            echo $csv_text.$registro['Resumen']['Aula_nombre'].$csv_text.$csv_sep;
            echo $csv_text.$registro['Resumen']['Seccion_cupo'].$csv_text.$csv_sep;
            if(false){ //if($mostrarDocente){
                //echo $csv_text.$registro['Resumen']['docente_nombres'].' '.$registro['Resumen']['docente_apellidos'].$csv_text.$csv_end;
            }else{
                echo $csv_text.''.$csv_text.$csv_end;
            }
        }
   }elseif($registro['Resumen']['Encuentro_modalidad'] == $modalidad['Distancia']['valor'] || $registro['Resumen']['Encuentro_modalidad'] == $modalidad['Pasantia']['valor']){
         echo $csv_text.$registro['Resumen']['Materia_nombre'].$csv_text.$csv_sep;
         echo $csv_text.$registro['Resumen']['Carrera_codigo'].$csv_text.$csv_sep;
         echo $csv_text.$registro['Resumen']['Seccion_nombre'].$csv_text.$csv_sep;
         echo $csv_text.$registro['Resumen']['Materia_codigo'].$csv_text.$csv_sep;
         echo $csv_text.'A DISTANCIA'.$csv_text.$csv_sep;
         echo ''.$csv_sep;
         echo ''.$csv_sep;
         echo ''.$csv_sep;
         echo $csv_text.$registro['Resumen']['Seccion_cupo'].$csv_text.$csv_sep;
         if(false){ //if($mostrarDocente){
            //echo $csv_text.$registro['Resumen']['docente_nombres'].' '.$registro['Resumen']['docente_apellidos'].$csv_text.$csv_end;
         }else{
            echo $csv_text.''.$csv_text.$csv_end;
         }
   }
}

?>
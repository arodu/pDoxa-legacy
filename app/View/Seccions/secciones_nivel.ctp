<?php
   $modalidad = Configure::read('Modalidad');

   $porcenSeccion = 5;
   $porcenMaterias = round(95 / count($materias));

    echo '<span class="no-print">';
        echo '<div class="popup boton">'.$this->Html->link($this->element('icono',array('icono'=>'imprimir','label'=>'Vista de Impresión')), array('controller'=>'seccions','action' => 'seccionesNivel',$nivel,'impresion'),array('escape'=>false)).'</div>';
        echo '<hr/>';
    echo '</span>';

   echo '<table width="100%">';
   echo '<thead>';
      echo '<tr class="no-screen">';
         echo '<td colspan="'.(2+count($materias)).'">';?> 
        <?php echo $this->element('encabezado'); ?>
        <?php
         echo '</td>';
      echo '</tr>';
      echo '<tr class="no-screen">';
         echo '<td colspan="'.(2+count($materias)).'">';
            echo '<h1>Resumen de Horarios Semanales</h1>';
            echo '<h1>'.$nivel.'&deg; '.$pensum['Pensum']['regimen'].'</h1>';
         echo '</td>';
      echo '</tr>';
      echo '<tr>';
         echo '<th width="'.$porcenSeccion.'%">Secci&oacute;n</th>';
         foreach($materias as $materia){
            echo '<th class="materias" width="'.$porcenMaterias.'%">';
            echo '<span class="materia-nombre">'.$materia['Materia']['nombre'].'</span>';
            echo '<span class="materia-avr" style="display:none;">'.$materia['Materia']['avr'].'</span>';
            echo '<span class="no-print ui-icon ui-icon-circle-plus" title="Agregar Nueva Seccion de '.$materia['Materia']['nombre'].'"></span>';
            echo '</th>';
         }
      echo '<tr>';
   echo '</thead>';
   echo '<tbody>';
   if(count($secciones) <= 0){
      echo '<tr>';
      echo '<td colspan="'.(1+count($materias)).'">';
      echo $this->element('alerta',array('mensaje'=>'No existe Secciones','titulo'=>'Alerta'));
      echo '</td>';
      echo '</tr>';
   }else{
      foreach($secciones as $seccion){
         echo '<tr>';
         echo '<td class="secciones" width="'.$porcenSeccion.'%">';
            echo '<div style="font-size:1.5em;">'.$seccion['Seccion']['nombre'].'</div>';
// TURNO            echo '<div style="font-size:0.7em;">turno</div>';
         echo '</td>';

         foreach($materias as $materia){
               if(isset($horarios[$seccion['Seccion']['id']][$materia['Materia']['id']])){
                  echo '<td width="'.$porcenMaterias.'%" class="ui-state-highlight ui-corner-all">';
                  $horario = $horarios[$seccion['Seccion']['id']][$materia['Materia']['id']];
                  if($horario['Seccion']['docente_id']){
                     echo '<div class="docente">';
                     echo '<span class="docente-completo"><strong>'.$horario['Seccion']['docente_nombres'].' '.$horario['Seccion']['docente_apellidos'].'</strong></span>';
                     echo '<span class="docente-min" style="display:none;"><strong>'.substr($horario['Seccion']['docente_nombres'],0,1).'. '.$horario['Seccion']['docente_apellidos'].'</strong></span>';
                     echo '<span class="docente-oculto" style="display:none;">&nbsp;</span>';
                     echo '</div>';
                  }else{
                     echo '<div class="docente ui-state-error">';
                     echo '<span class="docente-completo">Docente no asignado</span>';
                     echo '<span class="docente-min" style="display:none;">Docente: n/a</span>';
                     echo '<span class="docente-oculto" style="display:none;">&nbsp;</span>';
                     echo '</div>';
                  }
                  
                  echo '<div class="encuentros">';
                  foreach($horario['Encuentros'] as $encuentro){

                     if($encuentro['modalidad'] == $modalidad['Presencial']['valor'] || $encuentro['modalidad'] == $modalidad['DistanciaHorario']['valor']){

                        if($encuentro['encuentros_seccion_id']){
                           if($encuentro['choque_materia']){
                                echo '<div style="font-size:0.8em" class="ui-state-highlight">';
                           }else{
                                echo '<div style="font-size:0.8em">';
                           }
                              echo '<span class="dia-comp">'.$encuentro['dia_nombre'].'</span>';
                              echo '<span class="dia-avr" style="display:none;">'.substr($encuentro['dia_nombre'],0,2).'</span>';
                                 echo ': '.$encuentro['aula_nombre'].' / ';
                              echo '<span class="hora-normal">'.date('h:ia',strtotime($encuentro['hora_inicio'])).' - '.date('h:ia',strtotime($encuentro['hora_fin'])).'</span>';
                              echo '<span class="hora-numero" style="display:none;">'.$encuentro['hora_numero_inicio'].' - '.$encuentro['hora_numero_fin'].'</span>';
                              echo '<span class="hora-mil" style="display:none;">'.date('H:i',strtotime($encuentro['hora_inicio'])).' - '.date('H:i',strtotime($encuentro['hora_fin'])).'</span>';
                           echo '</div>';
                        }else{
                           echo '<div class="ui-state-error no-print" style="font-size:0.8em">';
                                 echo '<span class="dia-comp"> Encuentro no Asignado</span>';
                                 echo '<span class="dia-avr" style="display:none;"> Encuentro: n/a</span>';
                           echo '</div>';
                           echo '<div class="no-screen">&nbsp;&nbsp;---</div>';
                        }

                     }elseif($encuentro['modalidad'] == $modalidad['Distancia']['valor']){
                           echo '<div style="font-size:0.8em">';
                              echo '<span class="dia-comp">Distancia: '.$encuentro['cant_horas']. ' horas.</span> ';
                              echo '<span class="dia-avr" style="display:none;">Dist. '.$encuentro['cant_horas']. 'hrs.</span> ';
                           echo '</div>';
                     }elseif($encuentro['modalidad'] == $modalidad['Pasantia']['valor']){
                           echo '<div style="font-size:0.8em">';
                              echo '<span class="dia-comp">Pasantias</span> ';
                              echo '<span class="dia-avr" style="display:none;">Pasantias</span> ';
                           echo '</div>';
                     }else{
                           echo '<div style="font-size:0.8em" class="ui-state-error">';
                              echo '<span>Modalidad N/A</span>';
                           echo '</div>';
                     }

                     
                  }
                  
                        echo '<div class="cupo" style="font-size:0.8em">';
                            echo '<span class="cupo-completo">Cupo: '.$horario['Seccion']['seccion_cupo'].'</span> ';
                            echo '<span class="cupo-oculto" style="display:none;"></span> ';
                        echo '</div>';
                  
                  echo '</div>';

 //  -----------------------------------  Barra de Herramientas "SECCIONES"
                echo '<div class="no-print">';

                        echo '<span class="abrir-formulario">';
                        echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'')), array('action' => 'edit', $horario['Seccion']['seccion_id']), array('escape'=>false, 'title'=>'Modificar Datos de la Sección'));
                        echo '</span>';

//                        echo '<span class="acciones">';
//                        echo $this->Html->link($this->element('icono',array('icono'=>'trash')), array('action' => 'delete', $horario['Seccion']['seccion_id']), array('escape'=>false, 'title'=>'Eliminar Sección','id'=>'borrar'));
//                        echo '</span>';
                      
                echo '</div>';
// ---------------------------------------------------------------------------
                
                echo '</td>';
               }else{
                  echo '<td width="'.$porcenMaterias.'%" class="ui-state-default"></td>';
               }

         }
         echo '<tr>';
      }
   }
   echo '</tbody>';
   echo '</table>';

echo '<div style="display:block; page-break-before:always;"></div>';

//   debug($horarios);
//   debug($materias);
//   debug($secciones);

?>
<?php //  echo $this->element('sql_dump'); ?>
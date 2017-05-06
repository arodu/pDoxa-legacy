<div id="accordionContenido">
	<h3>Activar y/o Desactivar Bloques</h3>
      <div class="aulas form">
         <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
         <div style="border: 1px red solid;">
            <div style="float:left; height: 50px; border: 1px red solid;"><h2><?php echo 'Aula: '.$aula['Aula']['nombre'].' <span style="font-size:small;">('.$aula['TipoAula']['nombre'].')</span>';?></h2>
            </div>
            <div style="float:right; height: 50px; border: 1px red solid;">
               <?php echo $this->Form->submit("Guardar Cambios"); ?>
            </div>
            <div style="clear: both;"></div>
         </div>

            <?php $cantDias = count($dias);
                  $porcenDias = round( 95 / $cantDias );
                  $porcenHoras = 5;
            ?>

            <div id="cuadro" style="clear: both;">
            <table class="ui-widget-content ui-corner-all">
               <thead>
                  <tr>
                     <?php
                     echo '<th colspan="2" width="'.$porcenHoras.'%">Horas</th>';

                        foreach ($dias as $dia){
                           echo '<th class="dias" width="'.$porcenDias.'%">'.$dia['Dia']['nombre'].'</th>';
                        }
                     ?>
                  </tr>
               </thead>
               <tbody>
                  <?php
            //            $cantHoras = count($horas);
            //            debug($dias);
            //            debug($horas);

                        foreach($horas as $hora){
                           echo '<tr>';
                           echo '<td class="horaNum">'.$hora['Hora']['numero'].'</td>';
                           echo '<td class="hora"><div>'.date('h:ia',strtotime($hora['Hora']['inicio'])).'</div>';
                           echo '<div>'.date('h:ia',strtotime($hora['Hora']['fin'])).'</div></td>';
                           foreach($dias as $dia){
                              $hora_id = $hora['Hora']['id'];
                              $dia_id = $dia['Dia']['id'];
                              if(isset($bloques[$hora_id][$dia_id])){
                                 if($bloques[$hora_id][$dia_id]['Bloque']['activo']) $status=' activo'; else $status = ' inactivo';
                                       if(isset($bloques[$hora_id][$dia_id]['Bloque']['EncuentrosSeccion'])){
                                          if($bloques[$hora_id][$dia_id]['Bloque']['EncuentrosSeccion']['id'] == @$bloques[$hora_id-1][$dia_id]['Bloque']['EncuentrosSeccion']['id']){
            //                           echo '<td></td>';
                                          }else{
                                             echo '<td class="ui-state-highlight" rowspan="'.$bloques[$hora_id][$dia_id]['Bloque']['Encuentro']['cant_horas'].'" id="'.$bloques[$hora_id][$dia_id]['Bloque']['id'].'">';
                                             echo '<div id="'.$bloques[$hora_id][$dia_id]['Bloque']['EncuentrosSeccion']['id'].'" style="font-size:smaller;" class="bloque-ocupado ui-state-highlight ui-corner-all">';
                                                echo '<div style="display: block; font-size:small;"><strong>'.$bloques[$hora_id][$dia_id]['Bloque']['Seccion']['Materia']['nombre'].'</strong></div>';
            //                                    echo '<div>Nivel: '.$bloques[$hora_id][$dia_id]['Bloque']['Seccion']['Materia']['nivel'].'</div>';
                                                echo '<div>Secci&oacute;n: '.$bloques[$hora_id][$dia_id]['Bloque']['Seccion']['SeccionDetalle']['nombre'].'</div>';
                                                echo '<div>'.$bloques[$hora_id][$dia_id]['Bloque']['Seccion']['Docente']['nombres'].' '.$bloques[$hora_id][$dia_id]['Bloque']['Seccion']['Docente']['apellidos'].'</div>';
                                             echo '</div>';
                                             echo '</td>';
                                          }
                                       }else{
                                          echo '<td class="bloque-libre ui-state-default '.$status.'" id="'.$bloques[$hora_id][$dia_id]['Bloque']['id'].'">';
                                          echo $this->Form->checkbox($bloques[$hora_id][$dia_id]['Bloque']['id'],array('value'=>$bloques[$hora_id][$dia_id]['Bloque']['activo'], 'hiddenField' => false));
                                          echo '</td>';
                                       }
                              }else{
                                 echo '<td class="ui-state-error">CREAR</td>';
                              }
                           }
                           echo '</tr>';
                           if($hora['Hora']['numero'] == $separacion['EsquemaHora']['sep_num']){
                              echo '<tr><td colspan="'.(2+$cantDias).'"><hr /></td></tr>';
                           }
                        }
                  ?>
               </tbody>   
            </table>
            </div>
            <?php   //     debug($bloques); ?>
         <?php  echo $this->Form->end(); ?>
      </div>
</div>
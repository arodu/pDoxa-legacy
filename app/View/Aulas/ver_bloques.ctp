<?php
    $cantDias = count($dias);
    $porcenDias = round(95/$cantDias);
    $porcenHoras = 5;
//    debug($bloques);
?>
<div class="no-screen">
    <?php echo $this->element('encabezado'); ?>
    <hr />
    <div>
    <h1 style="display: inline;"><?php echo 'Aula: '.$aula['Aula']['nombre'].' <span style="font-size:small;">('.$aula['TipoAula']['nombre'].')</span>';?></h1>
    <?php   if($aula['Ubicacion']['id'] != null){
                echo $aula['Ubicacion']['nombre']." / ".$aula['Ubicacion']['descripcion'];
            }
    ?>
    </div>
</div>

<table class="ui-widget-content ui-corner-all">
    <thead>
        <tr>
            <!-- Horas -->
            <th class="ui-widget-header ui-corner-all" colspan="2" width="<?php echo $porcenHoras.'%'?>">
                <span>Horas</span>
                <!-- <span class="dia-comp">Horas</span> -->
                <!-- <span class="dia-avr" style="display:none;">H.</span>-->
            </th>
            
            <!-- Dias -->
            <?php foreach ($dias as $dia){ ?>
                <th class="dias ui-widget-header ui-corner-all" width="<?php echo $porcenDias.'%'?>">
                    <span><?php echo $dia['Dia']['nombre']?></span>
                    <!-- <span class="dia-comp"><?php echo $dia['Dia']['nombre']?></span>-->
                    <!-- <span class="dia-avr" style="display:none;"><?php echo substr($dia['Dia']['nombre'],0,2)?></span>-->
               </th>
            <?php } ?>
        </tr>
    </thead>
    
    
    <tbody>
      <?php foreach($horas as $hora){ ?>
                <tr>
                    <td class="dias ui-widget-header ui-corner-left">
                            <span><?php echo $hora['Hora']['numero']?></span>
                    </td>
                    <td class="dias ui-widget-header ui-corner-right" style="font-size: .8em">
                            <span class="hora-normal">
                                <div><?php echo date('h:ia',strtotime($hora['Hora']['inicio']))?></div>
                                <div><?php echo date('h:ia',strtotime($hora['Hora']['fin']))?></div>
                            </span>

                            <span class="hora-numero" style="display:none;">-</span>

                            <span class="hora-mil" style="display:none;">
                                <div><?php echo date('H:i',strtotime($hora['Hora']['inicio']))?></div>
                                <div><?php echo date('H:i',strtotime($hora['Hora']['fin']))?></div>
                            </span>
                    </td>
            <?php   $hora_id = $hora['Hora']['id'];
                       foreach($dias as $dia){ 
                            $dia_id = $dia['Dia']['id'];
                            if(isset($bloques[$hora_id][$dia_id])){
                                if($bloques[$hora_id][$dia_id]['Bloque']['activo']) $status=' activo'; else $status = ' inactivo';
                                if(isset($bloques[$hora_id][$dia_id]['Bloque']['EncuentrosSeccion'])){
                                    if($bloques[$hora_id][$dia_id]['Bloque']['EncuentrosSeccion']['id'] == @$bloques[$hora_id-1][$dia_id]['Bloque']['EncuentrosSeccion']['id']){
                                        echo '<td style="display:none;" class="bloque-libre ui-state-default '.$status.'" id="'.$bloques[$hora_id][$dia_id]['Bloque']['id'].'">&nbsp;</td>';
                                    }else{ ?>
                                        <td class="ui-widget-content ui-corner-all seccion-asignada" rowspan="<?php echo $bloques[$hora_id][$dia_id]['Bloque']['Encuentro']['cant_horas'];?>'" id="<?php echo $bloques[$hora_id][$dia_id]['Bloque']['id']; ?>">
                                            
                                            
                                            <div class="bloque-ocupado ui-widget" style="margin-bottom: 6px;" id="<?php echo $bloques[$hora_id][$dia_id]['Bloque']['EncuentrosSeccion']['id']; ?>">

                                                <div class="ui-widget-header ui-corner-top">
                                                <?php echo $this->element('icono',array('icono'=>'draggable','label'=>''));?>
                                                <div style="display: block;" title="<?php echo $bloques[$hora_id][$dia_id]['Bloque']['Seccion']['Materia']['nombre'];?>">

                                                    <!-- Titulo Encuentros -->
                                                    <span class="materia-avr" style="display:none;"><?php echo $bloques[$hora_id][$dia_id]['Bloque']['Seccion']['Materia']['avr'];?></span>
                                                    <span class="materia-nombre"><?php echo $bloques[$hora_id][$dia_id]['Bloque']['Seccion']['Materia']['nombre']?></span>

                                                    <!-- Barra de Herramientas "ENCUENTROS" -->
                                                    <span style="float:right;">
                                                        <?php   echo '<span class="abrir-formulario">';
                                                                echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'')), array('controller'=>'seccions','action' => 'edit', $bloques[$hora_id][$dia_id]['Bloque']['Seccion']['id'],1), array('escape'=>false, 'title'=>'Modificar Datos de la Sección'));
                                                                echo '</span>';
                                                        ?>
                                                        <!-- <a href="#" title="Eliminar Encuentro"><?php echo $this->element('icono',array('icono'=>'eliminar','label'=>''));?></a> -->
                                                    </span>
                                                </div>

                                                </div>

                                                    <div class="ui-widget-content ui-corner-bottom">
                                                        <div style="font-size:smaller;">

                                                            <!-- SECCION -->
                                                            <div>
                                                                <span class="materia-avr" style="display:none;">Sec: </span>
                                                                <span class="materia-nombre"">Secci&oacute;n: </span>
                                                                <?php echo $bloques[$hora_id][$dia_id]['Bloque']['Seccion']['nombre'];?>
                                                            </div>

                                                            <!-- DOCENTES -->
                                                            <?php if(count($bloques[$hora_id][$dia_id]['Bloque']['Seccion']['Docente']) > 0){ ?>
                                                            <?php   foreach($bloques[$hora_id][$dia_id]['Bloque']['Seccion']['Docente'] as $docente){ ?>
                                                                        <div class="docente" style="margin-left:2em;">
                                                                            <span class="docente-completo"><strong><?php echo $docente['nombres'].' '.$docente['apellidos'];?></strong></span>
                                                                            <span class="docente-min" style="display:none;"><strong><?php echo substr($docente['nombres'],0,1).'. '.$docente['apellidos'];?></strong></span>
                                                                            <span class="docente-oculto" style="display:none;"></span>
                                                                        </div>
                                                            <?php   } ?>
                                                            <?php }else{ ?>
                                                                    <div class="docente" style="margin-left:2em;">
                                                                        <span class="docente-completo ui-state-error">Docente no asignado</span>
                                                                        <span class="docente-min ui-state-error" style="display:none;">Docente: n/a</span>
                                                                        <!-- <span class="docente-oculto ui-state-error" style="display:none;"></span>-->
                                                                    </div>
                                                            <?php } ?>

                                                            <!-- CUPO -->
                                                            <div>
                                                                <span class="cupo-completo"><?php echo __('Cupo');?>: <?php echo $bloques[$hora_id][$dia_id]['Bloque']['Seccion']['cupo'];?></span>
                                                                <!-- <span class="cupo-oculto" style="display:none;"></span>-->
                                                            </div>
                                                        </div>
                                                        <div style="clear: both;"></div>
                                                    </div>
                                            </div>
                                        </td>
                            <?php   }
                                }else{ ?>
                                    <td class="bloque-libre ui-widget-header ui-state-disabled ui-corner-all <?php echo $status?>" id="<?php echo $bloques[$hora_id][$dia_id]['Bloque']['id']?>">
                                        <span class="aula_id" style="display:none;"><?php echo $bloques[$hora_id][$dia_id]['Bloque']['aula_id']?></span>
                                        &nbsp;
                                        <span class="no-screen" style="font-size: 7pt;">--------</span>
                                    </td>
                        <?php   }
                            }else{ ?>
                                <td class="ui-state-error ui-corner-all">err.na</td>
                    <?php   }
                        } ?>
                </tr>
        <?php   if($hora['Hora']['numero'] == $separacion['EsquemaHora']['sep_num']){ ?>
                    <tr><td colspan="<?php echo ($cantDias+2)?>"></td></tr>
        <?php   }
            } ?>
   </tbody>
</table>

<div style="display:block; page-break-before:always;" class="no-screen"></div>
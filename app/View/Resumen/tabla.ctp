<?php   if(@$niveles){ ?>
                <div id="tabsContenido">
                    <ul class="no-print">
                    <?php
                        foreach($niveles as $nivel){
                            echo '<li>';
                            echo $this->Html->link($this->element('icono',array('label'=>$nivel['Materia']['nivel'],'icono'=>'document')), '/resumen/tabla/'.$nivel['Materia']['nivel'],array('escape'=>false,'title'=>$nivel['Pensum']['regimen'].' '.$nivel['Materia']['nivel']));
                            echo '</li>';
                        }
                    ?>
                    </ul>
                    <div></div>
                    
                    
                   <div class="mensajeHorario">
                        <?php echo $observaciones;?>
                    </div>
                    
                    
                </div>
<?php   }else{
            $modalidad = Configure::read('Modalidad');
            $porcenSeccion = 5;
            $porcenMaterias = round(95 / count($materias));


                ?>

                    <span class="no-print">
                        <div class="boton popup"><?php echo $this->Html->link($this->element('icono',array('icono'=>'imprimir','label'=>'Vista de Impresión')), '/resumen/tabla/'.$nivel,array('escape'=>false))?></div>
                        <hr/>
                    </span>

                    <table width="100%" class="ui-widget ui-widget-content ui-corner-all">
                        <thead>
                            <tr class="no-screen"><!-- Encabezado -->
                                <td colspan="<?php echo (2+count($materias));?>"><?php echo $this->element('encabezado'); ?></td>
                            </tr>

                            <tr class="no-screen"><!-- Titulo -->
                                <td colspan="<?php echo (2+count($materias));?>">
                                    <h1>Resumen de Horarios Semanales</h1>
                                    <h1><?php echo $nivel.'&deg; '.$pensum['Pensum']['regimen']?></h1>
                                </td>
                            </tr>

                            <tr>
                                <th class="ui-widget-header ui-corner-all" width="<?php echo $porcenSeccion.'%';?>">Secci&oacute;n</th>

                                    <?php   foreach($materias as $materia){ ?>
                                        <th class="materias ui-widget-header ui-corner-all" width="<?php echo $porcenMaterias.'%';?>">
                                            <span class="materia-nombre"><?php echo $materia['Materia']['nombre']?></span>
                                            <span class="materia-avr" style="display:none;"><?php echo $materia['Materia']['avr']?></span>
                                        </th>
                                    <?php   } ?>

                            </tr>
                        </thead>


        <!-- ############### OCULTO ############### -->
                        <tfoot class="no-screen">
                            <tr class="no-print"><!-- Barra de Herramientas en el Pie -->
                                <td style="visibility: hidden;" width="<?php echo $porcenSeccion.'%';?>"></td>
                                    <?php   foreach($materias as $materia){ ?>
                                        <td class="ui-widget-header ui-corner-all" width="<?php echo $porcenMaterias.'%';?>">
                                            <?php echo $this->element('icono',array('icono'=>'agregar','title'=>'Agregar Nueva Sección de '.$materia['Materia']['nombre']));?>
                                            <?php echo $this->element('icono',array('icono'=>'editar','title'=>'Modificar Todos de Cupos de '.$materia['Materia']['nombre']));?>
                                            <!-- <span class="no-print ui-icon ui-icon-circle-plus icono-linea" title="<?php echo 'Agregar Nueva Secci&oacute;n de '.$materia['Materia']['nombre']?>"></span>-->
                                            <!-- <span class="no-print ui-icon ui-icon-pencil icono-linea" title="<?php echo 'Modificar Todos de Cupos de '.$materia['Materia']['nombre']?>"></span> -->
                                        </td>
                                    <?php   } ?>
                            </tr>
                        </tfoot>
        <!-- ############### OCULTO ############### -->



                        <tbody>
                            <?php if(count($seccions) <= 0){ ?>
                                <tr>
                                    <td colspan="<?php echo (1+count($materias))?>">
                                        <?php echo $this->element('alerta',array('mensaje'=>'No existe Secciones','titulo'=>'Alerta'));?>
                                    </td>
                                </tr>
                        <?php }else{ ?>
                            <?php foreach($seccions as $seccion){ ?>
                                <tr>
                                    <td class="secciones ui-widget-header ui-corner-all" width="<?php echo $porcenSeccion.'%';?>">
                                        <div style="font-size:2em;"><?php echo $seccion['Seccion']['nombre']?></div>
                                        <div style="font-size:0.7em;"><!-- turno -->&nbsp;</div>
                                    </td>
                                    <?php foreach($materias as $materia){ ?>
                                        <?php if(isset($resumen[$seccion['Seccion']['nombre']][$materia['Materia']['id']])){ ?>
                                            <td class="ui-widget-content ui-corner-all">
                                                <?php   $docentes = $resumen[$seccion['Seccion']['nombre']][$materia['Materia']['id']]['Datos']['Docente'];
                                                        $encuentros = $resumen[$seccion['Seccion']['nombre']][$materia['Materia']['id']]['Encuentro']; 
                                                        $datosSeccion = $resumen[$seccion['Seccion']['nombre']][$materia['Materia']['id']]['Datos']['Seccion'];

                                                ?>

                                                <!-- DOCENTES -->
                                                <div class="docentes">
                                                <?php if(!empty($docentes)){ ?>
                                                    <?php foreach ($docentes as $docente){ ?>
                                                        <div>
                                                            <span class="docente-completo"><strong><?php echo $docente['nombres'].' '.$docente['apellidos']?></strong></span>
                                                            <span class="docente-min" style="display:none;"><strong><?php echo substr($docente['nombres'],0,1).'. '.$docente['apellidos']?></strong></span>
                                                            <span class="docente-oculto" style="display:none;">&nbsp;</span>
                                                        </div>
                                                    <?php } ?>
                                                <?php }else{ ?>
                                                        <div >
                                                           <span class="docente-completo ui-state-error no-print-v">Docente no asignado</span>
                                                           <span class="docente-min ui-state-error" style="display:none;">Docente: n/a</span>
                                                           <span class="docente-oculto" style="display:none;">&nbsp;</span>
                                                        </div>
                                                <?php } ?>
                                                </div>
                                                <!-- FIN DOCENTES -->


                                                <!-- ENCUENTROS -->
                                                <div class="encuentros">
                                                    <?php foreach ($encuentros as $encuentro){ ?>
                                                        <?php if($encuentro['modalidad'] == $modalidad['Presencial']['valor'] || $encuentro['modalidad'] == $modalidad['DistanciaHorario']['valor']){ ?>
                                                            <?php if($encuentro['EncuentrosSeccion']['id_exist']){ ?>
                                                                                <div style="font-size:0.8em">
                                                                                    <!-- DIAS -->
                                                                                    <span class="dia-comp"><?php echo $encuentro['Dia']['nombre']?></span>
                                                                                    <span class="dia-avr" style="display:none;"><?php echo substr($encuentro['Dia']['nombre'],0,2)?></span>

                                                                                    <!-- AULA -->
                                                                                    <?php echo ': '.$encuentro['Aula']['nombre'].' / ';?>

                                                                                    <!-- HORAS -->
                                                                                    <span class="hora-normal"><?php echo date('h:ia',strtotime($encuentro['Hora']['inicio'])).' - '.date('h:ia',strtotime($encuentro['Hora']['fin']))?></span>
                                                                                    <span class="hora-numero" style="display:none;"><?php echo $encuentro['Hora']['numero_inicio'].' - '.$encuentro['Hora']['numero_fin']?></span>
                                                                                    <span class="hora-mil" style="display:none;"><?php echo date('H:i',strtotime($encuentro['Hora']['inicio'])).' - '.date('H:i',strtotime($encuentro['Hora']['fin']))?></span>

                                                                                    <?php if($encuentro['choque_materia']){ ?>
                                                                                    <!-- CHOQUE DE HORARIOS -->
                                                                                    <span class="no-print" title="Choque de Horarios" style="cursor:pointer;">&CircleTimes;</span>
                                                                                    <?php } ?>

                                                                                </div>
                                                            <?php }else{ ?>
                                                                    <div class="no-print" style="font-size:0.8em">
                                                                        <span class="dia-comp ui-state-error"> Encuentro no Asignado</span>
                                                                        <span class="dia-avr ui-state-error" style="display:none;"> Encuentro: n/a</span>
                                                                    </div>
                                                                    <div class="no-screen" style="font-size:0.8em">&nbsp;&nbsp;Encuentro: n/a</div>
                                                            <?php } ?>

                                                        <?php }else if($encuentro['modalidad'] == $modalidad['Distancia']['valor']){ ?>
                                                                <div style="font-size:0.8em">
                                                                    <span class="dia-comp"><?php echo 'Distancia: '.$encuentro['cant_horas']. ' horas'?></span> 
                                                                    <span class="dia-avr" style="display:none;"><?php echo 'Dist. '.$encuentro['cant_horas']. 'hrs.'?></span>
                                                                </div>

                                                        <?php }elseif($encuentro['modalidad'] == $modalidad['Pasantia']['valor']){ ?>
                                                                <div style="font-size:0.8em">
                                                                    <span class="dia-comp">Pasantias</span>
                                                                    <span class="dia-avr" style="display:none;">Pasantias</span>
                                                                </div>

                                                        <?php }else{ ?>
                                                            <div style="font-size:0.8em" class="ui-state-error">
                                                                <span>Modalidad N/A</span>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                                <!-- FIN ENCUENTROS -->

                                                <!-- CUPOS -->
                                                <div class="cupo" style="font-size:0.8em">
                                                    <span class="cupo-completo"><?php echo 'Cupo: '.$datosSeccion['cupo']?></span>
                                                    <span class="cupo-oculto" style="display:none;"></span>
                                                </div>
                                                <!-- Fin CUPOS -->

                                                <!-- BARRA DE HERRAMIENTAS POR SECCION -->
                                                <div class="herramientas no-print">
                                                    <span class="abrir-formulario">
                                                        <?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'')), array('controller'=>'seccions','action' => 'edit', $datosSeccion['id'],1), array('escape'=>false, 'title'=>'Modificar Datos de la Sección'));?>
                                                    </span>
                                                    <span class="acciones">
                                                        <?php // echo $this->Html->link($this->element('icono',array('icono'=>'trash')), array('action' => 'delete', $horario['Seccion']['seccion_id']), array('escape'=>false, 'title'=>'Eliminar Sección','id'=>'borrar'));?>
                                                    </span>
                                                </div>
                                                <!-- Fin BARRA DE HERRAMIENTAS POR SECCION -->                                        


                                            </td>
                                        <?php }else{ ?>
                                            <td width="<?php echo $porcenMaterias.'%';?>" class="ui-widget-header ui-corner-all ui-state-disabled"></td>
                                        <?php } ?>


                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        <?php } ?>




                        </tbody>
                    </table>

            <!-- Salto de Pagina -->
            <div style="display:block; page-break-before:always;"></div>
        <?php   //debug($seccions);
                //debug($materias);
                //debug($resumen); ?>
<?php   } ?>

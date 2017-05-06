<div id="accordionImpresion">
    <h3 class="no-print"><?php  echo __('Resumen de Horarios Semanales'); ?></h3>
    <div>

        <span class="no-print">
            <div class="boton popup"><?php echo $this->Html->link($this->element('icono',array('icono'=>'imprimir','label'=>'Vista de Impresión')), '/resumen/cargaDocente/',array('escape'=>false))?></div>
            <hr/>
        </span>

    <?php
        $modalidad = Configure::read('Modalidad');
    ?>
    <?php   foreach($resumen as $docente){ ?>
                <div class="no-screen">
                    <?php echo $this->element('encabezado'); ?><br/>
                    <hr />
                    <div>
                        <h1>Horario Semanal de Clases Docente</h1>
                    </div>
                    <span class="no-screen"><br/><br/></span>
                </div>
        
                <div style="font-weight: bold;"><?php echo 'Docente: '.$docente['Docente']['nombre_completo']?></div>
                <br/>
                <?php $total_horas = 0; ?>
                <?php foreach ($docente['Departamentos'] as $departamento){ ?>
                        <div><?php echo 'Direcci&oacute;n: '.$departamento['Direccion']['nombre']?></div>
                        <div><?php echo 'Departamento: '.$departamento['Departamento']['nombre']?></div>
                        <table  style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Unidad Curricular</th>
                                    <th><?php echo $this->Session->read('Proyecto.Pensum.regimen')?></th>
                                    <th>Secci&oacute;n</th>
                                    <th>D&iacute;a</th>
                                    <th>Aula</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fin</th>
                                    <th style="width: 8%">Cant. Horas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $st_horas = 0; ?>
                                <?php  foreach ($departamento['EncuentrosSeccions'] as $encuentro){ ?>
                                    <tr>
                                        <td><?php echo $encuentro['Materia']['nombre']?></td>
                                        <td style="text-align: center"><?php echo $encuentro['Materia']['nivel']?></td>
                                        <td style="text-align: center"><?php echo $encuentro['Seccion']['nombre']?></td>

                                        <?php if($encuentro['Encuentro']['modalidad'] == $modalidad['Distancia']['valor']){ ?>
                                            <td colspan="4">Clase a Distancia</td>
                                        <?php }else if($encuentro['Encuentro']['modalidad'] == $modalidad['Pasantia']['valor']){ ?>
                                            <td colspan="4">Comisión de Pasantias Académicas</td>
                                        <?php }else{ ?>
                                            <?php if($encuentro['EncuentrosSeccion']['id_exist']){ ?>
                                                <td><?php echo $encuentro['Dia']['nombre']?></td>
                                                <td><?php echo $encuentro['Aula']['nombre']?></td>
                                                <td><?php echo date('h:ia',strtotime($encuentro['Hora']['inicio']))?></td>
                                                <td><?php echo date('h:ia',strtotime($encuentro['Hora']['fin']))?></td>
                                            <?php }else{ ?>
                                                <td colspan="4" class="ui-state-error ui-corner-all">#Encuentro no Asignado#</td>
                                            <?php }?>
                                        <?php } ?>
                                        <td style="text-align: center"><?php echo $encuentro['Encuentro']['cant_horas']?></td>
                                        <?php $st_horas += $encuentro['Encuentro']['cant_horas']; ?>
                                        <?php $total_horas += $encuentro['Encuentro']['cant_horas']; ?>
                                    </tr>
                                <?php } ?>
                                    <tr>
                                        <td colspan="7" style="text-align: right;">Subtotal Horas</td>
                                        <td style="width: 8%; text-align: center;"><?php echo $st_horas?></td>
                                    </tr>
                            </tbody>
                        </table>
                        <br/>
                <?php } ?>
                        
            <table  style="width: 100%">
                <thead>
                    <tr>
                        <th style="text-align: right;">Total Horas</th>
                        <th style="width: 8%; text-align: center"><?php echo $total_horas?></th>
                    </tr>
                </thead>
            </table>

                <div style="display:block; page-break-before:always;"></div>
    <?php   } ?>
    <?php // debug($resumen);?>
    </div>
</div>

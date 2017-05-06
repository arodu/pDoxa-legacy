<?php if($antes){ ?>

        <div id="accordionContenido">
            <h3><?php  echo __('Revision Docente'); ?></h3>
            <div>

                <?php echo $this->Form->input('buscarDocente',array('options'=>$docentes,'label'=>'Buscar Docente: ')); ?>
                <hr/>
                <div id="contentDocente"></div>
            </div>
        </div>
        <script> buscarDocente(); </script>
        
<?php }else{ ?>
        <h2><?php echo $this->Html->link($this->element('icono',array('icono'=>'refresh','label'=>$docente['Docente']['cedula'].'&nbsp;&nbsp;'.$docente['Docente']['nombre_completo'])),array('action'=>'revisionDocente',$docente['Docente']['id']),array('id'=>'recargarDocente','escape'=>false,'title'=>'Oprima Aqui para Recargar')); ?></h2>

        <?php $modalidad = Configure::read('Modalidad'); ?>

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
                <?php  foreach ($cargaHoraria as $encuentro){

                        if($encuentro['Resumen']['choque']){
                            echo '<tr class="ui-state-error">';
                        }else{
                            echo '<tr>';
                        }
                    ?>
                        <td><?php echo $encuentro['Resumen']['Materia_nombre']?></td>
                        <td style="text-align: center;"><?php echo $encuentro['Resumen']['Materia_nivel']?></td>
                        <td style="text-align: center;"><?php echo $encuentro['Resumen']['Seccion_nombre']?></td>

                        <?php if($encuentro['Resumen']['Encuentro_modalidad'] == $modalidad['Distancia']['valor']){ ?>
                            <td colspan="4">Clase a Distancia</td>
                        <?php }elseif($encuentro['Resumen']['Encuentro_modalidad'] == $modalidad['Pasantia']['valor']){ ?>
                            <td colspan="4">Comisión de Pasantias Académicas</td>
                        <?php }else{ ?>
                            <?php if($encuentro['Resumen']['EncuentrosSeccion_id_exist']){ ?>
                                <td><?php echo $encuentro['Resumen']['Dia_nombre']?></td>
                                <td><?php echo $encuentro['Resumen']['Aula_nombre']?></td>
                                <td><?php echo date('h:ia',strtotime($encuentro['Resumen']['Hora_inicio']))?></td>
                                <td><?php echo date('h:ia',strtotime($encuentro['Resumen']['Hora_fin']))?></td>
                            <?php }else{ ?>
                                <td colspan="4" class="ui-state-error ui-corner-all">#Encuentro no Asignado#</td>
                            <?php }?>
                        <?php } ?>
                        <td style="text-align: center"><?php echo $encuentro['Resumen']['Encuentro_cant_horas']?></td>
                        <?php $st_horas += $encuentro['Resumen']['Encuentro_cant_horas']; ?>
                    </tr>
                <?php } ?>
                    <tr>
                        <th colspan="7" style="text-align: right;">Total Horas</th>
                        <th style="width: 8%; text-align: center;"><?php echo $st_horas?></th>
                    </tr>
            </tbody>
        </table>
    <script>
    $('#recargarDocente').click(function(){
        cargarContent($(this), '#contentDocente', 'Cargando Datos...');
        return false; 
    });
    </script>
<?php } ?>

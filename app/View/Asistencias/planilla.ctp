<div id="accordionImpresion">
    <h3 class="no-print"><?php  echo __('Asistencia Semanales'); ?></h3>
    <div>
        <span class="no-print">
                <div class="boton popup"><?php echo $this->Html->link($this->element('icono',array('icono'=>'imprimir','label'=>'Vista de Impresión')), '/asistencias/planilla/'.$departamento_id.'/'.$dia_numero,array('escape'=>false))?></div>
            <hr/>
        </span>

        <?php
            $modalidad = Configure::read('Modalidad');
        ?>

        <div class="no-print">
            <?php echo $this->Form->create('Resumen', array('id'=>'formularioAjax')); ?>
                <?php echo $this->Form->input('Departamentos', array('options' => $departamentos, 'selected' => $departamento_id,'class'=>'changeSubmit')); ?>
                <?php echo $this->Form->input('Dias', array('options' => $dias, 'selected' => $dia_numero,'class'=>'changeSubmit')); ?>
            <?php echo $this->Form->end();?>
            <hr/>
        </div>

        <table width="100%">
            <thead>
                <tr>
                    <td colspan="8" class="no-screen">
                        <?php echo $this->element('encabezado'); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <div>
                            <h1>Listado de Asistencia Docente, <strong><?php echo $dias[$dia_numero];?></strong></h1>
                            <h1>Departamento: <strong><?php echo $departamentos[$departamento_id];?></strong></h1>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Docente</th>
                    <th>Materia</th>
                    <th>Seccion</th>
                    <!--<th>Dia</th> -->
                    <th>Bloque de Horas</th>
                    <th>Aula</th>
                    <th width="20%">Firma</th>
                    <th width="30%">Observaciones</th>
                </tr>
            </thead>
        
            <tbody>
                <?php
                foreach($resumen as $registro){
                    if(empty($registro['Resumen']['Docente'])){ ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td><?php echo $registro['Resumen']['Materia']['nombre']?></td>
                            <td><?php echo $registro['Resumen']['Seccion']['nombre']?></td>
                            <!--<td>Dia</td> -->
                            <td><?php echo date('h:ia',strtotime($registro['Resumen']['Hora']['inicio'])).'<br/>'.date('h:ia',strtotime($registro['Resumen']['Hora']['fin']))?></td>
                            <td><?php echo $registro['Resumen']['Aula']['nombre']?></th>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    <?php }else{ 
                        foreach($registro['Resumen']['Docente'] as $docente){ ?>
                            <tr>
                                <td><?php echo $docente['nombres'].'&nbsp;'.$docente['apellidos']?></td>
                                <td><?php echo $registro['Resumen']['Materia']['nombre']?></td>
                                <td><?php echo $registro['Resumen']['Seccion']['nombre']?></td>
                                <!--<td>Dia</td> -->
                                <td><?php echo date('h:ia',strtotime($registro['Resumen']['Hora']['inicio'])).'<br/>'.date('h:ia',strtotime($registro['Resumen']['Hora']['fin']))?></td>
                                <td><?php echo $registro['Resumen']['Aula']['nombre']?></th>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        <?php }
                    }
                }
                //debug($resumen);
                ?>
            </tbody>
        </table>
    </div>
</div>
<div id="accordionContenido">
    <h3>Verificación de Asistencia</h3>
    <div>

        <?php echo $this->Form->create('Fecha', array('id' => 'formularioAjax')); ?>
        <?php echo $this->Form->input('fecha', array('type' => 'date')); ?>
        <?php echo $this->Form->input('departamento_id', array('options' => $departamentos, 'label' => 'Departamento')); ?>
        <?php echo $this->Form->end('Buscar'); ?>

        <?php if (isset($lista)) { ?>

            <hr/>

            <h2><?php echo $dia_semana['nombre'] . ', ' . $dia_semana['fecha']['day'] . '/' . $dia_semana['fecha']['month'] . '/' . $dia_semana['fecha']['year'] . ''; ?></h2>

            <?php
            if ($resumen == null) {
                echo $this->element('noInfo');
            } else {
                ?>

        <?php echo $this->Form->create('RegistroAsistencia', array('id' => 'formularioAjax')); ?>


                <?php
                // GUARDAR FECHA EN FORMULARIO
                echo $this->Form->input('fecha', array('type' => 'hidden', 'name' => 'fecha', 'value' => $dia_semana['fecha']['year'] . '-' . $dia_semana['fecha']['month'] . '-' . $dia_semana['fecha']['day']));
                ?>

        <?php echo $this->Form->submit('Guardar Datos'); ?>
                <div id="checkRegistroAsistencias" class="seleccionar_checks">


                    <?php echo $this->Form->checkbox('checkTodos', array('type' => 'checkbox', 'class' => 'seleccionar_todos')); ?>
        <?php echo $this->Form->label('checkTodos', 'Seleccionar Todos'); ?>

                    <span class="boton">
        <?php echo $this->Html->link($this->element('icono', array('icono' => 'transferthick-e-w', 'label' => 'Invertir Selección')), '#', array('class' => 'invertir_seleccion', 'escape' => false)); ?>
                    </span>

        <?php //debug($asistencias); ?>


                    <table>
                        <tr>
                            <th>
                                Asistio?

                            </th>
                            <th>Docente</th>
                            <th>Materia</th>
                            <th>Seccion</th>
                            <!--<th>Dia</th> -->
                            <th>Bloque de Horas</th>
                            <th>Aula</th>
                        </tr>
                        <?php $i = 0; ?>
                        <?php foreach ($resumen as $registro) { ?>
                            <?php if (!empty($registro['Resumen']['Docente'])) { ?>
                <?php foreach ($registro['Resumen']['Docente'] as $docente) { ?>
                                    <tr id="<?php echo 'trlf_' . $registro['Resumen']['EncuentrosSeccion']['id'] ?>" class="tr_label_for">
                                        <td>

                                            <?php // echo $this->Form->input('check',array('type'=>'checkbox','label'=>false));?>
                                            <?php
                                            //if($asistencias){

                                            /* (int) 790 => array(
                                              'Asistencia' => array(
                                              'id' => '790',
                                              'asistio' => true,
                                              'encuentros_seccion_id' => '790'
                                              ) */


                                            if (isset($asistencias[$registro['Resumen']['EncuentrosSeccion']['id']][$docente['id']])) {


                                                $asistencia = $asistencias[$registro['Resumen']['EncuentrosSeccion']['id']][$docente['id']];
                                                //debug($asistencia); exit();

                                                echo $this->Form->checkbox('asistio', array(
                                                    'name' => 'asistio[' . $i . '][asistio]',
                                                    'id' => 'asistio_' . $registro['Resumen']['EncuentrosSeccion']['id'],
                                                    /* ,'value'=>$ubicacionId, */
                                                    'class' => 'ck',
                                                    'checked' => $asistencia['Asistencia']['asistio'],
                                                ));

                                                echo $this->Form->hidden('asistio_id', array(
                                                    'name' => 'asistio[' . $i . '][id]',
                                                    'value' => $asistencia['Asistencia']['id'],
                                                ));

                                                echo $this->Form->hidden('asistio_encuentros_seccion_id', array(
                                                    'name' => 'asistio[' . $i . '][encuentros_seccion_id]',
                                                    'value' => $registro['Resumen']['EncuentrosSeccion']['id'],
                                                ));

                                                echo $this->Form->hidden('asistio_docente_id', array(
                                                    'name' => 'asistio[' . $i . '][docente_id]',
                                                    'value' => $docente['id'],
                                                ));
                                            } else {

                                                echo $this->Form->checkbox('asistio', array(
                                                    'name' => 'asistio[' . $i . '][asistio]',
                                                    'id' => 'asistio_' . $registro['Resumen']['EncuentrosSeccion']['id'],
                                                    'class' => 'ck',
                                                ));

                                                echo $this->Form->hidden('asistio_encuentros_seccion_id', array(
                                                    'name' => 'asistio[' . $i . '][encuentros_seccion_id]',
                                                    'value' => $registro['Resumen']['EncuentrosSeccion']['id'],
                                                ));

                                                echo $this->Form->hidden('asistio_docente_id', array(
                                                    'name' => 'asistio[' . $i . '][docente_id]',
                                                    'value' => $docente['id'],
                                                ));

                                                //echo $this->Form->checkbox('asistio',array(
                                                //	'name'=>'asistio['.$registro['Resumen']['EncuentrosSeccion']['id'].'][asistio]',
                                                //	'id'=>'asistio_'.$registro['Resumen']['EncuentrosSeccion']['id'],
                                                /* ,'value'=>$ubicacionId, */
                                                //	'class'=>'ck',
                                                //'checked'=>$asistencias[$registro['Resumen']['EncuentrosSeccion']['id']]
                                                //	));
                                            }
                                            ?>
                                        </td>

                                        <td><?php echo $docente['nombres'] . '&nbsp;' . $docente['apellidos'] ?></td>
                                        <td><?php echo $registro['Resumen']['Materia']['nombre'] ?></td>
                                        <td><?php echo $registro['Resumen']['Seccion']['nombre'] ?></td>
                                        <!--<td>Dia</td> -->
                                        <td><?php echo date('h:ia', strtotime($registro['Resumen']['Hora']['inicio'])) . '<br/>' . date('h:ia', strtotime($registro['Resumen']['Hora']['fin'])) ?></td>
                                        <td><?php echo $registro['Resumen']['Aula']['nombre'] ?></th>
                                    </tr>
                    <?php $i++; ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </table>
                </div>

        <?php //echo $this->Form->submit('Guardar y Continuar Editando');  ?>
                <?php echo $this->Form->submit('Guardar Datos'); ?>

                <?php echo $this->Form->end(); ?>
                <?php
            }
        }
        ?>

    </div>
</div>
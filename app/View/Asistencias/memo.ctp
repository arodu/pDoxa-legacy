<?php ?>

<style>
    .memo{
        /* Font family tamaño de letra*/
    }
    .memoHeader span.ant{
        width: 2cm;
        display: inline-block;
    }
    .memoContent p{
        text-indent: 4em;
        text-align: justify;
    }
    .memoFoot p{
        text-align: center;
    }
</style>
<?php
//$modalidad = Configure::read('Modalidad');
?>
<?php foreach ($asistencias['Data'] as $data) { ?>
    <div class="memo">
        <?php echo $this->element('encabezado', array('tipo' => 2)); ?>
        <br/><br/>
        <div style="clear: both;"></div>
        <br/><br/>
        <div><?php echo $data['avr'] . '/AIS.-'; ?></div>
        <div class="memoHeader">
            <p> <span class="ant">PARA:</span><span class="des"><?php echo 'Prof. ' . $docente['nombres'].' '.$docente['apellidos'] ?></span></p>
            <p> <span class="ant">DE:</span><span class="des">Prof. </span><br/>
                <span class="ant"></span><span class="des"><?php echo 'Departamento de ' . $data['Departamento_nom'] ?></span>
            </p>
            <p> <span class="ant">FECHA:</span><span class="des"><?php
                    //echo 'Viernes, 1 de Agosto de 2014';
                    echo date('d/m/Y', strtotime($fecha_memo));
                    ?></span></p>
            <p> <span class="ant">ASUNTO:</span><span class="des"><?php echo 'En el texto' ?></span></p>
        </div>
        <br/>
        <div class="memoContent">
            <p>Me es grato dirigirme a Usted a fin de darle una calurosa bienvenida al per&iacute;odo lectivo <?php echo $this->Session->read('Proyecto.lapso_academico') ?>, deseando que una vez m&aacute;s, podamos unir esfuerzos para garantizar el buen desarrollo de las actividades en beneficio de la Comunidad Universitaria.</p>
            <p>As&iacute; mismo tambi&eacute;n, hacer entrega formal de la Carga Horario Acad&eacute;mica respectiva, la cual esta distribuida de la siguiente manera:</p>
            <table  style="width: 100%">
                <thead>
                    <tr>
                        <th>Unidad Curricular</th>
                        <th></th>
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
                    <?php foreach ($data as $encuentro) { ?>
                        <tr>
                            <td><?php echo $encuentro['Clases'] ?></td>
                            <td style="text-align: center"><?php echo $encuentro['Materia']['nivel'] ?></td>
                            <td style="text-align: center"><?php echo $encuentro['Seccion']['nombre'] ?></td>

                            <?php if ($encuentro['Encuentro']['modalidad'] == $modalidad['Distancia']['valor']) { ?>
                                <td colspan="4">Clase a Distancia</td>
                            <?php } else { ?>
                                <?php if ($encuentro['EncuentrosSeccion']['id_exist']) { ?>
                                    <td><?php echo $encuentro['Dia']['nombre'] ?></td>
                                    <td><?php echo $encuentro['Aula']['nombre'] ?></td>
                                    <td><?php echo date('h:ia', strtotime($encuentro['Hora']['inicio'])) ?></td>
                                    <td><?php echo date('h:ia', strtotime($encuentro['Hora']['fin'])) ?></td>
                                <?php } else { ?>
                                    <td colspan="4" class="ui-state-error ui-corner-all">#Encuentro no Asignado#</td>
                                <?php } ?>
                            <?php } ?>
                            <td style="text-align: center"><?php echo $encuentro['Encuentro']['cant_horas'] ?></td>
                            <?php $st_horas += $encuentro['Encuentro']['cant_horas']; ?>
                            <?php // $total_horas += $encuentro['Encuentro']['cant_horas']; ?>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="7" style="text-align: right;">Total Horas</td>
                        <td style="width: 8%; text-align: center;"><?php echo $st_horas ?></td>
                    </tr>

                </tbody>

            </table>
            <p>Sin mas a que hacer referencia y deseando mucho &eacute;xito en su desempe&ntilde;o acad&eacute;mico, se despide.</p>
        </div>
        <br/><br/>
        <div class="memoFoot">
            <p>Atentamente,</p>
            <br/><br/><br/><br/><br/><br/>
            <p><?php echo 'Prof. ' . $datosDepartamento[$departamento_id]['Docente']['nombre_completo'] ?></p>
            <p><?php echo 'Jefe del Departamento de ' . $datosDepartamento[$departamento_id]['Departamento']['nombre'] ?></p>
        </div>
    </div>
    <div style="display:block; page-break-before:always;"></div>
    <?php
}
?>
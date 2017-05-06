
<div id="accordionImpresion">
    <h3 class="no-print"><?php echo __('Reporte de Asistencias'); ?></h3>
    <div>

        <div class="no-print">
            <?php
            echo $this->Form->create('reporte', array('id' => 'formularioAjax'));
            echo $this->Form->input('departamento_id', array('options' => $departamentos, 'label' => 'Departamento'));
            echo $this->Form->input('inicio', array('label' => 'Fecha de Inicio', 'type' => 'date'));
            echo $this->Form->input('fin', array('label' => 'Fecha de Finalización', 'type' => 'date'));
            echo $this->Form->submit('Buscar');
            echo $this->Form->end();
            ?>
        </div>

        <?php if (isset($asistencias)) { ?>

            <hr class="no-print">

            <table width="100%" id="asistencia">
                <thead>
                    <tr>
                        <td colspan="5" class="no-screen">
                            <?php echo $this->element('encabezado'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="10">
                            <div>
                                <?php echo '<h1>Listado de Asistencia Docente</h1>'; ?>
                                <?php echo "<h1>Departamento de ".$asistencias[0]['Data']['Departamento_nom']." </h1>"; ?>
                                <?php echo '<h1>desde la Fecha ' . $fecha['inicio']['day'] . '/' . $fecha['inicio']['month'] . '/' . $fecha['inicio']['year'] . ' hasta ' . $fecha['fin']['day'] . '/' . $fecha['fin']['month'] . '/' . $fecha['fin']['year'] . '</h1>'; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Asignatura</th>
                        <th>Sección</th>
                        <th>Encuentros</th>
                        <th>Asist.</th>
                        <th>Inasist.</th>
                        <th>% Asist.</th>
                        <th>Memo</th>
                    </tr>
                </thead>

                <tbody>
                <style>
                    .valor{
                        text-align: center;
                        font-weight: bold;
                    }
                </style>
                    <?php $i = 1; ?>
                    <?php 
                    foreach ($asistencias as $docente) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $docente['Data']['nombres']; ?></td>
                            <td><?php echo $docente['Data']['apellidos']; ?></td>
                            <td><?php echo $docente['Data']['Materia_nombre']; ?></td>
                            <td><?php echo $docente['Data']['Sec_nom']; ?></td>
                            <td class="valor"><?php echo $docente['Data']['Clases']; ?></td>
                            <td class="valor"><?php echo $docente['Data']['Asist']; ?></td>
                            <td class="valor"><?php echo $docente['Data']['Inasist']; ?></td>
                            <td class="valor"><?php echo number_format((100*$docente['Data']['Asist'])/$docente['Data']['Clases'],2,',','.'); ?></td>
                            <td>
                                <button class="btn btn-danger">Print</button>
                            </td>
                        </tr>				
                    <?php } ?>
                </tbody>

            </table>
        <?php } ?>
    </div>
</div>
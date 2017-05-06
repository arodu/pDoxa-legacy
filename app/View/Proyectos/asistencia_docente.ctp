<style>
    @page {
        size: letter landscape; 
    }
</style>
<div id="accordionImpresion">
	<h3 class="no-print">Asistencia Docente</h3>
        <div>
        <span class="no-print">
        <div class="popup boton"><?php echo $this->Html->link($this->element('icono',array('icono'=>'imprimir','label'=>'Vista de Impresión')), array('controller'=>'proyectos','action' => 'asistenciaDocente',1,1,1),array('escape'=>false)); ?></div>
        <hr/>
        </span>
<?php
   $modalidad = Configure::read('Modalidad');

   $dia = $resumen[0]['Resumen']['dia_nombre'];
   $dia_numero = $resumen[0]['Resumen']['dia_numero'];
   $direccion = $resumen[0]['Resumen']['direccion_nombre'];
   $direccion_id = $resumen[0]['Resumen']['direccion_id'];
//   debug($resumen);
?>
<div class="no-print">
        <?php echo $this->Form->create('Proyecto', array('id'=>'formularioAjax')); ?>
            <?php echo $this->Form->input('Direcciones', array('options' => $direccions, 'selected' => $direccion_id,'class'=>'changeSubmit')); ?>
            <?php echo $this->Form->input('Dias', array('options' => $dias, 'selected' => $dia_numero,'class'=>'changeSubmit')); ?>
        <?php // echo $this->Form->end(__('Buscar'));?>
        <?php echo $this->Form->end();?>
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
                        <h1>Listado de Asistencia Docente, <strong><?php echo $dia;?></strong></h1>
                        <h1>Direcci&oacute;n: <strong><?php echo $direccion;?></strong></h1>
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
            echo '<tr>';
                echo '<td>';                
                     echo '<span class="docente-completo">'.$registro['Resumen']['docente_nombres'].'&nbsp;'.$registro['Resumen']['docente_apellidos'].'</span>';
                     echo '<span class="docente-min" style="display:none;">'.substr($registro['Resumen']['docente_nombres'],0,1).'.&nbsp;'.$registro['Resumen']['docente_apellidos'].'</span>';
                     echo '<span class="docente-oculto" style="display:none;">&nbsp;</span>';
                echo '</td>';

                echo '<td>&nbsp;';
                    echo '<span class="materia-nombre">'.$registro['Resumen']['materia_nombre'].'</span>';
                    echo '<span class="materia-avr" style="display:none;">'.$registro['Resumen']['materia_avr'].'</span>';         
                echo '</td>';
                echo '<td>&nbsp;'.$registro['Resumen']['seccion_nombre'].'</td>';
//                echo '<td>&nbsp;'.$registro['Resumen']['dia_nombre'].'</td>';
                echo '<td>';
                        echo '<span class="hora-normal">'.date('h:ia',strtotime($registro['Resumen']['hora_inicio'])).'<br />'.date('h:ia',strtotime($registro['Resumen']['hora_fin'])).'</span>';
                        echo '<span class="hora-numero" style="display:none;">'.$registro['Resumen']['hora_numero_inicio'].' - '.$registro['Resumen']['hora_numero_fin'].'</span>';
                        echo '<span class="hora-mil" style="display:none;">'.date('H:i',strtotime($registro['Resumen']['hora_inicio'])).'<br />'.date('H:i',strtotime($registro['Resumen']['hora_fin'])).'</span>';
//                    echo date('h:i a',strtotime($registro['Resumen']['hora_inicio'])).'<br />'.date('h:i a',strtotime($registro['Resumen']['hora_fin']));                
                echo '</td>';
                echo '<td><div style="display: block">'.$registro['Resumen']['aula_nombre'].'&nbsp;</div></td>';
                echo '<td>&nbsp;</td>';
                echo '<td>&nbsp;</td>';
            echo '</tr>';
        }

?>            
    
    </tbody>
</table>

        </div>
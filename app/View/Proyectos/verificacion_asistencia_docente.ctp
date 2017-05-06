<?php
   $modalidad = Configure::read('Modalidad');
//   debug($modalidad);
?>
<table width="100%">
    <thead>
        <tr>
            <td colspan="4"><?php echo $this->element('encabezado'); ?></td>
        </tr>
        <tr>
            <th>No.</th>
            <th>Unidad Curricular</th>
            <th>Secci&oacute;n</th>
            <th>Docente</th>
            <?php for($i=0; $i<$num_semanas;$i++){
                echo '<th>Semana '.($i+1).'</th>';
            } ?>
        </tr>
    </thead>
    <tbody>
        
        
        
        
    </tbody>
</table>




<style>
/*    div{border: 1px solid red;}     */
</style>

    <div style="position: fixed; top: 0pt; width: 100%">
         <?php echo $this->element('encabezado'); ?>
            <hr />
          <div>
          <h1>Horario Semanal de Clases del Docente</h1>
          </div>
    </div>

<?php
    foreach($resumen as $docente){
        $cthoras = 0;
        echo '<div style="position:relative; top: 5cm; overflow: auto;">';
        echo 'Profesor: '.$docente[0]['Resumen']['docente_nombres'].' '.$docente[0]['Resumen']['docente_apellidos'].'<br />';
        echo 'Periodo: '.$this->Session->read('Proyecto.lapso_academico').'<br /><br /><br />';
        echo '<table width="100%">';
        echo '<tr style="font-weight: bold;">';
        echo '<td>Unidad Curricular</td>';
        echo '<td>Semestre</td>';
        echo '<td>Secci&oacute;n</td>';
        echo '<td>D&iacute;a</td>';
        echo '<td>Aula</td>';
        echo '<td>Hora Inicio</td>';
        echo '<td>Hora Fin</td>';
        echo '<td>Cant. Horas</td>';
        echo '</tr>';

        foreach ($docente as $materia){
                echo '<tr>';
                echo '<td>'.$materia['Resumen']['materia_nombre'].'</td>';
                echo '<td style="text-align: center;">'.$materia['Resumen']['materia_nivel'].'</td>';
                echo '<td style="text-align: center;">'.$materia['Resumen']['seccion_nombre'].'</td>';
                
                if($materia['Resumen']['encuentro_modalidad'] == $modalidad['Distancia']['valor']){
                    echo '<td colspan="4">Educaci&oacute;n a Distancia</td>';
                }else{
                    echo '<td>'.$materia['Resumen']['dia_nombre'].'</td>';
                    echo '<td>'.$materia['Resumen']['aula_nombre'].'</td>';
                    echo '<td>'.date("h:i a",strtotime($materia['Resumen']['hora_inicio'])).'</td>';
                    echo '<td>'.date("h:i a",strtotime($materia['Resumen']['hora_fin'])).'</td>';
                }
                
                echo '<td style="text-align: center;">'.$materia['Resumen']['encuentro_cant_horas'].'</td>';
                echo '</tr>';
                $cthoras += $materia['Resumen']['encuentro_cant_horas'];
        }
        echo '<tr>';
        echo '<td colspan="7" style="text-align: right;">Total Horas</td>';
        echo '<td style="text-align: center;">'.$cthoras.'</td>';
        echo '</tr>';
        
        echo '</table>';
        echo '</div>';
        echo '<div style="display:block; page-break-before:always;"></div>';
    }

?>

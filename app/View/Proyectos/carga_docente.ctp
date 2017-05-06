<style>
    @page {
        size: letter portrait;
    }
</style>

<div id="accordionImpresion">
	<h3 class="no-print">Carga Horaria Docente</h3>
        <div>
        <span class="no-print">
        <div class="popup boton"><?php echo $this->Html->link($this->element('icono',array('icono'=>'imprimir','label'=>'Vista de Impresión')), array('controller'=>'proyectos','action' => 'cargaDocente',1),array('escape'=>false)); ?></div>
        </span>
<?php
   $modalidad = Configure::read('Modalidad');
//   debug($modalidad);
   
   

    function array_primero($matriz){
        foreach ($matriz as $key => $valor)
        return $valor;
    }   
   
?>

<?php
    //debug($resumen);

    foreach($resumen as $docente){
//        debug($docente);
        ?>
        <div class="no-screen">
            <?php echo $this->element('encabezado'); ?><br/>
            <hr />
            <div>
                <h1>Horario Semanal de Clases del Docente</h1>
            </div>
            <span class="no-screen"><br/><br/></span>
        </div>
            <?php
        
        echo '<div>';
        
        echo '<span class="no-print"><br/><br/><hr/></span>';
        
        $i = 0;
        
        $primero = current(current($docente));
        
//        debug($primero);
        
        echo 'Docente: <strong>'.$primero['Resumen']['docente_nombres'].' '.$primero['Resumen']['docente_apellidos'].'</strong><br />';
        //echo 'Cedula: '.$primero['Resumen']['docente_cedula'].'<br />';
        echo 'Periodo: '.$this->Session->read('Proyecto.lapso_academico').'<br /><br />';
        
        $cthoras = 0;

        foreach($docente as $departamento){
            $primero = current($departamento);
            echo 'Direcci&oacute;n: '.$primero['Resumen']['direccion_nombre'].'<br />';
            echo 'Departamento: '.$primero['Resumen']['departamento_nombre'].'<br />';
            
            
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

            $departamento_id_anterior = $departamento[$i]['Resumen']['departamento_id'];
            
            $sthoras = 0;
            foreach ($departamento as $materia){
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
                    $sthoras += $materia['Resumen']['encuentro_cant_horas'];
                    $cthoras += $materia['Resumen']['encuentro_cant_horas'];        
                    
            }

            echo '<tr>';
            echo '<td colspan="7" style="text-align: right;">Cantidad de Horas</td>';
            echo '<td style="text-align: center;">'.$sthoras.'</td>';
            echo '</tr>';
            
            echo '</table>';
            echo '<br/>';
            
        }
        echo 'Total de Horas: '.$cthoras.'<br />';
        
        echo '</div>';
        echo '<div style="display:block; page-break-before:always;"></div>';
    }
/**/
?>
        </div>
</div>
<div id="accordionImpresion">
    <h3 class="no-print"><?php  echo __('Horarios de Clases Semanales'); ?></h3>
    <div>
        
        <span class="no-print">
            <div class="boton popup"><?php echo $this->Html->link($this->element('icono',array('icono'=>'imprimir','label'=>'Vista de Impresión')), '/resumen/lista/',array('escape'=>false))?></div>

            <!-- <div class="boton irContent"><?php echo $this->Html->link($this->element('icono',array('icono'=>'ui-icon-refresh','label'=>'asdasdd')), '/resumen/lista/',array('escape'=>false))?></div> -->

            <?php // echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-extlink'))."Lista de Horarios",'/resumen/lista',array('escape'=>false)).'</li>'; ?>

            <hr/>
        </span>
        
        <?php $modalidad = Configure::read('Modalidad'); ?>
    
        <table style="width: 100%;">
            <thead>
                <tr class="no-screen">
                    <td colspan="6"><?php echo $this->element('encabezado'); ?></td>
                </tr>
                <tr class="no-screen">
                    <td colspan="6"><h1>Horarios de Clases Semanales</h1></td>
                </tr>
                <tr>
                    <th></th>
                    <th><?php echo __('Unidad Curricular');?></th>
                    <th><?php echo $this->Session->read('Proyecto.Pensum.regimen')?></th>
                    <th><?php echo __('Sección');?></th>
                    <th><?php echo __('Docente');?></th>
                    <th><?php echo __('Horario');?></th>
                    <th><?php echo __('Cupos');?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resumen as $seccion){ ?>

                <?php //debug($seccion);?>
                <tr>
                    <td>

                        <!-- BARRA DE HERRAMIENTAS POR SECCION -->
                        <div class="herramientas no-print">
                            <span class="abrir-formulario">
                                <?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'')), array('controller'=>'seccions','action' => 'edit', $seccion['Datos']['Seccion']['id'],1), array('escape'=>false, 'title'=>'Modificar Datos de la Sección'));?>
                            </span>
                        </div>
                        <!-- Fin BARRA DE HERRAMIENTAS POR SECCION -->

                    </td>
                    <td><?php echo $seccion['Datos']['Materia']['nombre']?></td>
                    <td><?php echo $seccion['Datos']['Materia']['nivel']?></td>
                    <td><?php echo $seccion['Datos']['Seccion']['nombre']?></td>
                    <td><?php
                            foreach($seccion['Datos']['Docente'] as $docente) { 
                                echo $docente['nombres'].' '.$docente['apellidos'].'<br/>';
                            }
                        ?>
                    </td>
                    <td><?php
                            foreach ($seccion['Encuentro'] as $encuentro){ ?>
                                <?php if($encuentro['modalidad'] == $modalidad['Distancia']['valor']){ ?>
                                    <?php echo 'Clase a Distancia '.$encuentro['cant_horas'].'hrs.';?><br/>
                                <?php }elseif($encuentro['modalidad'] == $modalidad['Pasantia']['valor']){ ?>
                                    <?php echo 'Pasantias Académicas';?><br/>
                                <?php }elseif($encuentro['modalidad'] == $modalidad['Presencial']['valor'] || $encuentro['modalidad'] == $modalidad['DistanciaHorario']['valor']){ ?>
                                    <?php if($encuentro['EncuentrosSeccion']['id_exist']){ ?>
                                            <?php
                                            echo $encuentro['Dia']['nombre'].':&nbsp;';
                                            echo $encuentro['Aula']['nombre'].'&nbsp;/&nbsp;';
                                            echo date('h:ia',strtotime($encuentro['Hora']['inicio'])).'&nbsp;-&nbsp;';
                                            echo date('h:ia',strtotime($encuentro['Hora']['fin']));
                                            ?>
                                        <br/>
                                    <?php }else{ ?>
                                        <div class="ui-state-error">#Encuentro no Asignado#<br/></div>
                                    <?php }
                                    }
                            }
                        ?>
                    </td>
                    <td><?php echo $seccion['Datos']['Seccion']['cupo']?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <?php // debug($resumen);?>
    </div>
</div>

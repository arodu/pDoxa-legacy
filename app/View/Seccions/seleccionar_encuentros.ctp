<?php //   debug($encuentros_seccion);
$modalidad = Configure::read('Modalidad');

if($encuentros_seccion){ ?>
    <div class="ui-widget">
        <div class="ui-widget-header ui-corner-top" style="display: block; font-size:small; padding: .5em;">
            
            <!-- Barra de Herramientas -->
            <span style="float:right;">
                <?php   echo '<span class="irContent">';
                        echo $this->Html->link($this->element('icono',array('icono'=>'ver','label'=>'')), array('controller'=>'seccions','action' => 'view',$seccion['Seccion']['id']), array('escape'=>false, 'title'=>'Ver Sección'));
                        echo '</span>';
                ?>
            </span>
            
            <div id="divMateria"><?php echo $seccion['Materia']['nombre'];?></div>
            <div id="divSeccion">Secci&oacute;n: <?php echo $seccion['Seccion']['nombre']; if($seccion['Turno']['nombre']) echo ' - Turno: '.$seccion['Turno']['nombre']; ?></div>
        </div>
       
        <div class="ui-widget-content" style="display: block; font-size:small; padding: .5em;">

        <?php foreach($encuentros_seccion as $encuentro){ ?>

                <?php if($encuentro['Encuentro']['TipoAula']['modalidad'] == $modalidad['Presencial']['valor'] || $encuentro['Encuentro']['TipoAula']['modalidad'] == $modalidad['DistanciaHorario']['valor']){
                            if($encuentro['Bloque']['Aula']['id']){ ?>
                                <div id="<?php echo $encuentro['EncuentrosSeccion']['id']?>" class="mtr-ocupado ui-widget-header ui-corner-all">
                                    <?php echo $this->element('icono',array('icono'=>'draggable','label'=>''));?>
                                    <div><?php echo $encuentro['Encuentro']['TipoAula']['nombre'].'&nbsp;&nbsp;'.$encuentro['Encuentro']['Encuentro']['cant_horas'].'h';?></div>
                                    <div>Aula: <?php echo $encuentro['Bloque']['Aula']['nombre'];?></div>
                                    <div><?php echo $encuentro['Bloque']['Dia']['nombre'].': '.date('h:ia',strtotime($encuentro['Bloque'][0]['inicio'])).' a '.date('h:ia',strtotime($encuentro['Bloque'][0]['fin']))?></div>
                                </div>
                       <?php }else{ ?>
                                <div id="<?php echo $encuentro['EncuentrosSeccion']['id']?>" class="mtr-libre ui-widget-content ui-corner-all">
                                    <?php echo $this->element('icono',array('icono'=>'draggable','label'=>''));?>
                                    <div><?php echo $encuentro['Encuentro']['TipoAula']['nombre'].'&nbsp;&nbsp;<strong>'.$encuentro['Encuentro']['Encuentro']['cant_horas'].'h</strong>';?></div>
                                </div>
                       <?php } ?>
                <?php }elseif($encuentro['Encuentro']['TipoAula']['modalidad'] == $modalidad['Distancia']['valor']){ ?> 
                             <div id="<?php echo $encuentro['EncuentrosSeccion']['id']?>" class="mtr-bloqueado ui-state-active ui-corner-all">
                                <?php echo $this->element('icono',array('icono'=>'star','label'=>''));?>
                                <div><?php echo 'Cant. Horas: '.$encuentro['Encuentro']['Encuentro']['cant_horas']?></div>
                                <div><?php echo 'Tipo Aula: '.$encuentro['Encuentro']['TipoAula']['nombre']?></div>
                             </div>
                <?php }elseif($encuentro['Encuentro']['TipoAula']['modalidad'] == $modalidad['Pasantia']['valor']){ ?>
                             <div id="<?php echo $encuentro['EncuentrosSeccion']['id']?>" class="mtr-bloqueado ui-state-active ui-corner-all">
                                <?php echo $this->element('icono',array('icono'=>'star','label'=>''));?>
                                <div><?php echo 'Tipo Aula: '.$encuentro['Encuentro']['TipoAula']['nombre']?></div>
                             </div>
                 <?php }else{ ?>
                             <div id="<?php echo $encuentro['EncuentrosSeccion']['id']?>" class="mtr-bloqueado ui-state-error ui-corner-all">
                                <?php echo $this->element('icono',array('icono'=>'alert','label'=>''));?>
                                <div>Error: modalidad N/A.</div>
                             </div>
                 <?php } 
              } // Fin foreach ?>
        </div>
        
        <?php if($seccion['Docente']){ ?>
            
            <div id="divDocente" class="ui-widget-header ui-corner-bottom">

                    Docente: 
                    <?php if(count($seccion['Docente']) <= 1){ ?>
                        <?php echo $seccion['Docente'][0]['nombres'].' '.$seccion['Docente'][0]['apellidos'];?>
                    <?php }else{ ?>
                        <?php foreach($seccion['Docente'] as $docente){?>
                            <div style="margin-left: 2em;"><?php echo $docente['nombres'].' '.$docente['apellidos'];?></div>
                        <?php } ?>
                    <?php } ?>


            </div>
            
        <?php } ?>
        
</div>
<?php } ?>
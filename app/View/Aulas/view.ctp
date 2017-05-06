<div style="height: 3%;" class="no-print">
   <div style="float:left;padding-right: 20px; margin-right: 20px;">       
   <h2 style="display: inline;"><?php echo 'Aula: '.$aula['Aula']['nombre'].' <span style="font-size:small;">('.$aula['TipoAula']['nombre'].')</span>';?></h2>
   <?php if($aula['Ubicacion']['id'] != null){ ?>
    <?php
            echo '<span id="ubicacion" title="'.$aula['Ubicacion']['descripcion'].'">';
            echo '<span id="tooltip" class="no-print no-screen">';
                echo '<div>'.$aula['Ubicacion']['descripcion'].'</div>';
                $link = "http://maps.googleapis.com/maps/api/staticmap?zoom=16&size=300x200&maptype=hybrid&sensor=false&markers=color:red|".h($aula['Ubicacion']['coordenadas']);
                echo '<div>'.$this->Html->image($link,array('class'=>'ui-corner-all ui-state-default')).'</div>';
            //.$aula['Ubicacion']['coordenadas'].
            echo '</span>';

            echo '<span class="link">'.$aula['Ubicacion']['nombre'].'</span>';
            echo '</span>';
    ?>
   <?php } ?>
   <?php echo $this->Form->hidden('aula_id',array('value'=>$aula['Aula']['id'])); ?>
   <hr />
   </div>
   <div id="papelera" class="boton papelera" style="float:right; margin-right: 100px; width: 150px;" title="Papelera: Arrastre hasta aqui para borrar la Sección del Horario">
        <?php // echo $this->element('icono',array('icono'=>'trash','label'=>'Papelera'));?>
        <span class="ui-icon ui-icon-trash" style="display: inline-block;"></span>Papelera
        <!-- <div id="texto" style="font-size: .8em"></div>-->
   </div>
   <div style="clear: both;"></div>
</div>

<br class="no-screen"/>
<!-- <div id="papelera" class="papelera ui-state-default ui-corner-all" style="float:right; height: 85%; width: 20px;"><span class="ui-icon ui-icon-trash"></span></div>
-->
<div class="cuadroAula" style="height: 95%; width: 100%">
   <div id="cuadro-<?php echo $aula['Aula']['id'];?>">
      <?php echo $this->requestAction(array('action' => 'verBloques',$aula['Aula']['id']),array('return')); ?>
   </div>
</div>
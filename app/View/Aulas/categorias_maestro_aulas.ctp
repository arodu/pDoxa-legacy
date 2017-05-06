<div id="accordionContenido">
	<h3>Filtrar Aulas</h3>
        <div class="proyectos filtro">
            
         <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
         <?php
        
            echo '<fieldset id="fsTipoAulas" class="multipleBox ui-state-default ui-corner-all">';
            echo '<legend>';
            //echo $this->Form->checkbox('tipoAulas',array('class'=>'check_todos','checked'=>'true'));
            echo $this->Form->label('tipoAulas','Tipo de Aulas');
            echo '</legend>';
            foreach ($tiposAulas as $tipoAulaId => $tipoAulaNombre){
                echo '<span style="display:block;">';
                echo $this->Form->checkbox('TipoAula'.$tipoAulaId,array('name'=>'tipoAula[]','value'=>$tipoAulaId,'hiddenField' => false,'class'=>'ck',  /*'checked'=>'true'*/));
                echo $this->Form->label('TipoAula'.$tipoAulaId,__($tipoAulaNombre));
                echo '</span>';
            }
            echo '</fieldset>';

            echo '<fieldset id="fsUbicaciones" class="multipleBox ui-state-default ui-corner-all">';
            echo '<legend>';
            //echo $this->Form->checkbox('ubicaciones',array('class'=>'check_todos','checked'=>'true'));
            echo $this->Form->label('ubicaciones','Ubicaciones Fisicas');
            echo '</legend>';
            foreach ($ubicaciones as $ubicacionId => $ubicacionNombre){
                if($ubicacionNombre != null){
                    echo '<span style="display:block;">';
                    echo $this->Form->checkbox('Ubicacion'.$ubicacionId,array('name'=>'ubicacion[]','value'=>$ubicacionId,'hiddenField' => false,'class'=>'ck',  /*'checked'=>'true'*/));
                    echo $this->Form->label('Ubicacion'.$ubicacionId,__($ubicacionNombre));
                    echo '</span>';
                }
            }
            echo '</fieldset>';
//        }
        
            echo '<fieldset id="fsEsquemaDias" class="multipleBox ui-state-default ui-corner-all">';
            echo '<legend>';
            //echo $this->Form->checkbox('esquemaDias',array('class'=>'check_todos','checked'=>'true'));
            echo $this->Form->label('esquemaDias','Esquema de Dias');
            echo '</legend>';
            foreach ($esquemaDias as $esquemaDiaId => $esquemaDiaNombre){
                echo '<span style="display:block;">';
                echo $this->Form->checkbox('EsquemaDia'.$esquemaDiaId,array('name'=>'esquemaDia[]','value'=>$esquemaDiaId,'hiddenField' => false,'class'=>'ck', /*'checked'=>'true'*/));
                echo $this->Form->label('EsquemaDia'.$esquemaDiaId,__($esquemaDiaNombre));
                echo '</span>';
            }
            echo '</fieldset>';

            echo '<fieldset id="fsEsquemaHoras" class="multipleBox ui-state-default ui-corner-all">';
            echo '<legend>';
            //echo $this->Form->checkbox('esquemaHoras',array('class'=>'check_todos','checked'=>'true'));
            echo $this->Form->label('esquemaHoras','Esquema de Horas');
            echo '</legend>';
            foreach ($esquemaHoras as $esquemaHoraId => $esquemaHoraNombre){
                echo '<span style="display:block;">';
                echo $this->Form->checkbox('EsquemaHora'.$esquemaHoraId,array('name'=>'esquemaHora[]','value'=>$esquemaHoraId,'hiddenField' => false,'class'=>'ck', /*'checked'=>'true'*/));
                echo $this->Form->label('EsquemaHora'.$esquemaHoraId,__($esquemaHoraNombre));
                echo '</span>';
            }
            echo '</fieldset>';
        
/*        foreach ($ubicaciones as $ubicacionId => $ubicacionNombre){
            echo $this->Form->label($ubicacionNombre);
            echo $this->Form->checkbox($ubicacionNombre,array('name'=>'ubicacion'));
        } */

         ?>
         <?php echo $this->Form->end(__('Cargar Datos')); ?>   
        </div>
</div>
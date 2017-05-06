<div id="accordionContenido">
    <h3><?php echo __('Editar Pensum') ?></h3>

        <div class="pensums form">
            
        <?php echo $this->element('migajas'); ?>
            
        <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
                <?php
                        echo $this->Form->input('id');
                        echo $this->Form->input('nombre');
                        echo $this->Form->input('regimen', array('type' => 'select','options'=>array('Año'=>'Año','Semestre'=>'Semestre','Trimestre'=>'Trimestre')));
                        echo $this->Form->input('fecha');
                        echo $this->Form->hidden('carrera_id');
                ?>
        <?php echo $this->Form->end(__('Guardar Datos')); ?>


<?php    // debug($this->Form); ?>
            
        </div>    
</div>

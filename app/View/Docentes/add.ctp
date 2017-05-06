<div id="accordionContenido">
    <h3><?php echo __('Agregar Nuevo Docente') ?></h3>
    <div class="docentes form">
        
        <?php echo $this->element('migajas'); ?>
        
        <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
            <?php
                echo $this->Form->input('cedula');
                echo $this->Form->input('nombres');
                echo $this->Form->input('apellidos');
                echo $this->Form->hidden('area_id',array('value'=>$area_id));
            ?>
    <?php echo $this->Form->end(__('Guardar Datos')); ?>
    </div>
</div>

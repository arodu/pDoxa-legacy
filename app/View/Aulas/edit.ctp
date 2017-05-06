<div id="accordionContenido">
    <h3>Modificar Aula</h3>
    <div class="aulas form">
        <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
        <?php
            echo $this->Form->input('id');
            echo $this->Form->input('nombre');
            echo $this->Form->input('tipo_aula_id', array('empty'=>'<-- Seleccione -->'));
            echo $this->Form->input('ubicacion_id', array('empty'=>'<-- Seleccione -->'));
            
            //echo $this->Form->input('proyecto_id');
            //echo $this->Form->input('esquema_dia_id');
            //echo $this->Form->input('esquema_hora_id');
        ?>
    <?php echo $this->Form->end(__('Guardar Cambios')); ?>
    </div>
</div>

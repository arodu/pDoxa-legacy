<div id="accordionContenido">
    <h3><?php echo __('Editar Carrera') ?></h3>

        <div class="carreras form">
        <?php echo $this->element('migajas'); ?>
            
        <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
                <?php
                        echo $this->Form->input('id');
                        echo $this->Form->input('nombre');
                        echo $this->Form->input('codigo');
                        echo $this->Form->hidden('area_id');
                ?>
        <?php echo $this->Form->end(__('Guardar Datos')); ?>
        </div>
</div>

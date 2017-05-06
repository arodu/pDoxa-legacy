<div id="accordionContenido">
    <h3><?php echo __('Editar Departamento') ?></h3>

    <div class="departamentos form">
        <?php echo $this->element('migajas'); ?>
            
        <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
            <?php
                    echo $this->Form->input('id');
                    echo $this->Form->input('nombre');
                    echo $this->Form->hidden('direccion_id');
            ?>
    <?php echo $this->Form->end(__('Submit')); ?>
    </div>
</div>
<div id="accordionContenido">
    <h3><?php echo __('Agregar Nuevo Encuentro') ?></h3>

    <div class="encuentros form">
    <?php echo $this->element('migajas'); ?>
        
        
    <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
            <?php
                    echo $this->Form->hidden('materia_id',array('value'=>$materia_id));
                    echo $this->Form->input('cant_horas');
                    echo $this->Form->input('tipo_aula_id');
            ?>
    <?php echo $this->Form->end(__('Submit')); ?>
    </div>
</div>
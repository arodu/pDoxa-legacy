<div id="accordionContenido">
    <h3><?php echo __('Agregar Nueva Dirección de Programa') ?></h3>

    <div class="direccions form">

        <?php echo $this->element('migajas'); ?>
    <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
            <?php
                    echo $this->Form->input('nombre');
                    echo $this->Form->hidden('area_id',array('value'=>$area_id));
            ?>
    <?php echo $this->Form->end(__('Guardar Datos')); ?>
    </div>
</div>
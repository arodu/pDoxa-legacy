<div id="accordionContenido">
    <h3><?php echo __('Agregar Nueva Carrera') ?></h3>
    <div class="carreras form">
        
        <?php echo $this->element('migajas'); ?>
        
        <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
                <?php
//                        debug($area);
                        echo $this->Form->input('nombre');
                        echo $this->Form->input('codigo');
                        echo $this->Form->hidden('area_id',array('value'=>$area_id));
//                        echo $this->Form->input('area_id');
                ?>
        <?php echo $this->Form->end(__('Guardar Datos')); ?>
    </div>
</div>

<div id="accordionContenido">
    <h3><?php echo __('Agregar Nuevo Pensum') ?></h3>
    <div class="pensums form">
    <?php echo $this->element('migajas'); ?>
    <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
            <?php
                    echo $this->Form->input('nombre');
                    echo $this->Form->input('regimen', array('type' => 'select','options'=>array('Año'=>'Año','Semestre'=>'Semestre','Trimestre'=>'Trimestre')));
                    echo $this->Form->input('fecha');
                    echo $this->Form->hidden('carrera_id',array('value'=>$carrera_id));

            ?>
    <?php echo $this->Form->end(__('Submit')); ?>
    </div>

</div>
<div id="accordionContenido">
    <h3><?php echo __('Agregar Nuevo Tipo de Aula') ?></h3>

    <div class="turnos form">
        
        <div class="acciones"><?php echo $this->Html->link($this->element('icono',array('icono'=>'listar','label'=>'Turnos')), array('action' => 'index'),array('escape'=>false)); ?></div>
        <hr/>
        
    <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
            <?php
                    echo $this->Form->input('nombre');
            ?>
        <?php echo $this->Form->end(__('Guardar Datos')); ?> 
    </div>
</div>

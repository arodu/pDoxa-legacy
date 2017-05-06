<div id="accordionContenido">
    <h3><?php echo __('Agregar Nueva Ubicación') ?></h3>

    <div class="ubicacions form">
        <div class="acciones"><?php echo $this->Html->link($this->element('icono',array('icono'=>'folder-open','label'=>'Ubicaciones')), array('action' => 'index'),array('escape'=>false)); ?></div>
        <hr/>
        
        
    <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
            <?php
                    echo $this->Form->input('nombre');
                    echo $this->Form->input('descripcion');
                    echo $this->Form->input('coordenadas');
                    
                    echo $this->Html->link('http://www.agenciacreativa.net/coordenadas_google_maps.php').'<br/>';
            ?>
    <?php echo $this->Form->end(__('Guardar Datos')); ?> 
    </div>
</div>

<div id="accordionContenido">
    <h3>Nueva Secci&oacute;n</h3>
    <div class="seccions form">
        <div class="acciones"><?php echo $this->Html->link($this->element('icono',array('icono'=>'listar','label'=>'Secciones')), array('action' => 'index'),array('escape'=>false)); ?></div>
        <hr/>        
        <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
	<?php
            echo $this->Form->hidden('proyecto_id',array('value'=>$proyecto));
            echo $this->Form->input('nombre',array('maxlength'=>'60','title'=>'Puede ingresar varias Secciones Separadas por coma ","'));
            echo $this->Form->input('materia_id',array('empty'=>'<-- Seleccione -->','title'=>'Puede'));
            echo $this->Form->input('cupo',array('title'=>'Puede'));
            echo $this->Form->input('turno_id',array('empty'=>'<-- Seleccione -->','title'=>'Puede'));
            echo $this->Form->input('Docente',array('data-placeholder'=>"Seleccione Docente"));
            //echo $this->Form->input('Encuentro');
	?>
        <?php echo $this->Form->end(__('Guardar Datos')); ?>
    </div>
</div>

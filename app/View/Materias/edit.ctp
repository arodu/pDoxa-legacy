<div id="accordionContenido">
    <h3><?php echo __('Editar Materia') ?></h3>

<div class="materias form">

            <?php echo $this->element('migajas'); ?>
            
<?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('codigo');
		echo $this->Form->input('nombre');
		echo $this->Form->input('avr',array('label'=>'Abreviatura'));
		echo $this->Form->input('u_c',array('label'=>'Unidades Credito'));
		echo $this->Form->input('h_s', array('label'=>'Horas Semanales'));
		echo $this->Form->input('nivel');
		echo $this->Form->input('departamento_id');
//                echo $this->Form->hidden('pensum_id');
	?>
<?php echo $this->Form->end(__('Guardar Datos')); ?>
</div>
    
</div>
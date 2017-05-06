<div id="accordionContenido">
    <h3><?php echo __('Editar Área Académica') ?></h3>

<div class="areas form">
        <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
	?>
        <?php echo $this->Form->end(__('Guardar Datos')); ?>
</div>
</div>

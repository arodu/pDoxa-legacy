<div class="ayudaContenidos form">
<?php echo $this->Form->create('AyudaContenido'); ?>
	<fieldset>
		<legend><?php echo __('Add Ayuda Contenido'); ?></legend>
	<?php

		//debug($parentAyudaContenidos);

		echo $this->Form->input('parent_id', array('label'=>'Nodo Padre', 'options'=>$parentAyudaContenidos, 'empty'=>'--Seleccione--'));
		//echo $this->Form->input('lft');
		//echo $this->Form->input('rght');
		echo $this->Form->input('titulo');
		echo $this->Form->input('descripcion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Ayuda Contenidos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Ayuda Contenidos'), array('controller' => 'contenidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Ayuda Contenido'), array('controller' => 'contenidos', 'action' => 'add')); ?> </li>
	</ul>
</div>

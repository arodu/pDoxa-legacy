<div class="ayudaContenidos form">
<?php echo $this->Form->create('AyudaContenido'); ?>
	<fieldset>
		<legend><?php echo __('Edit Ayuda Contenido'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('parent_id', array('label'=>'Nodo Padre', 'options'=>$parentAyudaContenidos, 'empty'=>'--Seleccione--'));
		echo $this->Form->input('titulo');
		echo $this->Form->input('descripcion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AyudaContenido.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('AyudaContenido.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ayuda Contenidos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Ayuda Contenidos'), array('controller' => 'contenidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Ayuda Contenido'), array('controller' => 'contenidos', 'action' => 'add')); ?> </li>
	</ul>
</div>

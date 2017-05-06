<div id="accordionContenido">
    <h3><?php echo __('Docente'); ?></h3>
    <div class="docentes view">

        <?php echo $this->element('migajas'); ?>

	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($docente['Docente']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cedula'); ?></dt>
		<dd>
			<?php echo h($docente['Docente']['cedula']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombres'); ?></dt>
		<dd>
			<?php echo h($docente['Docente']['nombres']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Apellidos'); ?></dt>
		<dd>
			<?php echo h($docente['Docente']['apellidos']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Area'); ?></dt>
		<dd>
			<?php echo h($docente['Area']['nombre']); ?>
			&nbsp;
		</dd>
	</dl>

<div class="acciones">
    <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $docente['Docente']['id']),array('escape'=>false)); ?></span>
    <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $docente['Docente']['id']), array('escape'=>false, 'title'=>'Eliminar','id'=>'borrar')); ?></span>
</div>

</div>
</div>
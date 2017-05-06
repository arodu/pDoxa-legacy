<div class="encuentros view">
<h2><?php  echo __('Encuentro'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($encuentro['Encuentro']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Materia'); ?></dt>
		<dd>
			<?php echo $this->Html->link($encuentro['Materia']['nombre'], array('controller' => 'materias', 'action' => 'view', $encuentro['Materia']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cant Horas'); ?></dt>
		<dd>
			<?php echo h($encuentro['Encuentro']['cant_horas']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo Aula'); ?></dt>
		<dd>
			<?php echo $this->Html->link($encuentro['TipoAula']['nombre'], array('controller' => 'tipo_aulas', 'action' => 'view', $encuentro['TipoAula']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Encuentro'), array('action' => 'edit', $encuentro['Encuentro']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Encuentro'), array('action' => 'delete', $encuentro['Encuentro']['id']), null, __('Are you sure you want to delete # %s?', $encuentro['Encuentro']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Encuentros'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Encuentro'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Materias'), array('controller' => 'materias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Materia'), array('controller' => 'materias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipo Aulas'), array('controller' => 'tipo_aulas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Aula'), array('controller' => 'tipo_aulas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seccions'), array('controller' => 'seccions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seccion'), array('controller' => 'seccions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Seccions'); ?></h3>
	<?php if (!empty($encuentro['Seccion'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Seccion Detalle Id'); ?></th>
		<th><?php echo __('Materia Id'); ?></th>
		<th><?php echo __('Proyecto Id'); ?></th>
		<th><?php echo __('Cupo'); ?></th>
		<th><?php echo __('Turno Id'); ?></th>
		<th><?php echo __('Docente Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($encuentro['Seccion'] as $seccion): ?>
		<tr>
			<td><?php echo $seccion['id']; ?></td>
			<td><?php echo $seccion['seccion_detalle_id']; ?></td>
			<td><?php echo $seccion['materia_id']; ?></td>
			<td><?php echo $seccion['proyecto_id']; ?></td>
			<td><?php echo $seccion['cupo']; ?></td>
			<td><?php echo $seccion['turno_id']; ?></td>
			<td><?php echo $seccion['docente_id']; ?></td>
			<td><?php echo $seccion['created']; ?></td>
			<td><?php echo $seccion['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'seccions', 'action' => 'view', $seccion['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'seccions', 'action' => 'edit', $seccion['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'seccions', 'action' => 'delete', $seccion['id']), null, __('Are you sure you want to delete # %s?', $seccion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Seccion'), array('controller' => 'seccions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

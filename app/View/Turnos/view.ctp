<div class="turnos view">
<h2><?php  echo __('Turno'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($turno['Turno']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($turno['Turno']['nombre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Turno'), array('action' => 'edit', $turno['Turno']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Turno'), array('action' => 'delete', $turno['Turno']['id']), null, __('Are you sure you want to delete # %s?', $turno['Turno']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Turnos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Turno'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seccions'), array('controller' => 'seccions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seccion'), array('controller' => 'seccions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Horas'), array('controller' => 'horas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Hora'), array('controller' => 'horas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Seccions'); ?></h3>
	<?php if (!empty($turno['Seccion'])): ?>
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
		foreach ($turno['Seccion'] as $seccion): ?>
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
<div class="related">
	<h3><?php echo __('Related Horas'); ?></h3>
	<?php if (!empty($turno['Hora'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Numero'); ?></th>
		<th><?php echo __('Inicio'); ?></th>
		<th><?php echo __('Fin'); ?></th>
		<th><?php echo __('Esquema Hora Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($turno['Hora'] as $hora): ?>
		<tr>
			<td><?php echo $hora['id']; ?></td>
			<td><?php echo $hora['numero']; ?></td>
			<td><?php echo $hora['inicio']; ?></td>
			<td><?php echo $hora['fin']; ?></td>
			<td><?php echo $hora['esquema_hora_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'horas', 'action' => 'view', $hora['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'horas', 'action' => 'edit', $hora['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'horas', 'action' => 'delete', $hora['id']), null, __('Are you sure you want to delete # %s?', $hora['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Hora'), array('controller' => 'horas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

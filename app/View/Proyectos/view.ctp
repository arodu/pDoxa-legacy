<div class="proyectos view">
<h2><?php  echo __('Proyecto'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($proyecto['Proyecto']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($proyecto['Proyecto']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pensum'); ?></dt>
		<dd>
			<?php echo $this->Html->link($proyecto['Pensum']['nombre'], array('controller' => 'pensums', 'action' => 'view', $proyecto['Pensum']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lapso Academico'); ?></dt>
		<dd>
			<?php echo h($proyecto['Proyecto']['lapso_academico']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha'); ?></dt>
		<dd>
			<?php echo h($proyecto['Proyecto']['fecha']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($proyecto['Proyecto']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($proyecto['Proyecto']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Proyecto'), array('action' => 'edit', $proyecto['Proyecto']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Proyecto'), array('action' => 'delete', $proyecto['Proyecto']['id']), null, __('Are you sure you want to delete # %s?', $proyecto['Proyecto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Proyectos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proyecto'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pensums'), array('controller' => 'pensums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pensum'), array('controller' => 'pensums', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Aulas'), array('controller' => 'aulas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Aula'), array('controller' => 'aulas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seccions'), array('controller' => 'seccions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seccion'), array('controller' => 'seccions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Aulas'); ?></h3>
	<?php if (!empty($proyecto['Aula'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Tipo Aula Id'); ?></th>
		<th><?php echo __('Aula Fisica Id'); ?></th>
		<th><?php echo __('Proyecto Id'); ?></th>
		<th><?php echo __('Esquema Dia Id'); ?></th>
		<th><?php echo __('Esquema Hora Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($proyecto['Aula'] as $aula): ?>
		<tr>
			<td><?php echo $aula['id']; ?></td>
			<td><?php echo $aula['nombre']; ?></td>
			<td><?php echo $aula['tipo_aula_id']; ?></td>
			<td><?php echo $aula['aula_fisica_id']; ?></td>
			<td><?php echo $aula['proyecto_id']; ?></td>
			<td><?php echo $aula['esquema_dia_id']; ?></td>
			<td><?php echo $aula['esquema_hora_id']; ?></td>
			<td><?php echo $aula['created']; ?></td>
			<td><?php echo $aula['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'aulas', 'action' => 'view', $aula['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'aulas', 'action' => 'edit', $aula['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'aulas', 'action' => 'delete', $aula['id']), null, __('Are you sure you want to delete # %s?', $aula['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Aula'), array('controller' => 'aulas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Seccions'); ?></h3>
	<?php if (!empty($proyecto['Seccion'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Materia Id'); ?></th>
		<th><?php echo __('Proyecto Id'); ?></th>
		<th><?php echo __('Cupo'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Turno Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($proyecto['Seccion'] as $seccion): ?>
		<tr>
			<td><?php echo $seccion['id']; ?></td>
			<td><?php echo $seccion['nombre']; ?></td>
			<td><?php echo $seccion['materia_id']; ?></td>
			<td><?php echo $seccion['proyecto_id']; ?></td>
			<td><?php echo $seccion['cupo']; ?></td>
			<td><?php echo $seccion['created']; ?></td>
			<td><?php echo $seccion['updated']; ?></td>
			<td><?php echo $seccion['turno_id']; ?></td>
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

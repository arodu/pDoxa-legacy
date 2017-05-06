<div class="horas view">
<h2><?php  echo __('Hora'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($hora['Hora']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Numero'); ?></dt>
		<dd>
			<?php echo h($hora['Hora']['numero']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inicio'); ?></dt>
		<dd>
			<?php echo h($hora['Hora']['inicio']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fin'); ?></dt>
		<dd>
			<?php echo h($hora['Hora']['fin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Esquema Hora'); ?></dt>
		<dd>
			<?php echo $this->Html->link($hora['EsquemaHora']['nombre'], array('controller' => 'esquema_horas', 'action' => 'view', $hora['EsquemaHora']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Hora'), array('action' => 'edit', $hora['Hora']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Hora'), array('action' => 'delete', $hora['Hora']['id']), null, __('Are you sure you want to delete # %s?', $hora['Hora']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Horas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Hora'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Esquema Horas'), array('controller' => 'esquema_horas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Esquema Hora'), array('controller' => 'esquema_horas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bloques'), array('controller' => 'bloques', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bloque'), array('controller' => 'bloques', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Turnos'), array('controller' => 'turnos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Turno'), array('controller' => 'turnos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Bloques'); ?></h3>
	<?php if (!empty($hora['Bloque'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Aula Id'); ?></th>
		<th><?php echo __('Dia Id'); ?></th>
		<th><?php echo __('Hora Id'); ?></th>
		<th><?php echo __('Activo'); ?></th>
		<th><?php echo __('Encuentros Seccion Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($hora['Bloque'] as $bloque): ?>
		<tr>
			<td><?php echo $bloque['id']; ?></td>
			<td><?php echo $bloque['aula_id']; ?></td>
			<td><?php echo $bloque['dia_id']; ?></td>
			<td><?php echo $bloque['hora_id']; ?></td>
			<td><?php echo $bloque['activo']; ?></td>
			<td><?php echo $bloque['encuentros_seccion_id']; ?></td>
			<td><?php echo $bloque['created']; ?></td>
			<td><?php echo $bloque['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'bloques', 'action' => 'view', $bloque['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'bloques', 'action' => 'edit', $bloque['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'bloques', 'action' => 'delete', $bloque['id']), null, __('Are you sure you want to delete # %s?', $bloque['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Bloque'), array('controller' => 'bloques', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Turnos'); ?></h3>
	<?php if (!empty($hora['Turno'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($hora['Turno'] as $turno): ?>
		<tr>
			<td><?php echo $turno['id']; ?></td>
			<td><?php echo $turno['nombre']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'turnos', 'action' => 'view', $turno['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'turnos', 'action' => 'edit', $turno['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'turnos', 'action' => 'delete', $turno['id']), null, __('Are you sure you want to delete # %s?', $turno['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Turno'), array('controller' => 'turnos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

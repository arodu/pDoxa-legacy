<div class="dias view">
<h2><?php  echo __('Dia'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dia['Dia']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Numero'); ?></dt>
		<dd>
			<?php echo h($dia['Dia']['numero']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($dia['Dia']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Esquema Dia'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dia['EsquemaDia']['nombre'], array('controller' => 'esquema_dias', 'action' => 'view', $dia['EsquemaDia']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dia'), array('action' => 'edit', $dia['Dia']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Dia'), array('action' => 'delete', $dia['Dia']['id']), null, __('Are you sure you want to delete # %s?', $dia['Dia']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Dias'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dia'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Esquema Dias'), array('controller' => 'esquema_dias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Esquema Dia'), array('controller' => 'esquema_dias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bloques'), array('controller' => 'bloques', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bloque'), array('controller' => 'bloques', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Bloques'); ?></h3>
	<?php if (!empty($dia['Bloque'])): ?>
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
		foreach ($dia['Bloque'] as $bloque): ?>
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

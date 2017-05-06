<div class="encuentros index">
	<h2><?php echo __('Encuentros'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('materia_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cant_horas'); ?></th>
			<th><?php echo $this->Paginator->sort('tipo_aula_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($encuentros as $encuentro): ?>
	<tr>
		<td><?php echo h($encuentro['Encuentro']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($encuentro['Materia']['nombre'], array('controller' => 'materias', 'action' => 'view', $encuentro['Materia']['id'])); ?>
		</td>
		<td><?php echo h($encuentro['Encuentro']['cant_horas']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($encuentro['TipoAula']['nombre'], array('controller' => 'tipo_aulas', 'action' => 'view', $encuentro['TipoAula']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $encuentro['Encuentro']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $encuentro['Encuentro']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $encuentro['Encuentro']['id']), null, __('Are you sure you want to delete # %s?', $encuentro['Encuentro']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Encuentro'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Materias'), array('controller' => 'materias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Materia'), array('controller' => 'materias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipo Aulas'), array('controller' => 'tipo_aulas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Aula'), array('controller' => 'tipo_aulas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seccions'), array('controller' => 'seccions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seccion'), array('controller' => 'seccions', 'action' => 'add')); ?> </li>
	</ul>
</div>

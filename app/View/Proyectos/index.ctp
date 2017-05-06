<div class="proyectos index">
	<h2><?php echo __('Proyectos'); ?></h2>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('pensum_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lapso_academico'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($proyectos as $proyecto): ?>
	<tr>
		<td><?php echo h($proyecto['Proyecto']['id']); ?>&nbsp;</td>
		<td><?php echo h($proyecto['Proyecto']['nombre']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($proyecto['Pensum']['nombre'], array('controller' => 'pensums', 'action' => 'view', $proyecto['Pensum']['id'])); ?>
		</td>
		<td><?php echo h($proyecto['Proyecto']['lapso_academico']); ?>&nbsp;</td>
		<td><?php echo h($proyecto['Proyecto']['fecha']); ?>&nbsp;</td>
		<td><?php echo h($proyecto['Proyecto']['created']); ?>&nbsp;</td>
		<td><?php echo h($proyecto['Proyecto']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $proyecto['Proyecto']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $proyecto['Proyecto']['id'])); ?>
         <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $proyecto['Proyecto']['id']), null, __('Are you sure you want to delete # %s?', $proyecto['Proyecto']['id'])); ?>
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


</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Proyecto'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Pensums'), array('controller' => 'pensums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pensum'), array('controller' => 'pensums', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Aulas'), array('controller' => 'aulas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Aula'), array('controller' => 'aulas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seccions'), array('controller' => 'seccions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seccion'), array('controller' => 'seccions', 'action' => 'add')); ?> </li>
	</ul>
</div>

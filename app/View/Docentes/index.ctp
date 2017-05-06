<!-- <span class="acciones"><?php echo $this->Html->link(__('Agregar Nuevo Docente'), array('controller' => 'docentes', 'action' => 'add')); ?> </span> -->
<span class="paginas buttonset">
<?php
    echo $this->Paginator->prev(__('<<'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => '&nbsp;','before'=>'&nbsp;','after'=>'&nbsp;'));
    echo $this->Paginator->next(__('>>'), array(), null, array('class' => 'next disabled'));
?>
</span>
<span><?php echo $this->element('contadorPaginas');?></span>
	<table cellpadding="0" cellspacing="0">
	<tr class="ordenar">
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('cedula'); ?></th>
			<th><?php echo $this->Paginator->sort('nombres'); ?></th>
			<th><?php echo $this->Paginator->sort('apellidos'); ?></th>
			<th class="actions"></th>
	</tr>
	<?php
	foreach ($docentes as $docente): ?>
	<tr>
		<td><?php echo h($docente['Docente']['id']); ?>&nbsp;</td>
		<td><?php echo h($docente['Docente']['cedula']); ?>&nbsp;</td>
		<td><?php echo h($docente['Docente']['nombres']); ?>&nbsp;</td>
		<td><?php echo h($docente['Docente']['apellidos']); ?>&nbsp;</td>
		<td class="acciones">
			<?php echo $this->Html->link($this->element('icono',array('icono'=>'ver','label'=>'Ver')), array('action' => 'view', $docente['Docente']['id']),array('escape'=>false, 'title'=>'Ver Docente')); ?>
			<?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $docente['Docente']['id']),array('escape'=>false, 'title'=>'Editar Docente')); ?>
                        <?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $docente['Docente']['id']), array('escape'=>false, 'title'=>'Eliminar Docente','id'=>'borrar')); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
<br/>
<span class="paginas buttonset">
<?php
    echo $this->Paginator->prev(__('<<'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => '&nbsp;','before'=>'&nbsp;','after'=>'&nbsp;'));
    echo $this->Paginator->next(__('>>'), array(), null, array('class' => 'next disabled'));
?>
</span>
<span><?php echo $this->element('contadorPaginas');?></span>

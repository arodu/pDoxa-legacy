<!-- <span class="acciones"><?php echo $this->Html->link(__('Agregar Nueva Materia'), array('controller' => 'materias', 'action' => 'add',$materia['Pensum']['id'])); ?> </span>
-->

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
			<th><?php echo $this->Paginator->sort('codigo'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('avr'); ?></th>
			<th><?php echo $this->Paginator->sort('u_c'); ?></th>
			<th><?php echo $this->Paginator->sort('h_s'); ?></th>
			<th><?php echo $this->Paginator->sort('nivel'); ?></th>
                        <th><?php
                            if(isset($departamento)){
                                echo $this->Paginator->sort('departamento_id');
                            }else if(isset($pensum)){
                                echo $this->Paginator->sort('pensum_id');
                            }
                        ?></th>
			<th class="actions"></th>
	</tr>
	<?php
	foreach ($materias as $materia): ?>
	<tr>
		<td><?php echo h($materia['Materia']['id']); ?>&nbsp;</td>
		<td><?php echo h($materia['Materia']['codigo']); ?>&nbsp;</td>
		<td><?php echo h($materia['Materia']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($materia['Materia']['avr']); ?>&nbsp;</td>
		<td><?php echo h($materia['Materia']['u_c']); ?>&nbsp;</td>
		<td><?php echo h($materia['Materia']['h_s']); ?>&nbsp;</td>
                <td><?php echo h($materia['Materia']['nivel']); ?>&nbsp;</td>
                <td><?php
                    if(isset($departamento)){
                        echo $materia['Departamento']['nombre'];
                    }else if(isset($pensum)){
                        echo $materia['Pensum']['nombre'];
                    }
                ?></td>
		<td class="acciones">
			<?php echo $this->Html->link($this->element('icono',array('icono'=>'ver','label'=>'Ver')), array('action' => 'view', $materia['Materia']['id']),array('escape'=>false, 'title'=>'Ver Materia')); ?>
			<?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $materia['Materia']['id']),array('escape'=>false, 'title'=>'Editar Materia')); ?>
			<?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $materia['Materia']['id']), array('escape'=>false, 'title'=>'Eliminar Materia','id'=>'borrar')); ?>
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
        
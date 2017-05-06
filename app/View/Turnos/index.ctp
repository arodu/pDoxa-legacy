<div id="accordionContenido">
	<h3>Turnos</h3>

<div class="turnos index">
	
        <div class="acciones"><?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Agregar Turno')), array('action' => 'add'),array('escape'=>false)); ?></div>
        <hr/>
        <div>
            <span class="paginas buttonset">
            <?php
                echo $this->Paginator->prev(__('<<'), array(), null, array('class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => '&nbsp;','before'=>'&nbsp;','after'=>'&nbsp;'));
                echo $this->Paginator->next(__('>>'), array(), null, array('class' => 'next disabled'));
            ?>
            </span>
            <span><?php echo $this->element('contadorPaginas');?></span>
        </div>
    
    
    
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th class="actions"></th>
	</tr>
	<?php
	foreach ($turnos as $turno): ?>
	<tr>
		<td><?php echo h($turno['Turno']['id']); ?>&nbsp;</td>
		<td><?php echo h($turno['Turno']['nombre']); ?>&nbsp;</td>
		<td class="acciones">
			<?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $turno['Turno']['id']),array('escape'=>false)); ?>
			<?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $turno['Turno']['id']),array('escape'=>false,'id'=>'borrar')); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
        
        <br/>
        <div>
            <span class="paginas buttonset">
            <?php
                echo $this->Paginator->prev(__('<<'), array(), null, array('class' => 'prev disabled',));
                echo $this->Paginator->numbers(array('separator' => '&nbsp;','before'=>'&nbsp;','after'=>'&nbsp;'));
                echo $this->Paginator->next(__('>>'), array(), null, array('class' => 'next disabled'));
            ?>
            </span>
            <span><?php echo $this->element('contadorPaginas');?></span>
        </div>

</div>
</div>

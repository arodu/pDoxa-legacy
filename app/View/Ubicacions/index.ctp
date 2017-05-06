<div id="accordionContenido">
	<h3>Indice de Aulas</h3>

<div class="ubicacions index">
	
        <div class="acciones"><?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Agregar Ubicación Fisica')), array('action' => 'add'),array('escape'=>false)); ?></div>
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
	<tr class="ordenar">
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('descripcion'); ?></th>
			<th><?php echo $this->Paginator->sort('coordenadas'); ?></th>
			<th class="actions"></th>
	</tr>
	<?php
	foreach ($ubicacions as $ubicacion): ?>
	<tr>
		<td><?php echo h($ubicacion['Ubicacion']['id']); ?>&nbsp;</td>
		<td><?php echo h($ubicacion['Ubicacion']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($ubicacion['Ubicacion']['descripcion']); ?>&nbsp;</td>
		<td><?php echo h($ubicacion['Ubicacion']['coordenadas']); ?>&nbsp;</td>
		<td class="acciones">
			<?php echo $this->Html->link($this->element('icono',array('icono'=>'ver','label'=>'Ver')), array('action' => 'view', $ubicacion['Ubicacion']['id']),array('escape'=>false)); ?>
			<?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $ubicacion['Ubicacion']['id']),array('escape'=>false)); ?>
                        <?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $ubicacion['Ubicacion']['id']), array('escape'=>false, 'title'=>'Eliminar Ubicación','id'=>'borrar')); ?>
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

</div>
</div>


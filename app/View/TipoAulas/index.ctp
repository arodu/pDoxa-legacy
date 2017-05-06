<?php $modalidad = Configure::read('Modalidad'); ?>

<div id="accordionContenido">
	<h3>Tipos de Aulas</h3>

<div class="tipoAulas index">

        <div class="acciones"><?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Agregar Tipo de Aula')), array('action' => 'add'),array('escape'=>false)); ?></div>
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
			<th><?php echo $this->Paginator->sort('modalidad'); ?></th>
			<th class="actions"></th>
	</tr>
	<?php
	foreach ($tipoAulas as $tipoAula): ?>
	<tr>
		<td><?php echo h($tipoAula['TipoAula']['id']); ?>&nbsp;</td>
		<td><?php echo h($tipoAula['TipoAula']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($tipoAula['TipoAula']['descripcion']); ?>&nbsp;</td>
		<td><?php echo $modalidad[$tipoAula['TipoAula']['modalidad']]['nombre']; ?>&nbsp;</td>
		<td class="acciones">
			<?php // echo $this->Html->link(__('View'), array('action' => 'view', $tipoAula['TipoAula']['id'])); ?>
			<?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $tipoAula['TipoAula']['id']),array('escape'=>false)); ?>
			<?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $tipoAula['TipoAula']['id']),array('id'=>'borrar','title'=>'Eliminar','escape'=>false)); ?>
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
        
        


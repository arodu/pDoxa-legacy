<div id="accordionContenido">
    <h3><?php  echo __('Materia'); ?></h3>

<div class="materias view">

        <?php echo $this->element('migajas'); ?>
    
	<dl>
		<dt><?php echo __('Codigo'); ?></dt>
		<dd>
			<?php echo h($materia['Materia']['codigo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($materia['Materia']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Avr'); ?></dt>
		<dd>
			<?php echo h($materia['Materia']['avr']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unidades Credito'); ?></dt>
		<dd>
			<?php echo h($materia['Materia']['u_c']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Horas Semanales'); ?></dt>
		<dd>
			<?php echo h($materia['Materia']['h_s']); ?>
			&nbsp;
		</dd>
<!--		<dt><?php echo __('Pensum'); ?></dt>
		<dd>
			<?php echo $this->Html->link($materia['Pensum']['nombre'], array('controller' => 'pensums', 'action' => 'view', $materia['Pensum']['id'])); ?>
			&nbsp;
		</dd> -->
		<dt><?php echo __('Nivel'); ?></dt>
		<dd>
			<?php echo h($materia['Materia']['nivel']); ?>
			&nbsp;
		</dd>
                <?php if($materia['Departamento']['id'] != null){ ?>
		<dt><?php echo __('Departamento'); ?></dt>
		<dd>
                    <span class="acciones"><?php echo $this->Html->link($this->element('icono',array('icono'=>'volver','label'=>$materia['Departamento']['nombre'])), array('controller' => 'departamentos', 'action' => 'view', $materia['Departamento']['id']),array('escape'=>false, 'title'=>'Ir al Departamento')); ?></span>
			&nbsp;
		</dd>
                <?php } ?>
	</dl>

<div class="acciones buttonset">
        <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $materia['Materia']['id']),array('escape'=>false, 'title'=>'Editar Materia')); ?> </span>
        <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('controller' => 'materias', 'action' => 'delete', $materia['Materia']['id']), array('escape'=>false, 'title'=>'Eliminar Materia','id'=>'borrar')); ?></span>
        <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Encuentro')), array('controller' => 'encuentros', 'action' => 'add',$materia['Materia']['id']),array('escape'=>false, 'title'=>'Agregar Nuevo Encuentro')); ?> </span>
</div>
<br/>



<div class="related">
	<?php if (!empty($materia['Encuentro'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Encuentros'); ?></th>
		<th><?php echo __('Cantidad de Horas'); ?></th>
		<th><?php echo __('Tipo de Aula'); ?></th>
		<th class="actions"></th>
	</tr>
	<?php
//        debug($encuentros);
        
		$i = 1;
                $total_horas = 0;
		foreach ($encuentros as $encuentro): ?>
		<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $encuentro['Encuentro']['cant_horas']; $total_horas+=$encuentro['Encuentro']['cant_horas'];?></td>
			<td><?php echo $encuentro['TipoAula']['nombre']; ?></td>
			<td class="acciones">
                                <?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('controller' => 'encuentros', 'action' => 'edit', $encuentro['Encuentro']['id']),array('escape'=>false, 'title'=>'Editar Encuentro')); ?>
                                <?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('controller' => 'encuentros', 'action' => 'delete', $encuentro['Encuentro']['id']), array('escape'=>false, 'title'=>'Eliminar Encuentro','id'=>'borrar')); ?>
			</td>
		</tr>
	<?php endforeach; ?>
                <tr>
                    <th>Total Horas</th>
                    <th><?php echo $total_horas;?></th>
                    <th colspan="2"></th>
                </tr>
                
	</table>
<?php endif; ?>
</div>




</div>



</div>
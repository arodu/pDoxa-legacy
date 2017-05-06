<div id="accordionContenido">
    <h3><?php  echo __('Pensum'); ?></h3>

<div class="pensums view">

        <?php echo $this->element('migajas'); ?>

	<dl>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($pensum['Pensum']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Regimen'); ?></dt>
		<dd>
			<?php echo h($pensum['Pensum']['regimen']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha'); ?></dt>
		<dd>
			<?php echo h($pensum['Pensum']['fecha']); ?>
			&nbsp;
		</dd>
	</dl>
    
<div class="acciones buttonset">
    <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $pensum['Pensum']['id']),array('escape'=>false, 'title'=>'Editar Pensum')); ?> </span>
    <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'copiar','label'=>'Copiar')), array('action' => 'copiar', $pensum['Pensum']['id']),array('escape'=>false, 'title'=>'Copiar Pensum','id'=>'alerta')); ?> </span>
    <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $pensum['Pensum']['id']), array('escape'=>false, 'title'=>'Eliminar Pensum','id'=>'borrar')); ?></span>
    <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Materia')), array('controller' => 'materias', 'action' => 'add',$pensum['Pensum']['id']),array('escape'=>false, 'title'=>'Agregar Nueva Materia')); ?> </span>
</div>
    
<br/>
<div id="tabsInformacion">
    <ul>
        <li><a href="#materias">Materias</a></li><!-- tab 0 -->
        <li><a href="#proyectos">Proyectos</a></li><!-- tab 1 -->
    </ul>
<div id="materias" class="related">
        <div id="paginacion">
        <?php echo $this->requestAction(array('controller' => 'materias', 'action' => 'index',$pensum['Pensum']['id']),array('return')); ?>
        </div>
</div>
<div id="proyectos" class="related">
    <h3>Proyectos relacionados con el Pensum <strong><?php echo $pensum['Pensum']['nombre'];?></strong></h3>
	<?php if (!empty($pensum['Proyecto'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Lapso Academico'); ?></th>
		<th><?php echo __('Fecha'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($pensum['Proyecto'] as $proyecto): ?>
		<tr>
			<td><?php echo $proyecto['id']; ?></td>
			<td><?php echo $proyecto['nombre']; ?></td>
			<td><?php echo $proyecto['lapso_academico']; ?></td>
			<td><?php echo $proyecto['fecha']; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

</div>
    
</div>
</div>
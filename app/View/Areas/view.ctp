<div id="accordionContenido">
    <h3><?php echo h($area['Area']['nombre']); ?></h3>

<div class="areas view">
	<dl>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($area['Area']['nombre']); ?>
			&nbsp;
		</dd>
<!--                <dt><?php echo __('Fecha de Creación'); ?></dt>
                <dd>
                        <?php echo $this->Time->format('d/m/Y, h:i a',$area['Area']['created']); ?>
                        &nbsp;
                </dd>
                <dt><?php echo __('Ultima Modificación'); ?></dt>
                <dd>
                        <?php echo $this->Time->format('d/m/Y, h:i a',$area['Area']['updated']); ?>
                        &nbsp;
                </dd>
		<dt><?php echo __('User'); ?></dt> 
		<dd>
			<?php echo $this->Html->link($area['User']['id'], array('controller' => 'users', 'action' => 'view', $area['User']['id'])); ?>
			&nbsp;
		</dd> -->
	</dl>

    
<div class="acciones buttonset">
    <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $area['Area']['id']),array('escape'=>false, 'title'=>'Editar Área Académica')); ?></span>
    <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $area['Area']['id']), array('escape'=>false, 'title'=>'Eliminar Área Académica','id'=>'borrar')); ?></span>
    <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Carrera')), array('controller' => 'carreras', 'action' => 'add',$area['Area']['id']),array('escape'=>false, 'title'=>'Agregar Nueva Carrera')); ?> </span>
    <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Dirección de Programa')), array('controller' => 'direccions', 'action' => 'add',$area['Area']['id']),array('escape'=>false, 'title'=>'Agregar Nueva Dirección de Programa')); ?> </span>
    <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Docente')), array('controller' => 'docentes', 'action' => 'add',$area['Area']['id']),array('escape'=>false, 'title'=>'Agregar Nuevo Docente')); ?> </span>
</div>
<br/>
<div id="tabsInformacion">
    <ul>
        <li><a href="#carreras">Carreras</a></li><!-- tab 0 -->
        <li><a href="#direccions">Direcciones de Programa</a></li><!-- tab 1 -->
        <li><a href="#docentes">Docentes</a></li><!-- tab 2 -->
    </ul>
    
<div id="direccions" class="related">
	<?php if (!empty($area['Direccion'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Area Id'); ?></th>
		<th class="actions"></th>
	</tr>
	<?php
		$i = 0;
		foreach ($area['Direccion'] as $direccion): ?>
		<tr>
			<td><?php echo $direccion['id']; ?></td>
			<td><?php echo $direccion['nombre']; ?></td>
			<td><?php echo $direccion['area_id']; ?></td>
			<td class="acciones">
				<?php echo $this->Html->link($this->element('icono',array('icono'=>'ver','label'=>'Ver')), array('controller' => 'direccions', 'action' => 'view', $direccion['id']),array('escape'=>false, 'title'=>'Ver Dirección de Programa')); ?>
				<?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('controller' => 'direccions', 'action' => 'edit', $direccion['id']),array('escape'=>false, 'title'=>'Editar Dirección de Programa')); ?>
                                <?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('controller' => 'direccions', 'action' => 'delete', $direccion['id']), array('escape'=>false, 'title'=>'Eliminar Dirección de Programa','id'=>'borrar')); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div id="carreras" class="related">
    
	<?php if (!empty($area['Carrera'])): ?>
    
    
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Codigo'); ?></th>
		<th class="actions"></th>
	</tr>
	<?php
		$i = 0;
		foreach ($area['Carrera'] as $carrera): ?>
		<tr>
			<td><?php echo $carrera['id']; ?></td>
			<td><?php echo $carrera['nombre']; ?></td>
			<td><?php echo $carrera['codigo']; ?></td>
			<td class="acciones">
                                <?php echo $this->Html->link($this->element('icono',array('icono'=>'ver','label'=>'Ver')), array('controller' => 'carreras', 'action' => 'view', $carrera['id']),array('escape'=>false, 'title'=>'Ver Carrera')); ?>
				<?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('controller' => 'carreras', 'action' => 'edit', $carrera['id']),array('escape'=>false, 'title'=>'Editar Carrera')); ?>
                                <?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('controller' => 'carreras', 'action' => 'delete', $carrera['id']), array('escape'=>false, 'title'=>'Eliminar Carrera','id'=>'borrar')); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>


</div>

<div id="docentes" class="related">
        <div id="paginacion">
        <?php echo $this->requestAction(array('controller' => 'docentes', 'action' => 'index',$area['Area']['id']),array('return')); ?>
        </div>
</div>
</div>
<?php if($tabActivo){ ?>
    <script> $( "#tabsContenido" ).tabs({ active: <?php echo $tabActivo?> }); </script>
<?php } ?>
</div>

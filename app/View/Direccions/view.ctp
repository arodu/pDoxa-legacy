<div id="accordionContenido">
    <h3><?php echo __('Dirección'); ?></h3>

    <div class="direccions view">
        
        <?php echo $this->element('migajas'); ?>

            <dl>
                    <dt><?php echo __('Id'); ?></dt>
                    <dd>
                            <?php echo h($direccion['Direccion']['id']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Nombre'); ?></dt>
                    <dd>
                            <?php echo h($direccion['Direccion']['nombre']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Area'); ?></dt>
                    <dd>
                            <?php echo h($direccion['Area']['nombre']); ?>
                            &nbsp;
                    </dd>
            </dl>

        <div class="acciones">
                <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $direccion['Direccion']['id']),array('escape'=>false, 'title'=>'Editar Dirección')); ?> </span>
                <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $direccion['Direccion']['id']), array('escape'=>false, 'title'=>'Eliminar Dirección','id'=>'borrar')); ?></span>
                <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Departamento')), array('controller' => 'departamentos', 'action' => 'add', $direccion['Direccion']['id']),array('escape'=>false, 'title'=>'Agregar Nuevo Departamento')); ?> </span>
        </div>
<br/>
        
<div id="tabsInformacion">
    <ul>
        <li><a href="#departamentos">Departamentos</a></li><!-- tab 0 -->
    </ul>
    
    <div id="departamentos" class="related">
                <?php if (!empty($direccion['Departamento'])): ?>
                <table cellpadding = "0" cellspacing = "0">
                <tr>
                        <th><?php echo __('Id'); ?></th>
                        <th><?php echo __('Nombre'); ?></th>
                        <th class="actions"></th>
                </tr>
                <?php
                        $i = 0;
                        foreach ($direccion['Departamento'] as $departamento): ?>
                        <tr>
                                <td><?php echo $departamento['id']; ?></td>
                                <td><?php echo $departamento['nombre']; ?></td>
                                <td class="acciones">
                                        <?php echo $this->Html->link($this->element('icono',array('icono'=>'circle-check','label'=>'Ver')), array('controller' => 'departamentos', 'action' => 'view', $departamento['id']),array('escape'=>false, 'title'=>'Ver Departamento')); ?>
                                        <?php echo $this->Html->link($this->element('icono',array('icono'=>'pencil','label'=>'Editar')), array('controller' => 'departamentos', 'action' => 'edit', $departamento['id']),array('escape'=>false, 'title'=>'Editar Departamento')); ?>
                                        <?php echo $this->Html->link($this->element('icono',array('icono'=>'trash','label'=>'Eliminar')), array('controller' => 'departamentos', 'action' => 'delete', $departamento['id']), array('escape'=>false, 'title'=>'Eliminar Departamento','id'=>'borrar')); ?>
                                </td>
                        </tr>
                <?php endforeach; ?>
                </table>
        <?php endif; ?>
        </div>
</div>
    </div>

</div>

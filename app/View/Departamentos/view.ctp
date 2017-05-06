<div id="accordionContenido">
    <h3><?php  echo __('Departamento'); ?></h3>

        <div class="departamentos view">
        <?php echo $this->element('migajas'); ?>

                <dl>
                        <dt><?php echo __('Nombre'); ?></dt>
                        <dd>
                                <?php echo h($departamento['Departamento']['nombre']); ?>
                                &nbsp;
                        </dd>
                        <dt><?php echo __('Direccion'); ?></dt>
                        <dd>
                                <?php echo h($departamento['Direccion']['nombre']); ?>
                                &nbsp;
                        </dd>
                </dl>
            
            <div class="acciones">
                
		<span><?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $departamento['Departamento']['id']),array('escape'=>false, 'title'=>'Editar Departamento')); ?></span>
		<span><?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $departamento['Departamento']['id']), array('escape'=>false, 'title'=>'Eliminar Departamento','id'=>'borrar')); ?></span>
            </div>
            <br/>
        
    <div id="tabsInformacion">
        <ul>
            <li><a href="#materias">Materias</a></li><!-- tab 0 -->
        </ul>

        <div id="materias" class="related">
                    <?php if (!empty($departamento['Materia'])): ?>
                        <table cellpadding = "0" cellspacing = "0">
                            <tr>
                                    <th><?php echo __('Id'); ?></th>
                                    <th><?php echo __('Codigo'); ?></th>
                                    <th><?php echo __('Nombre'); ?></th>
                                    <th><?php echo __('Pensum'); ?></th>
                                    <th><?php echo __('Nivel'); ?></th>
                                    <th class="actions"></th>
                            </tr>
                                <?php
                                        $i = 0;
                                        foreach ($departamento['Materia'] as $materia): ?>
                                        <tr>
                                                <td><?php echo $materia['Materia']['id']; ?></td>
                                                <td><?php echo $materia['Materia']['codigo']; ?></td>
                                                <td><?php echo $materia['Materia']['nombre']; ?></td>
                                                <td><?php echo $materia['Pensum']['nombre']; ?></td>
                                                <td><?php echo $materia['Materia']['nivel'].' '.$materia['Pensum']['regimen']; ?></td>
                                                <td class="acciones">
                                                        <?php echo $this->Html->link($this->element('icono',array('icono'=>'ver','label'=>'Ver')), array('controller' => 'materias', 'action' => 'view', $materia['Materia']['id']),array('escape'=>false, 'title'=>'Ver Materia')); ?>
                                                        <?php // echo $this->Html->link(__('Edit'), array('controller' => 'materias', 'action' => 'edit', $materia['id'])); ?>
                                                        <?php // echo $this->Form->postLink(__('Delete'), array('controller' => 'materias', 'action' => 'delete', $materia['id']), null, __('Are you sure you want to delete # %s?', $materia['id'])); ?>
                                                </td>
                                        </tr>
                                <?php endforeach; ?>
                                </table>
                        <?php endif; ?>
        </div>

            
    </div>
</div>
</div>
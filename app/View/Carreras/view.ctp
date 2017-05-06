<div id="accordionContenido">
    <h3><?php echo h($carrera['Area']['nombre']." / ".$carrera['Carrera']['nombre']); ?></h3>

    <div class="carreras view">

        <?php echo $this->element('migajas'); ?>

        <dl>
            <dt><?php echo __('Nombre'); ?></dt>
            <dd><?php echo h($carrera['Carrera']['nombre']); ?>&nbsp;</dd>

            <dt><?php echo __('Codigo'); ?></dt>
            <dd><?php echo h($carrera['Carrera']['codigo']); ?>&nbsp;</dd>

        </dl>

        <div class="acciones buttonset">
            <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $carrera['Carrera']['id']),array('escape'=>false, 'title'=>'Editar Carrera')); ?> </span>
            <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('controller' => 'carreras', 'action' => 'delete', $carrera['Carrera']['id']), array('escape'=>false, 'title'=>'Eliminar Carrera','id'=>'borrar')); ?></span>
            <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Pensum')), array('controller' => 'pensums', 'action' => 'add',$carrera['Carrera']['id']),array('escape'=>false, 'title'=>'Agregar Nuevo Pensum de Estudio')); ?> </span>
        </div>

        <br/>

        <div id="tabsInformacion">
            <ul>
                <li><a href="#pensums">Pensums de Estudios</a></li><!-- tab 0 -->
            </ul>

            <div id="pensums" class="related">
                    <?php if (!empty($carrera['Pensum'])): ?>
                    <table cellpadding = "0" cellspacing = "0">
                    <tr>
                            <th><?php echo __('Id'); ?></th>
                            <th><?php echo __('Nombre'); ?></th>
                            <th><?php echo __('Regimen');?></th>
                            <th><?php echo __('Fecha'); ?></th>
                            <th class="actions"></th>
                    </tr>
                    <?php
                            $i = 0;
                            foreach ($carrera['Pensum'] as $pensum): ?>
                            <tr>
                                    <td><?php echo $pensum['id']; ?></td>
                                    <td><?php echo $pensum['nombre']; ?></td>
                                    <td><?php echo $pensum['regimen']; ?></td>
                                    <td><?php echo $pensum['fecha']; ?></td>
                                    <td class="acciones">
                                            <?php echo $this->Html->link($this->element('icono',array('icono'=>'ver','label'=>'Ver')), array('controller' => 'pensums', 'action' => 'view', $pensum['id']),array('escape'=>false, 'title'=>'Ver Pensum de Estudio')); ?>
                                            <?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('controller' => 'pensums', 'action' => 'edit', $pensum['id']),array('escape'=>false, 'title'=>'Editar Pensum de Estudio')); ?>
                                            <?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('controller' => 'pensums', 'action' => 'delete', $pensum['id']), array('escape'=>false, 'title'=>'Eliminar Pensum de Estudio','id'=>'borrar')); ?>
                                    </td>
                            </tr>
                    <?php endforeach; ?>
                    </table>
            <?php endif; ?>

            </div>
        </div>
    </div>
</div>
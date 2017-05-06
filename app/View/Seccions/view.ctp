<div id="accordionContenido">
    <h3>Sección</h3>
    <div class="seccions view">
            <div class="acciones"><?php echo $this->Html->link($this->element('icono',array('icono'=>'listar','label'=>'Lista de Secciones')), array('action' => 'index'),array('escape'=>false)); ?></div>
            <hr/>

            <dl>
                    <dt><?php echo __('Materia'); ?></dt>
                    <dd>
                            <?php echo h($seccion['Materia']['nombre']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Sección'); ?></dt>
                    <dd>
                            <?php echo h($seccion['Seccion']['nombre']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Docente'); ?></dt>
                    <dd>
                        <?php
                            if (!empty($seccion['Docente'])){
                                foreach ($seccion['Docente'] as $docente){ 
                                    echo $docente['nombres'].' '.$docente['apellidos'];
                                    echo '<br/>';
                                }
                            }else{
                                echo '&nbsp;';
                            }
                        ?>
                    </dd>
                    <dt><?php echo __('Cupo'); ?></dt>
                    <dd>
                            <?php echo h($seccion['Seccion']['cupo']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Turno'); ?></dt>
                    <dd>
                            <?php echo h($seccion['Turno']['nombre']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Actualizado'); ?></dt>
                    <dd>
                            <?php echo h($seccion['Seccion']['updated']); ?>
                            &nbsp;
                    </dd>

            </dl>

            <div class="acciones">
               <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $seccion['Seccion']['id']), array('escape'=>false, 'title'=>'Modificar Sección')); ?></span>
               <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $seccion['Seccion']['id']), array('escape'=>false, 'title'=>'Eliminar Sección','id'=>'borrar')); ?></span>
            </div>

            <div class="related">
                    <h3><?php echo __('Encuentros'); ?></h3>
                    <?php if (!empty($seccion['Encuentro'])): ?>
                    <table cellpadding = "0" cellspacing = "0">
                    <tr>
                            <th><?php echo __('Id'); ?></th>
                            <th><?php echo __('Materia Id'); ?></th>
                            <th><?php echo __('Cant Horas'); ?></th>
                            <th><?php echo __('Tipo Aula Id'); ?></th>
                    </tr>
                    <?php foreach ($seccion['Encuentro'] as $encuentro): ?>
                            <tr>
                                    <td><?php echo $encuentro['id']; ?></td>
                                    <td><?php echo $encuentro['materia_id']; ?></td>
                                    <td><?php echo $encuentro['cant_horas']; ?></td>
                                    <td><?php echo $encuentro['tipo_aula_id']; ?></td>
                            </tr>
                    <?php endforeach; ?>
                    </table>
            <?php endif; ?>
            </div>
    </div>
</div>
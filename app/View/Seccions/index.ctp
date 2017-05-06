<div id="accordionContenido">
	<h3>Indice de Secciones</h3>
        <div id="paginacionContent" class="seccions index">
        <div class="acciones"><?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Agregar Nueva Sección')), array('action' => 'add'),array('escape'=>false)); ?></div>
        <hr/>
        <div>
            <span class="paginas buttonset">
            <?php
                echo $this->Paginator->prev(__('<<'), array(), null, array('class' => 'prev disabled'));
                echo '&nbsp;';
                echo $this->Paginator->numbers(array('separator' => '&nbsp;'));
                echo '&nbsp;';
                echo $this->Paginator->next(__('>>'), array(), null, array('class' => 'next disabled'));
            ?>
            </span>
            <span><?php echo $this->element('contadorPaginas');?></span>
        </div>
         <table>
         <tr class="ordenar">
               <th><?php echo $this->Paginator->sort('Seccion.nombre','Sección'); ?></th>
               <th><?php echo $this->Paginator->sort('Materia.nombre','Materia'); ?></th>
               <th><?php echo $this->Paginator->sort('Materia.nivel','Nivel'); ?></th>
               <th><?php echo $this->Paginator->sort('Seccion.cupo','Cupos'); ?></th>
               <th><?php echo $this->Paginator->sort('Seccion.turno_id','Turno'); ?></th>
               <th>Docentes</th>
               <th class="actions"></th>
               </tr>
         <?php
         foreach ($seccions as $seccion): ?>
         <tr>
            <td>
               <?php echo $seccion['Seccion']['nombre']; ?>
               <?php // echo $this->Html->link($seccion['SeccionDetalle']['nombre'], array('label'=>'Secci&oacute;n','controller' => 'seccion_detalles', 'action' => 'view', $seccion['SeccionDetalle']['id'])); ?>
            </td>
            <td>
               <?php echo $seccion['Materia']['nombre'];?>
               <?php // echo $this->Html->link($seccion['Materia']['nombre'], array('controller' => 'materias', 'action' => 'view', $seccion['Materia']['id'])); ?>
            </td>
            <td>
               <?php echo $seccion['Materia']['nivel'];?>
               <?php // echo $this->Html->link($seccion['Materia']['nombre'], array('controller' => 'materias', 'action' => 'view', $seccion['Materia']['id'])); ?>
            </td>
            <td><?php echo h($seccion['Seccion']['cupo']); ?>&nbsp;</td>
            <td>
               <?php echo $seccion['Turno']['nombre'];?>
               <?php // echo $this->Html->link($seccion['Turno']['nombre'], array('controller' => 'turnos', 'action' => 'view', $seccion['Turno']['id'])); ?>
            </td>
            <td>
               <?php foreach($seccion['Docente'] as $docente){
                   echo $docente['nombres'].'&nbsp;'.$docente['apellidos'].'<br/>';
               }?>
            </td>
            <td class="acciones">
               <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'ver','label'=>'Ver')), array('action' => 'view', $seccion['Seccion']['id']), array('escape'=>false)); ?></span>
               <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $seccion['Seccion']['id']), array('escape'=>false, 'title'=>'Modificar Sección')); ?></span>
               <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $seccion['Seccion']['id']), array('escape'=>false, 'title'=>'Eliminar Sección','id'=>'borrar')); ?></span>
            </td>
         </tr>
      <?php endforeach; ?>
         </table>
        
        <br/>
        <span class="paginas buttonset">
        <?php
            echo $this->Paginator->prev(__('<<'), array(), null, array('class' => 'prev disabled'));
            echo '&nbsp;';
            echo $this->Paginator->numbers(array('separator' => '&nbsp;'));
            echo '&nbsp;';
            echo $this->Paginator->next(__('>>'), array(), null, array('class' => 'next disabled'));
        ?>
        </span>
        <span><?php echo $this->element('contadorPaginas');?></span>
        
        
      </div>
</div>
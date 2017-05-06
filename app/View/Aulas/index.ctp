<div id="accordionContenido">
	<h3>Indice de Aulas</h3>
        <div id="paginacionContent" class="aulas index">
        <div class="acciones"><?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Agregar Nueva Aula')), array('action' => 'add'),array('escape'=>false)); ?></div>
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
        
        
        <table>
            <tr class="ordenar">
               <th><?php echo $this->Paginator->sort('Aula.nombre','Sección'); ?></th>
               <th><?php echo $this->Paginator->sort('Aula.tipo_aula_id','Tipo de Aula'); ?></th>
               <th><?php echo $this->Paginator->sort('Aula.ubicacion_id','Ubicacion'); ?></th>
               <th class="actions"></th>
            </tr>
         <?php
         foreach ($aulas as $aula): ?>
         <tr>
            <td>
               <?php echo $aula['Aula']['nombre']; ?>
               <?php // echo $this->Html->link($seccion['SeccionDetalle']['nombre'], array('label'=>'Secci&oacute;n','controller' => 'seccion_detalles', 'action' => 'view', $seccion['SeccionDetalle']['id'])); ?>
            </td>
            <td>
               <?php echo $aula['TipoAula']['nombre'];?>
               <?php // echo $this->Html->link($seccion['Materia']['nombre'], array('controller' => 'materias', 'action' => 'view', $seccion['Materia']['id'])); ?>
            </td>
            <td>
               <?php echo $aula['Ubicacion']['nombre'];?>
               <?php // echo $this->Html->link($seccion['Materia']['nombre'], array('controller' => 'materias', 'action' => 'view', $seccion['Materia']['id'])); ?>
            </td>
            <td class="acciones">
               <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'ver','label'=>'Ver')), array('action' => 'maestroAulaUnica', $aula['Aula']['id']), array('escape'=>false)); ?></span>
               <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $aula['Aula']['id']), array('escape'=>false, 'title'=>'Modificar Aula')); ?></span>
               <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $aula['Aula']['id']), array('escape'=>false, 'title'=>'Eliminar Aula','id'=>'borrar')); ?></span>
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

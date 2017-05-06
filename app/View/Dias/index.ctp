<span id="url" class="no-print no-screen"><?php echo $this->Html->url(array('controller'=>'dias','action'=>'index',$esquemaDia_id));?></span>
   <?php if (!empty($dias)): ?>
         <table cellpadding = "0" cellspacing = "0">
         <tr>
<!--            <th><?php echo __('Id'); ?></th> -->
            <th><?php echo __('Numero'); ?></th>
            <th><?php echo __('Nombre'); ?></th>
<!--            <th><?php echo __('Esquema Dia Id'); ?></th> -->
            <th class="actions"><?php echo __('Acciones'); ?></th>
         </tr>
         <?php
            $i = 0;
            foreach ($dias as $dia): ?>
            <tr>
<!--               <td><?php echo $dia['Dia']['id']; ?></td> -->
               <td><?php echo $dia['Dia']['numero']; ?></td>
               <td><?php echo $dia['Dia']['nombre']; ?></td>
<!--               <td><?php echo $dia['Dia']['esquema_dia_id']; ?></td> -->
               <td>
                     <?php // echo $this->Html->link(__('View'), array('controller' => 'dias', 'action' => 'view', $dia['id'])); ?>
                  <span class="abrir-formulario boton">
                     <?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('controller'=>'dias','action' => 'edit', $dia['Dia']['id']),array('escape'=>false,'title'=>'Modificar Día')); ?>
                     <?php // echo $this->Html->link(__('Edit'), array('controller' => 'dias', 'action' => 'edit', $dia['Dia']['id'])); ?>
                  </span>
                  <span class="acciones">
                     <?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('controller' => 'dias', 'action' => 'delete', $dia['Dia']['id'], $dia['Dia']['esquema_dia_id']), array('escape'=>false, 'title'=>'Eliminar Día','id'=>'borrar')); ?>
                     <?php // echo $this->Form->postLink(__('Delete'), array('controller' => 'dias', 'action' => 'delete', $dia['Dia']['id']), null, __('Are you sure you want to delete # %s?', $dia['Dia']['id'])); ?>
                  </span>
               </td>
            </tr>
         <?php endforeach; ?>
         </table>
      <?php endif; ?>
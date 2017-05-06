<div id="accordionContenido">
   <h2><?php echo __('Esquema Horas'); ?></h2>
      <div class="esquemaHoras index">
         <div class="acciones">
            <?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Agregar Esquema de Horas')), array('action' => 'add'),array('escape'=>false)); ?>
         </div>
         <hr />
         <table cellpadding="0" cellspacing="0">
         <tr>
               <th>No.</th>
               <th>Esquemas</th>
               <th>Hora Intermedia</th>
               <th class="actions"><?php echo __('Acciones'); ?></th>
         </tr>
         <?php
         foreach ($esquemaHoras as $esquemaHora): ?>
         <tr>
            <td><?php echo h($esquemaHora['EsquemaHora']['id']); ?>&nbsp;</td>
            <td><?php echo h($esquemaHora['EsquemaHora']['nombre']); ?>&nbsp;</td>
            <td><?php echo h($esquemaHora['EsquemaHora']['sep_num']); ?>&nbsp;</td>
            <td>
               <div class="acciones">
                  <?php echo $this->Html->link($this->element('icono',array('icono'=>'ver','label'=>'Ver')), array('action' => 'view', $esquemaHora['EsquemaHora']['id']),array('escape'=>false,'title'=>'Ver Esquema de Horas')); ?>
                  <?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $esquemaHora['EsquemaHora']['id']),array('escape'=>false,'title'=>'Modificar Esquema de Horas')); ?>
                  <?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $esquemaHora['EsquemaHora']['id']), array('escape'=>false, 'title'=>'Eliminar Esquema de Horas','id'=>'borrar')); ?>
               </div>
            </td>
         </tr>
      <?php endforeach; ?>
         </table>
      </div>
</div>
<div id="accordionContenido">
   <h2><?php echo __('Esquema Dias'); ?></h2>
      <div class="esquemaDias index">
         <div class="acciones">
            <?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Agregar Esquema de Dias')), array('action' => 'add'),array('escape'=>false)); ?>
         </div>
         <hr />
         <table cellpadding="0" cellspacing="0">
         <tr>
               <th>No.</th>
               <th>Esquemas</th>
               <th class="actions"><?php echo __('Acciones'); ?></th>
         </tr>
         <?php
         foreach ($esquemaDias as $esquemaDia): ?>
         <tr>
            <td><?php echo h($esquemaDia['EsquemaDia']['id']); ?>&nbsp;</td>
            <td><?php echo h($esquemaDia['EsquemaDia']['nombre']); ?>&nbsp;</td>
            <td>
               <div class="acciones">
                  <?php echo $this->Html->link($this->element('icono',array('icono'=>'ver','label'=>'Ver')), array('action' => 'view', $esquemaDia['EsquemaDia']['id']),array('escape'=>false,'title'=>'Ver Esquema de Dias')); ?>
                  <?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $esquemaDia['EsquemaDia']['id']),array('escape'=>false,'title'=>'Modificar Esquema de Dias')); ?>
                  <?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $esquemaDia['EsquemaDia']['id']), array('escape'=>false, 'title'=>'Eliminar Esquema de Dias','id'=>'borrar')); ?>
               </div>
            </td>
         </tr>
      <?php endforeach; ?>
         </table>
      </div>
</div>

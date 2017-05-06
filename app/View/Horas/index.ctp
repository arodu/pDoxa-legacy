
<div class="no-screen">
<?php echo $this->element('encabezado'); ?>
<hr/>
<h1>
    <?php echo $esquemaHora['EsquemaHora']['nombre'];?>
</h1>
</div>

<span id="url" class="no-print no-screen"><?php echo $this->Html->url(array('controller'=>'horas','action'=>'index',$esquemaHora_id));?></span>

<?php if (!empty($horas)): ?>
    <table style="width: 100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Turnos</th>
                    <th class="actions no-print"><?php echo __('Acciones'); ?></th>
                </tr>
            </thead>
            <tbody>
	<?php
	foreach ($horas as $hora): ?>
        <tr>
            <td><?php echo h($hora['Hora']['numero']); ?>&nbsp;</td>
            <td><?php echo date('h:i a',  strtotime($hora['Hora']['inicio'])); ?>&nbsp;</td>
            <td><?php echo date('h:i a',  strtotime($hora['Hora']['fin'])); ?>&nbsp;</td>
            <td><?php
               $ct = count($hora['Turno']);
               for($i=0; $i < $ct; $i++){
                  $turno = $hora['Turno'][$i];
                  echo $turno['nombre'];
                  if($i != $ct-1){
                     echo '<br class="no-print"/>';
                     echo '<span class="no-screen"> - </span>';
                  }
               }
            ?>
            &nbsp;</td>
            <td class="no-print">
               <span class="abrir-formulario boton">
                  <?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('controller'=>'horas','action' => 'edit', $hora['Hora']['id']),array('escape'=>false,'title'=>'Modificar Hora')); ?>
               </span>
               <span class="acciones">
                  <?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('controller' => 'horas', 'action' => 'delete', $hora['Hora']['id'], $esquemaHora_id), array('escape'=>false, 'title'=>'Eliminar Hora','id'=>'borrar')); ?>
               </span>
            </td>
         </tr>
<?php if($hora['Hora']['numero'] == $esquemaHora['EsquemaHora']['sep_num']){ ?>
         <tr>
             <td colspan="5" style="text-align: center;">
                 <span style="font-size: .8em;">&lt;Intermedio&gt;</span>
             </td>
         </tr>
<?php } ?>
   
   
<?php endforeach; ?>
         </tbody>
	</table>
<?php endif; ?>

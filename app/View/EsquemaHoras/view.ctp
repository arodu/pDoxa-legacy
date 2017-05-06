<div id="accordionContenido">
<h3><?php  echo __('Esquema Hora'); ?></h3>
      <div class="esquemaHoras view">
         <span class="no-print">
         <dl>
            <dt><?php echo __('Nombre'); ?></dt>
            <dd>
               <?php echo h($esquemaHora['EsquemaHora']['nombre']); ?>
               &nbsp;
            </dd>
            <dt><?php echo __('Hora Intermedia'); ?></dt>
            <dd>
               <?php echo h($esquemaHora['EsquemaHora']['sep_num']); ?>
               &nbsp;
            </dd>            
         </dl>
        <span class="buttonset">
        <span class="acciones">
           <?php echo $this->Html->link($this->element('icono',array('icono'=>'volver','label'=>'Volver')), array('action' => 'index'),array('escape'=>false,'title'=>'Regresar al Indice')); ?>
           <?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Modificar')), array('action' => 'edit', $esquemaHora['EsquemaHora']['id']),array('escape'=>false,'title'=>'Modificar Esquema de Horas')); ?>
           <?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $esquemaHora['EsquemaHora']['id']), array('escape'=>false, 'title'=>'Eliminar Esquema de Horas','id'=>'borrar')); ?>
        </span>
        <span class="abrir-formulario boton">
           <?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Agregar Nueva Hora')), array('controller'=>'horas','action' => 'add', $esquemaHora['EsquemaHora']['id']), array('escape'=>false, 'title'=>'Agregar Nueva Hora')); ?>
        </span>
        <span class="boton popup">
            <?php echo $this->Html->link($this->element('icono',array('icono'=>'imprimir','label'=>'Vista de Impresi&oacute;n')), array('controller'=>'horas','action' => 'index',$esquemaHora['EsquemaHora']['id']), array('escape'=>false, 'title'=>'Vista de Impresión')); ?>
        </span>
        </span>

      <h3><?php echo __('Horas del Esquema'); ?></h3>
    </span>
      <div id="relacionados">
         <?php echo $this->requestAction('horas/index/'.$esquemaHora['EsquemaHora']['id'],array('return')); ?>
      </div>
   </div>
</div>

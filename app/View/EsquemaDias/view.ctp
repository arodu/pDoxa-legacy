<div id="accordionContenido">
<h3><?php  echo __('Esquema Dia'); ?></h3>
      <div class="esquemaDias view">
         <dl>
            <dt><?php echo __('Id'); ?></dt>
            <dd>
               <?php echo h($esquemaDia['EsquemaDia']['id']); ?>
               &nbsp;
            </dd>
            <dt><?php echo __('Nombre'); ?></dt>
            <dd>
               <?php echo h($esquemaDia['EsquemaDia']['nombre']); ?>
               &nbsp;
            </dd>
            <dt><?php echo __('Opciones'); ?></dt>
            <dd>
                <span class="buttonset">
                    <span class="acciones">
                       <?php echo $this->Html->link($this->element('icono',array('icono'=>'volver','label'=>'Volver')), array('action' => 'index'),array('escape'=>false,'title'=>'Regresar al Indice')); ?>
                       <?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Modificar')), array('action' => 'edit', $esquemaDia['EsquemaDia']['id']),array('escape'=>false,'title'=>'Modificar Esquema de Dias')); ?>
                       <?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $esquemaDia['EsquemaDia']['id']), array('escape'=>false, 'title'=>'Eliminar Esquema de Dias','id'=>'borrar')); ?>
                    </span>
                    <span class="abrir-formulario boton">
                         <?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Agregar Día')), array('controller'=>'dias','action' => 'add', $esquemaDia['EsquemaDia']['id']),array('escape'=>false,'title'=>'Agregar Día')); ?>
                    </span>
                </span>
            </dd>
         </dl>
         <hr />
      
      <h3><?php echo __('Dias del Esquema'); ?></h3>


      

      <div id="relacionados">
         <?php echo $this->requestAction('dias/index/'.$esquemaDia['EsquemaDia']['id'],array('return')); ?>
      </div>
   </div>
</div>
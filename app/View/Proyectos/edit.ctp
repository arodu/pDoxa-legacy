<div id="accordionContenido">
	<h3>Modificar Proyecto</h3>
      <div class="proyectos form">
		<?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
         <?php
            echo $this->Form->input('id');
            echo $this->Form->input('nombre');
//            echo $this->Form->input('pensum_id');
            echo $this->Form->input('lapso_academico');
            echo $this->Form->input('fecha');

            echo '<hr>';

            echo $this->Form->input('fecha_memo',array('after'=>'<small>Fecha de Impresion de la Carga Docente</small>'));

            echo $this->Form->input('observaciones',array('after'=>'<small>Observaciones a imprimir al final del resumen, colocar el texto en formato HTML</small>','style'=>'width: 95%;'));

         ?>
      <?php echo $this->Form->end(__('Guardar Cambios')); ?>
      </div>
   
<!--   <h3><?php echo __('Actions'); ?></h3>
      <div class="actions">      
         <ul>

            <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Proyecto.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Proyecto.id'))); ?></li>
            <li><?php echo $this->Html->link(__('List Proyectos'), array('action' => 'index')); ?></li>
            <li><?php echo $this->Html->link(__('List Pensums'), array('controller' => 'pensums', 'action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('New Pensum'), array('controller' => 'pensums', 'action' => 'add')); ?> </li>
            <li><?php echo $this->Html->link(__('List Aulas'), array('controller' => 'aulas', 'action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('New Aula'), array('controller' => 'aulas', 'action' => 'add')); ?> </li>
            <li><?php echo $this->Html->link(__('List Seccions'), array('controller' => 'seccions', 'action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('New Seccion'), array('controller' => 'seccions', 'action' => 'add')); ?> </li>
         </ul>
      </div> -->
</div>
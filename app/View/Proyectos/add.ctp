<div id="accordionContenido">
	<h3>Crear Nuevo Proyecto</h3>
      <div class="proyectos form">
	<?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
         <?php
            echo $this->Form->input('nombre');
            echo $this->Form->input('pensum_id', array('empty'=>'<-- Seleccione -->'));
            echo $this->Form->input('lapso_academico');
            echo $this->Form->input('fecha');
         ?>
        <?php echo $this->Form->end(__('Guardar Nuevo Proyecto')); ?>
      </div>
      
<!--	<h3>Acciones</h3>
      <div class="actions">
         <ul>

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
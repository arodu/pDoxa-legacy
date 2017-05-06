<div id="accordionContenido">
	<h3>Nueva Aula</h3>
      <div class="aulas form">
      <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
         <?php
            echo $this->Form->hidden('proyecto_id',array('value'=>$proyecto));
            echo $this->Form->input('nombre',array('title'=>'Puede ingresar varias Aulas Separadas por coma ","'));
            echo $this->Form->input('tipo_aula_id', array('empty'=>'<-- Seleccione -->','title'=>'Tipos de Aulas'));
            echo $this->Form->input('esquema_dia_id', array('empty'=>'<-- Seleccione -->'));
            echo $this->Form->input('esquema_hora_id', array('empty'=>'<-- Seleccione -->'));
            echo $this->Form->input('ubicacion_id', array('empty'=>'<-- Seleccione -->','label'=>'Ubicación Fisica'));
         ?>
      <?php echo $this->Form->end(__('Crear Aula'));?>
      </div>
</div>
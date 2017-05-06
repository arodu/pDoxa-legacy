<div id="accordionContenido">
   <h3>Modificar Esquema de Dias</h3>
      <div class="esquemaDias form">
      <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
         <?php
            echo $this->Form->input('id');
            echo $this->Form->input('nombre');
         ?>
      <?php echo $this->Form->end(__('Guardar')); ?>
      </div>
</div>
<div id="accordionContenido">
   <h3>Modificar Esquema de Horas</h3>
   <div class="esquemaHoras form">
         <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
            <?php
               echo $this->Form->input('id');
               echo $this->Form->input('nombre');
               echo $this->Form->input('sep_num',array('label'=>'Hora Intermedia'));
            ?>
         <?php echo $this->Form->end(__('Guardar')); ?>
   </div>
</div>

<?php if(@$ok){
   echo 'ok';
}else{ ?>
   <div class="dias form">
      <?php echo $this->Form->create(array('id'=>'formularioDialog')); ?>
      <?php
         echo $this->Form->input('id');
         echo $this->Form->input('numero');
         echo $this->Form->input('nombre',array('options'=>array('Domingo'=>'Domingo','Lunes'=>'Lunes','Martes'=>'Martes','Miercoles'=>'Miercoles','Jueves'=>'Jueves','Viernes'=>'Viernes','Sabado'=>'Sabado'),'empty'=>'<-- Seleccione -->'));
      ?>
   <?php echo $this->Form->end(); ?>
   </div>
<?php } ?>
<?php if(@$ok){
   echo 'ok';
}else{ ?>
      <div class="horas form">
      <?php echo $this->Form->create(array('id'=>'formularioDialog')); ?>
         <?php
            echo $this->Form->input('id');
            echo $this->Form->input('numero');
            echo $this->Form->input('inicio');
            echo $this->Form->input('fin');
            echo $this->Form->input('Turno');
         ?>
      <?php echo $this->Form->end(); ?>
      </div>
<?php } ?>
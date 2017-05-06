<div id="accordionContenido">
    <h3>Nombre de Usuario y Contraseña</h3>
    <div class="users form">
    <?php
        echo $this->Session->flash();
        
        echo $this->Form->create('User');
            echo $this->Form->input('username', array('label'=>$this->element('icono',array('icono'=>'person','label'=>'Nombre de Usuario'))));
            echo $this->Form->input('password', array('label'=>$this->element('icono',array('icono'=>'locked','label'=>'Contraseña'))));
        echo $this->Form->end(__('Ingresar'));
        
        if($mensaje = $this->Session->flash('auth')){
            echo $this->element('alerta',array('titulo'=>'Alerta','mensaje'=>$mensaje));
        }
//        echo $this->Session->flash('auth');
    ?>
    </div>
</div>
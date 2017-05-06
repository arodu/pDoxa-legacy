<div id="accordionContenido">
    <h3><?php echo __('Editar Contraseña') ?></h3>
    
    <div class="users form">

        <dl>
            <dt><?php echo __('Usuario'); ?></dt>
            <dd>
                    <?php echo $this->request->data['User']['username']; ?>
                    &nbsp;
            </dd>
        </dl>
        <hr/>
    <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
            <?php
                    echo $this->Form->input('id');
                    echo $this->Form->input('password_new',array('label'=>'Nueva Contraseña','type'=>'password','require'=>true));
                    echo $this->Form->input('password_confirm',array('label'=>'Confirme Nueva Contraseña','type'=>'password','require'=>true));

                    if($usuario['isAdmin']){
                        echo $this->Form->input('password_old',array('label'=>'Ingrese Contraseña del Administrador','type'=>'password','require'=>true));
                    }else{
                        echo $this->Form->input('password_old',array('label'=>'Ingrese Vieja Contraseña','type'=>'password','require'=>true));
                    }
                    //debug($datos);
            ?>
    <?php echo $this->Form->end(__('Submit')); ?>
    </div>
</div>

<div id="accordionContenido">
    <h3><?php echo __('Editar Usuario') ?></h3>
    
    <div class="users form">
    <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
            <?php
                    echo $this->Form->input('id');
                    echo $this->Form->input('username');
                    // echo $this->Form->input('password');
                    if($usuario['isAdmin']){
                        echo $this->Form->input('role', array('options' => array('admin' => 'Admin', 'user' => 'User')));
                    }
            ?>
    <?php echo $this->Form->end(__('Submit')); ?>
    </div>
</div>

<div id="accordionContenido">
    <h3><?php echo __('Usuario') ?></h3>

    <div class="users view">
            <dl>
                    <dt><?php echo __('Id'); ?></dt>
                    <dd>
                            <?php echo h($user['User']['id']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Usuario'); ?></dt>
                    <dd>
                            <?php echo h($user['User']['username']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Rol'); ?></dt>
                    <dd>
                            <?php echo h($user['User']['role']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Creado'); ?></dt>
                    <dd>
                            <?php echo h($user['User']['created']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Actualizado'); ?></dt>
                    <dd>
                            <?php echo h($user['User']['updated']); ?>
                            &nbsp;
                    </dd>
            </dl>
    
    <div class="acciones buttonset">
        <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $user['User']['id']),array('escape'=>false)); ?> </span>
        <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'contraseña','label'=>'Contraseña')), array('action' => 'editPassword', $user['User']['id']),array('escape'=>false)); ?> </span>
        
        <?php if($usuario['isAdmin']){ ?>
            <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $user['User']['id']),array('escape'=>false,'id'=>'borrar')); ?> </span>
        <?php } ?>
    </div>
    
    
    </div>
</div>

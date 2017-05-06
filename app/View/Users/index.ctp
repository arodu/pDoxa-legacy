<div id="accordionContenido">
    <h3><?php echo __('Usuarios') ?></h3>
        <div id="paginacionContent" class="users index">
            
        <div class="acciones"><?php echo $this->Html->link($this->element('icono',array('icono'=>'agregar','label'=>'Agregar Nuevo Usuario')), array('action' => 'add'),array('escape'=>false)); ?></div>
        <hr/>

        <div>
            <span class="paginas buttonset">
            <?php
                echo $this->Paginator->prev(__('<<'), array(), null, array('class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => '&nbsp;','before'=>'&nbsp;','after'=>'&nbsp;'));
                echo $this->Paginator->next(__('>>'), array(), null, array('class' => 'next disabled'));
            ?>
            </span>
            <span><?php echo $this->element('contadorPaginas');?></span>
        </div>
        
        
        <table cellpadding="0" cellspacing="0">
            <tr class="ordenar">
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('username'); ?></th>
                <th><?php echo $this->Paginator->sort('role'); ?></th>
                <th><?php echo $this->Paginator->sort('created'); ?></th>
                <th><?php echo $this->Paginator->sort('updated'); ?></th>
                <th class="actions"></th>
            </tr>
        <?php
        foreach ($users as $user): ?>
            <tr>
                    <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
                    <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                    <td><?php echo h($user['User']['role']); ?>&nbsp;</td>
                    <td><?php echo h($user['User']['created']); ?>&nbsp;</td>
                    <td><?php echo h($user['User']['updated']); ?>&nbsp;</td>
                    <td class="acciones">
                            <?php echo $this->Html->link($this->element('icono',array('icono'=>'ver','label'=>'Ver')), array('action' => 'view', $user['User']['id']),array('escape'=>false)); ?>
                            <?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $user['User']['id']),array('escape'=>false)); ?>
                            <?php echo $this->Html->link($this->element('icono',array('icono'=>'locked','label'=>'Contraseña')), array('action' => 'editPassword', $user['User']['id']),array('escape'=>false)); ?>
                            <?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $user['User']['id']),array('escape'=>false,'id'=>'borrar')); ?>
                            <?php // echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
                    </td>
            </tr>
    <?php endforeach; ?>
        </table>
        
        <div>
            <span class="paginas buttonset">
            <?php
                echo $this->Paginator->prev(__('<<'), array(), null, array('class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => '&nbsp;','before'=>'&nbsp;','after'=>'&nbsp;'));
                echo $this->Paginator->next(__('>>'), array(), null, array('class' => 'next disabled'));
            ?>
            </span>
            <span><?php echo $this->element('contadorPaginas');?></span>
        </div>
        
        </div>
</div>
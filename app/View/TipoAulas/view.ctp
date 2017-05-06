<div id="accordionContenido">
    <h3><?php  echo __('Ubicación Fisica'); ?></h3>

    <div class="tipoAulas view">
            <dl>
                    <dt><?php echo __('Id'); ?></dt>
                    <dd>
                            <?php echo h($tipoAula['TipoAula']['id']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Nombre'); ?></dt>
                    <dd>
                            <?php echo h($tipoAula['TipoAula']['nombre']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Descripcion'); ?></dt>
                    <dd>
                            <?php echo h($tipoAula['TipoAula']['descripcion']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Modalidad'); ?></dt>
                    <dd>
                            <?php echo h($tipoAula['TipoAula']['modalidad']); ?>
                            &nbsp;
                    </dd>
            </dl>
    
    <div class="acciones buttonset">
		<span><?php echo $this->Html->link(__('Edit Tipo Aula'), array('action' => 'edit', $tipoAula['TipoAula']['id'])); ?> </span>
		<span><?php echo $this->Form->postLink(__('Delete Tipo Aula'), array('action' => 'delete', $tipoAula['TipoAula']['id']), null, __('Are you sure you want to delete # %s?', $tipoAula['TipoAula']['id'])); ?> </span>
		<span><?php echo $this->Html->link(__('List Tipo Aulas'), array('action' => 'index')); ?> </span>
		<span><?php echo $this->Html->link(__('New Tipo Aula'), array('action' => 'add')); ?> </span>
    </div>
    
    
    </div>
</div>
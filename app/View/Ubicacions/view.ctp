<div id="accordionContenido">
    <h3><?php  echo __('Ubicación Fisica'); ?></h3>

    <div class="ubicacions view">
            <div class="acciones"><?php echo $this->Html->link($this->element('icono',array('icono'=>'listar','label'=>'Ubicaciones')), array('action' => 'index'),array('escape'=>false)); ?></div>
            <hr/>

        <div style="float: left; width: 50%;">
            <dl>
                    <dt><?php echo __('Id'); ?></dt>
                    <dd>
                            <?php echo h($ubicacion['Ubicacion']['id']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Nombre'); ?></dt>
                    <dd>
                            <?php echo h($ubicacion['Ubicacion']['nombre']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Descipcion'); ?></dt>
                    <dd>
                            <?php echo h($ubicacion['Ubicacion']['descripcion']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Coordenadas'); ?></dt>
                    <dd>
                            <?php echo h($ubicacion['Ubicacion']['coordenadas']); ?>
                            &nbsp;
                    </dd>
            </dl>

    <div class="acciones buttonset">
        <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Editar')), array('action' => 'edit', $ubicacion['Ubicacion']['id']),array('escape'=>false)); ?> </span>
        <span><?php echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')), array('action' => 'delete', $ubicacion['Ubicacion']['id']), array('escape'=>false, 'title'=>'Eliminar Ubicación','id'=>'borrar')); ?></span>
    </div>

            </div>

        <div style="float: right;">
            <?php
            $link = "http://maps.googleapis.com/maps/api/staticmap?zoom=16&size=500x300&maptype=hybrid&sensor=false&markers=color:red|".h($ubicacion['Ubicacion']['coordenadas']);
            echo $this->Html->image($link,array('class'=>'ui-corner-all ui-state-default'));
            ?>
        </div>

    </div>


</div>
<div id="accordionContenido">
    <h3><?php echo __('Agregar Nueva Área Académica') ?></h3>
    <div class="areas form">
        <?php
            echo $this->Form->create(array('id'=>'formularioAjax'));
                echo $this->Form->input('nombre');
                echo $this->Form->hidden('user_id',array('value'=>$user_id));

            echo $this->Form->end(__('Guardar Datos'));
        ?>
    </div>
</div>
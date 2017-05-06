<div id="accordionContenido">
    <h3>Modificar Restricciones</h3>
    <div class="proyectos form">
        <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
            <?php
                $selected = null;
                foreach($this->Session->read('Restriccion') as $clave => $restriccion){
                    $options[$clave] = $restriccion["mensaje"];
                    if($restriccion["valor"]){
                        $selected[] = $clave;
                    }
                }
                
                echo $this->Form->input("restricciones", array(
                    'label'=> 'Manejo de Restricciones',
                    'type' => 'select',
                    'options'=>$options,
                    'multiple'=>'checkbox',
                    'selected'=>$selected
                ));
            ?>
        <?php echo $this->Form->end(__('Guardar Cambios')); ?>
      </div>
</div>
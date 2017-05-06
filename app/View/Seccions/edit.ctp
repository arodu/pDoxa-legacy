<?php   if($popup){ ?>
            <div class="seccions form">
            <?php echo $this->Form->create(array('id'=>'formularioDialog')); ?>
                <?php
                    echo $this->Form->input('id');
                    echo $this->Form->input('materia_id',array('disabled'=>true,'after'=>' <span class="coment"> Bloqueado</span>'));
                    echo $this->Form->input('nombre');
                    echo $this->Form->input('cupo');
                    echo $this->Form->input('turno_id',array('empty'=>'<-- Seleccione -->'));
                    echo $this->Form->input('Docente',array('data-placeholder'=>"Seleccione Docente"));
                    echo '<br/><br/><br/>';
                ?>
            <?php echo $this->Form->end(); ?>
            </div>
<?php   }else{ ?>
            <div id="accordionContenido">
                <h3>Editar Sección</h3>
                <div class="seccions form">
                    <div class="acciones"><?php echo $this->Html->link($this->element('icono',array('icono'=>'listar','label'=>'Lista de Secciones')), array('action' => 'index'),array('escape'=>false)); ?></div>
                    <hr/>
                    <?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
                        <?php
                            echo $this->Form->input('id');
                            echo $this->Form->input('nombre');
                            echo $this->Form->input('materia_id',array('disabled'=>true,'after'=>' <span class="coment"> Bloqueado</span>'));
                            echo $this->Form->input('cupo');
                            echo $this->Form->input('turno_id',array('empty'=>'<-- Seleccione -->'));
                            echo $this->Form->input('Docente',array('data-placeholder'=>"Seleccione Docente"));
                        ?>
                   <?php echo $this->Form->end(__('Guardar Datos')); ?>
                </div>
            </div>
<?php   } ?>
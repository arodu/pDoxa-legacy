<div id="accordionContenido">
	<h3>Seleccionar Proyecto</h3>
	<div>
		<?php echo $this->Form->create(array('id'=>'formularioAjax')); ?>
		<?php echo $this->Form->input('seleccion',array('options'=>$proyectos,'label'=>'Seleccione Proyecto: ','empty'=>'<-- Seleccione -->')); ?>
		<?php echo $this->Form->end(array('label' => 'Aceptar', 'id' => 'btn-enviar')); ?>      
      <hr />
      <?php
      if(@$seleccionado){
         echo '<div class="info">';
            echo '<h2>Proyecto Seleccionado Actualmente:</h2>';
            echo '<div style="display: block;"><strong>Nombre: </strong> '.$seleccionado['Proyecto']['nombre'].'</div>';
            echo '<div style="display: block;"><strong>Lapso Acad&eacute;mico: </strong> '.$seleccionado['Proyecto']['lapso_academico'].'</div>';
            echo '<div style="display: block;"><strong>Fecha: </strong> '.date("d / m / Y",strtotime($seleccionado['Proyecto']['fecha'])).'</div>';
            echo '<div style="display: block;"><strong>Carrera: </strong> '.$selec_carrera['Carrera']['nombre'].'</div>';
            echo '<div style="display: block;"><strong>Pensum: </strong> '.$seleccionado['Pensum']['nombre'].'</div>';
            echo '<div style="display: block;"><strong>Cantidad de Aulas: </strong> '.$aulas.' ( Bloques Disponibles: '.$bloques['disponibles'].'/'.$bloques['totales'].' )</div>';
            echo '<div style="display: block;"><strong>Cantidad de Secciones: </strong> '.$secciones.'</div>';
            echo '<br/>';
            echo '<div class="acciones buttonset" style="display: block;">';
                  echo $this->Html->link($this->element('icono',array('icono'=>'cerrar','label'=>'Cerrar')),'/proyectos/cerrar/',array('escape'=>false));
                  echo '&nbsp;';
                  echo $this->Html->link($this->element('icono',array('icono'=>'editar','label'=>'Modificar')),'/proyectos/edit/'.$seleccionado['Proyecto']['id'],array('escape'=>false));
                  echo '&nbsp;';
                  echo $this->Html->link($this->element('icono',array('icono'=>'eliminar','label'=>'Eliminar')),'/proyectos/delete/'.$seleccionado['Proyecto']['id'],array('id'=>'borrar', 'escape'=>false));
                  echo '&nbsp;';
                  echo $this->Html->link($this->element('icono',array('icono'=>'listar','label'=>'Aulas')),'/aulas/index/',array('escape'=>false));
                  echo '&nbsp;';
                  echo $this->Html->link($this->element('icono',array('icono'=>'listar','label'=>'Secciones')),'/seccions/index/',array('escape'=>false));
            echo '</div>';
         echo '</div>';
         
//         debug($bloques_disponibles);
         
      }else{
         echo $this->element('alerta',array('titulo'=>'Alerta','mensaje'=>'No ha Seleccionado un Proyecto'));
      }
      
//      debug($this);    

    

//   echo $this->element('sql_dump');
?>      
	</div>
</div>
<script>
    cargarContent('<?php echo $this->Html->url(array('controller'=>'menu','action'=>'proyectos'), false);?>','#left','Cargando Menu.');
</script>


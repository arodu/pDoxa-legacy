<div id="tabsContenido">
      <ul class="no-print">
      <?php
//      debug($direccions);
      
         foreach($direccions as $direccion_id => $direccion){
            echo '<li>';
            echo $this->Html->link($this->element('icono',array('label'=>$direccion,'icono'=>'document')), '/proyectos/asistenciaDocente/'.$direccion_id,array('escape'=>false,'title'=>$direccion));
            echo '</li>';
         }
      ?>
      </ul>
      <div></div>
</div>
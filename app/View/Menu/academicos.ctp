<!--<h3>Academicos</h3>
   <div>
      <?php
/*         echo '<ul class="submenu">';
         echo '<li>'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-refresh'))."Carreras",'',array('escape'=>false)).'</li>';
         echo '</ul>';
*/      ?>
<?php // debug($carreras);
      echo '<span class="arbolRoot">'.$this->Html->link("Carreras",'/carreras/index').'</span>';
?>
      <ul id="arbol">
         <?php
            foreach($carreras as $carrera){
               echo '<li><span>'.$carrera['Carrera']['nombre'].'</span>';
               if(count($carrera['Pensum']) > 0){
                  echo '<ul>';
                  foreach($carrera['Pensum'] as $pensum){
                     echo '<li><span>Pensum: '.$pensum['nombre'].'</span>';
                        echo '<ul>';
                           echo '<li><span class="placeholder">&nbsp;</span></li>';
                        echo '</ul>';
                     echo '</li>';
                  }
                  echo '</ul>';
               }
               echo '</li>';
            }
         ?>
      </ul>
   </div>
-->
<!--
array(
	(int) 0 => array(
		'Area' => array(
			'id' => '1',
			'nombre' => 'Area de Ingenieria de Sistemas',
			'created' => '2013-08-03 00:00:00',
			'updated' => '2013-08-03 00:00:00',
			'user_id' => '1'
		)
	)
)
-->


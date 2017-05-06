<h3>Areas Academicas</h3>
   <div>
       <ul class="submenu">
       <?php // debug($areas);           
            echo '<li class="activo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-plus')).'Nueva Area Académica','/areas/add/',array('escape'=>false)).'</li>';
            echo '<li></li>';
            foreach($areas as $area){
                echo '<li class="activo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-circle-check')).$area['Area']['nombre'],'/areas/view/'.$area['Area']['id'],array('escape'=>false)).'</li>';
//                echo '<li><a href="'..'">'.$area['Area']['nombre'].'</a></li>';
            }
        ?>
       </ul>
   </div>


<h3>Generales</h3>
   <div>
      <?php
      echo '<ul class="submenu">';
        echo '<li class="activo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-calendar'))."Esquema de Dias",'/esquemaDias/index',array('escape'=>false)).'</li>';
        echo '<li class="activo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-clock'))."Esquema de Horas",'/esquemaHoras/index',array('escape'=>false)).'</li>';

        echo '<li></li>';         
        echo '<li class="activo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-copy')).'Turnos','/turnos/index',array('escape'=>false)).'</li>';
        echo '<li class="activo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-arrow-4')).'Ubicaciones','/ubicacions/index',array('escape'=>false)).'</li>';
        echo '<li class="activo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-transferthick-e-w')).'Tipos de Aulas','/tipoAulas/index',array('escape'=>false)).'</li>';
      echo '</ul>';
      ?>
   </div>


<h3>Usuarios</h3>
   <div>
      <?php
        echo '<ul class="submenu">';
            echo '<li class="activo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-person')).'Mis Datos','/users/view/'.$usuario['datos']['id'],array('escape'=>false)).'</li>';
            echo '<li class="activo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-contact')).'Editar Datos','/users/edit/'.$usuario['datos']['id'],array('escape'=>false)).'</li>';
            echo '<li class="activo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-locked')).'Editar Contraseña','/users/editPassword/'.$usuario['datos']['id'],array('escape'=>false)).'</li>';
        
            if($usuario['isAdmin']){
                echo '<li></li>';
                echo '<li class="activo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-plus')).'Agregar Usuario','/users/add',array('escape'=>false)).'</li>';
                echo '<li class="activo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-unlocked')).'Ver Usuarios','/users/index',array('escape'=>false)).'</li>';
            }
        
          echo '</ul>';
      echo '<br/>';
      
      
      echo $this->Form->input('tema', array('options' => Configure::read('Aplicacion.temas'),'label'=>'Tema:','id'=>'cambiarTemas','empty'=>'<--Seleccione-->'));
      
      ?>
    </div>
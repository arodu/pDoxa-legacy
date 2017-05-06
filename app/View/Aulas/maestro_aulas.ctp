<?php if($aulas){ ?>
      <div id="tabsContenido">
          <ul class="no-print">
             <?php
               foreach($aulas as $aula_id => $aula){
                  echo '<li>';
                  echo $this->Html->link($aula,'/aulas/view/'.$aula_id,array('id'=>$aula_id));
                  echo '</li>';
               } ?>
          </ul>
          <div id="horarioAula"></div>
      </div>
<?php
    }else{
        echo $this->element('alerta',array('titulo'=>'Alerta','mensaje'=>'No se han creado aulas para este Proyecto'));
    }
?>
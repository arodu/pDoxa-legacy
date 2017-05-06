<div id="tabsContenido">
	<ul class="no-print">
      <?php
         foreach($niveles as $nivel){
            echo '<li>';
            echo $this->Html->link($this->element('icono',array('label'=>$nivel['Materia']['nivel'],'icono'=>'document')), '/seccions/seccionesNivel/'.$nivel['Materia']['nivel'],array('escape'=>false,'title'=>$pensum['Pensum']['regimen'].' '.$nivel['Materia']['nivel']));
            echo '</li>';
         }
      ?>
	</ul>
        <div></div>
</div>
<?php
    if(!isset($migajas)){
        $migajas = $this->viewVars['migajas'];
    }
?>
<div id="migajas" class="acciones buttonset">
    <?php
        foreach($migajas as $migaja){
            if(!isset($migaja['action'])){ $migaja['action'] = 'view'; }
            echo '<span>'.$this->Html->link($this->element('icono',array('icono'=>'volver-migajas','label'=>$migaja['nombre'])), array('controller'=>$migaja['controller'],'action' => $migaja['action'], $migaja['id']),array('escape'=>false, 'title'=>'Volver Atras')).'</span>';
        }
    ?>
</div>
<hr/>
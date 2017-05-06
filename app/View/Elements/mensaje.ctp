<?php
   if(isset($icono)) $icono = 'ui-icon-'.$icono; else $icono = 'ui-icon-info';
   
   if(!isset($tipo)) $tipo = 'ui-state-highlight';
   
   if(isset($id)) $id = 'id="'.$id.'" '; else $id = ' ';
   
   if(!isset($titulo)) $titulo = '';

   if(isset($clase)) $clase = $tipo.$clase; else $clase = $tipo;

echo '<div '.$id.' class="ui-widget" style="margin-bottom: 8px;">';
    echo '<div class="ui-widget-header ui-corner-top '.$clase.'" style="padding: 0.4em;>';
    echo '<span class="ui-icon '.$icono.'" style="float:left; margin-right: .3em;"></span>';
    echo '<span>'.$titulo.':</span>';
    echo '</div>';

    echo '<div class="ui-widget-content ui-corner-bottom '.$clase.'" style="padding: 0.4em;>';
    echo '<span>'.$mensaje.'</span>';
    echo '</div>';    
echo '</div>';
?>

    <div class="ui-widget-header ui-corner-top ui-state-error" style="padding: 0.4em;">
        <span class="ui-icon ui-icon-alert" style="float:left; margin-right: .3em;"></span>
        <?php echo $titulo;?>:
    </div>
    <div class="ui-widget-content ui-corner-bottom ui-state-error" style="padding: 0.4em;">
         <?php echo $mensaje;?>
    </div>
</div>

?>
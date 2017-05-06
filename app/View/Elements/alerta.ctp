<?php
    if(isset($error)){
        if($error=='noInfo'){
            if(!isset($tituto)) $titulo = "Error noInfo";
            if(!isset($mensaje)) $mensaje = "No Existe Información a Mostrar.";
        }
    }
?>
<div id="alerta" class="ui-widget" style="margin-bottom: 8px;">
    <div class="ui-widget-header ui-corner-top ui-state-error" style="padding: 0.4em;">
        <span class="ui-icon ui-icon-alert" style="float:left; margin-right: .3em;"></span>
        <?php echo $titulo;?>:
    </div>
    <div class="ui-widget-content ui-corner-bottom ui-state-error" style="padding: 0.4em;">
         <?php echo $mensaje;?>
    </div>
</div>
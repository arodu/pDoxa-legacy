<?php
   $sistema = Configure::read('Sistema');
   $empresa = Configure::read('Empresa');
   $aplicacion = Configure::read('Aplicacion');
   $tema = $aplicacion['tema'].'/jquery-ui';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <?php echo $this->Html->charset(); ?>
      <title>
         <?php echo $title_for_layout; ?>
      </title>
	<?php
		echo $this->Html->meta('icon');

      echo $this->Html->css($tema,null,array('media'=>'screen'));
      echo $this->Html->css('pDoxa',null,array('media'=>'screen'));

		echo $this->Html->script('jquery-1.8.3');
		echo $this->Html->script('jquery-ui-1.9.2.custom');
  		echo $this->Html->script('jquery.form');
		echo $this->Html->script('pDoxaPopup');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
      
      echo $this->Html->css('pDoxaImp',null,array('media'=>'print'));
//      echo $this->Html->css('pDoxaImp');
	?>
      <style>
         #layout {
            position: absolute;
            top: 55px;
            left: 6px;
            right: 6px;
            bottom: 6px;
            overflow: auto;
         }
         
         #layout #content{
            padding: 0px 2px 1px 1px;
               position: absolute; 
                  top: 6px;
                  left: 6px;
                  right: 6px;
                  bottom: 6px;
       }

         #acciones{
            float: right;
         }
         #opciones{
            float: left;
            padding: 4px;
            display: inline-block;
         }
      </style>
      <script>
      </script>
   </head>
<body class="<?php echo $aplicacion['fondo'];?>" style="border: 0px;">
    <?php echo $this->element('noscript'); ?>
      <div style="display: block;">
         <div id="acciones" class="no-print acciones">
            <a href="#" id="actualizar"><span class="ui-icon ui-icon-refresh" style="float:left;"></span><span id="texto">Refrescar</span></a>
            <a href="#" id="imprimir"><span class="ui-icon ui-icon-print" style="float:left;"></span>Imprimir</a>
            <a href="#" id="cerrar"><span class="ui-icon ui-icon-close" style="float:left;"></span>Cerrar Ventana</a>
         </div>

         <div id="opciones" class="no-print acciones">
            <a href="#" id="tipo-materias"><span class="ui-icon ui-icon-note" style="float:left;"></span><span id="texto">Materias</span></a>
            <a href="#" id="ocultar-cupos"><span class="ui-icon ui-icon-signal" style="float:left;"></span><span id="texto">Cupos</span></a>
            <a href="#" id="ocultar-docentes"><span class="ui-icon ui-icon-person" style="float:left;"></span><span id="texto">Docentes</span></a>
            <a href="#" id="tipo-hora"><span class="ui-icon ui-icon-clock" style="float:left;"></span><span id="texto">Horas</span></a>
            <a href="#" id="tipo-dia"><span class="ui-icon ui-icon-calendar" style="float:left;"></span><span id="texto">Dias</span></a>
         </div>

      </div>
      <div id="layout" >
         <div id="content">
            <?php echo $this->fetch('content'); ?>
         </div>
      </div>
      

<div id="dialog-form">
	<div id="formulario"></div>
</div>

   </body>
</html>
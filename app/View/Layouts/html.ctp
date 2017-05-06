<?php
   $sistema = Configure::read('Sistema');
   $empresa = Configure::read('Empresa');
   $aplicacion = Configure::read('Aplicacion');
//   $tema = 'cupertino/jquery-ui-1.9.1.custom.min';  // safe
   $tema = $aplicacion['tema'].'/jquery-ui';  // redmond
?>

<html>
    <head>
        <title><?php echo $title_for_layout;?></title>
        <?php 

      echo $this->Html->css($tema,null,array('media'=>'screen'));
//            echo $this->Html->css('pDoxaImp',null,array('media'=>'print'));
      echo $this->Html->css('pDoxa',null,array('media'=>'screen'));
      echo $this->Html->css('pDoxaImp',null,array('media'=>'print'));

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
         }
      </style>
        
        
    </head>
    <body class="<?php echo $aplicacion['fondo'];?>" style="border: 0px;">
      <div id="layout" >
         <div id="content">
            <?php echo $this->fetch('content'); ?>
         </div>
      </div>
    </body>
</html>
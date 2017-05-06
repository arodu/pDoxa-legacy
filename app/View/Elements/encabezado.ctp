<?php if(!isset($tipo) or @$tipo==1){ ?>
    <div id="header" class="no-screen">
       <div id="logo"><?php echo $this->Html->image('logo-unerg.jpg', array('alt' =>'logo UNERG', 'border' => '0','width'=>'120pt'));?></div>
       <div id="texto">
          <strong>Universidad Nacional Experimental R&oacute;mulo Gallegos</strong><br/>
          <?php if($this->Session->read('Proyecto.Area.nombre')){ ?><strong><?php echo $this->Session->read('Proyecto.Area.nombre');?></strong><br/><?php } ?>
          <?php if($this->Session->read('Proyecto.Carrera.nombre')){ ?> <strong>Programa: <?php echo $this->Session->read('Proyecto.Carrera.nombre');?></strong><br/><?php } ?>
          <?php if($this->Session->read('Proyecto.lapso_academico')){ ?><strong>Lapso Acad&eacute;mico: <?php echo $this->Session->read('Proyecto.lapso_academico');?></strong><br/><?php } ?>
          <strong>Comisi&oacute;n de Horarios Acad&eacute;micos</strong>
       </div>
    </div>
<?php }elseif(@$tipo==2){ ?>
    <div id="header" class="no-screen">
       <div id="logo"><?php echo $this->Html->image('logo-unerg.jpg', array('alt' =>'logo UNERG', 'border' => '0','width'=>'120pt'));?></div>
       <div id="texto">
          <strong>Rep&uacute;blica Bolivariana de Venezuela</strong><br/>
          <strong>Universidad Nacional Experimental R&oacute;mulo Gallegos</strong><br/>
          <?php if($this->Session->read('Proyecto.Area.nombre')){ ?><strong><?php echo $this->Session->read('Proyecto.Area.nombre');?></strong><br/><?php } ?>
       </div>
    </div>
<?php } ?>
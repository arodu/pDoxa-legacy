<?php  if($usuario['loggedIn']){ ?>
    <div id="mainmenu">
        <?php
            echo $this->Html->link($this->element('icono',array('label'=>'Inicio','icono'=>'home')), '/',array('escape'=>false, 'class'=>'inicio'));
            echo '&nbsp;';
            echo $this->Html->link($this->element('icono',array('label'=>'Proyectos','icono'=>'lightbulb')), '/menu/proyectos',array('escape'=>false, 'class'=>'left'));
            echo '&nbsp;';
            echo $this->Html->link($this->element('icono',array('label'=>'Configuración','icono'=>'gear')), '/menu/configuraciones',array('escape'=>false, 'class'=>'left'));
            echo '&nbsp;';
            echo $this->Html->link($this->element('icono',array('label'=>'Ayuda','icono'=>'help')),array('plugin' => 'ayuda','controller' => 'contenidos','action' => 'index'),array('class'=>'ayuda','escape'=>false,'target'=>'_blank'));
            //echo $this->Html->link($this->element('icono',array('label'=>'Ayuda','icono'=>'help')), '#',array('escape'=>false, 'class'=>'ayuda inactivo'));
            echo '&nbsp;';
            echo $this->Html->link($this->element('icono',array('label'=>'Cerrar Sesi&oacute;n','icono'=>'power')), '/users/logout',array('escape'=>false, 'class'=>'cerrar'));
        ?>
    </div>
<?php  } ?>

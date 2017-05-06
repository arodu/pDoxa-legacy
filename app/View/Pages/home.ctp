<?php $sistema = Configure::read('Sistema'); ?>
<?php $aplicacion = Configure::read('Aplicacion'); ?>
<style>
#principal{text-align:center;}
#principal h1{font-family:"Lucida Grande","Lucida Sans",Arial,sans-serif;font-size:4em;font-weight:bold;margin:0;}
#principal h2{font-size:1.5em;margin:0;}
#principal h3{margin:0;}
</style>

<div id="accordionContenido">
<h3>Inicio</h3>
<div>
    <br/><br/><br/><br/>
    <div id="principal">
        <?php echo $this->Html->image('cubo.logo.png', array('alt' => 'Logo pDoxa','width'=>'150px')); ?>
        <h1><?php echo $sistema['nombre']; ?></h1>
        <h2><?php echo $sistema['texto']; ?></h2>
        <h3><?php echo $sistema['version']['nombre']; ?></h3>
		<br/>
		<span>Powered by Cakephp <?php echo Configure::version(); ?></span>
    </div>
    
    <?php
        if($navegador != 'Mozilla Firefox'){ echo $this->element('useFirefox'); }
//        echo $this->Form->select('Temas',Configure::read('Aplicacion.temas'));
    ?>
    

    

    
    
</div>
<!--
<h3>Temas</h3>
    <div>
        <?php 
            echo $this->Form->create('Temas',array('type'=>'post','url' => '/pages/temas'));

            echo $this->Form->input('tema', array('options' => $aplicacion['temas'],'label'=>'Cambiar Tema: (Solo funciona de manera temporal)','id'=>'cambiarTemas'));
//            echo 'Cambiar Tema: '.
            echo $this->Form->end();?>
        
    </div>
-->
</div>

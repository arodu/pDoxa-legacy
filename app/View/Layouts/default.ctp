<?php
	$sistema = Configure::read('Sistema');
	$empresa = Configure::read('Empresa');
	$aplicacion = Configure::read('Aplicacion');
	//$tema = 'cupertino/jquery-ui-1.9.1.custom.min';  // safe
	$tema = $aplicacion['tema'].'/jquery-ui.min';

	header('Content-type: text/html; charset=UTF-8'); 
?>

<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset('utf-8'); ?>
<title><?php echo $sistema['nombre'].' - '.$sistema['fecha']; ?></title>

<script> // Precondiciones Javacript
    var globalUrl = '<?php echo $this->Html->url('/'); ?>';
</script>

      <?php
        echo $this->Html->meta('icon');  

        // CSS
        //echo $this->Html->css('treeview/jquery.treeview',null,array('media'=>'screen'));
        echo $this->Html->css('chosen/chosen',null,array('media'=>'screen'));
        echo $this->Html->css($tema,null,array('media'=>'screen','id'=>'tema'));

        echo $this->Html->css('pDoxa',null,array('media'=>'screen'));
        echo $this->Html->css('pDoxaImp',null,array('media'=>'print'));

        // Scripts
        echo $this->Html->script('jquery.min'); // JQuery
        echo $this->Html->script('jquery-ui.min');
        echo $this->Html->script('jquery.form');
        echo $this->Html->script('chosen.jquery.min');
        echo $this->Html->script('jquery-latest');
        echo $this->Html->script('jquery.tablesorter.min');
        //echo $this->Html->script('jquery.treeview');
        //echo $this->Html->script('pDoxaFun');
        echo $this->Html->script('pDoxa');
        //echo $this->Html->script('pDoxaPopup');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
	?>
</head>
<!-- <body class="no-print"> -->
<body class="<?php echo $aplicacion['fondo'];?>">
        
        <?php echo $this->element('noscript'); ?>
        
	<div id="encabezado" class="no-print">
		<div id="logo">
                    <div id="imagen">
                        <?php echo $this->Html->image('cubo.logo.min.png');?>
                    </div>
                    <div id="texto">
                        <h1><?php echo $sistema['nombre']; ?>&nbsp;<span><?php echo $sistema['version']['estatus'];?></span></h1>
                        <h2><?php echo $sistema['texto']; ?></h2>
                    </div>
		</div>
		<div id="cargador">
                </div>
                
                <?php echo $this->element('mainMenu'); ?>

	</div>

	<div id="layout">
		<div id="left" class="no-print"></div><!-- Fin id="left" -->
                <span id="bordeBoton"></span>
		<div id="content">
                    <?php echo $this->fetch('content'); ?>
		</div><!-- Fin id="content" -->
	</div>
	<div id="footer" class="no-print">
            <?php
                echo '<p>';
                echo 'Copyright &copy; ';
                echo $sistema['fecha'];
                echo ' <strong>'.$this->Html->link($sistema['nombre'].' '.$sistema['version']['nombre'], '/', array('target' => '_self','title'=>$sistema['nombre'].': '.$sistema['texto'].', versión: '.$sistema['version']['nombre'],'class'=>'link')).'</strong> ';
                echo $this->Html->link($empresa['url'], $empresa['url'], array('target' => '_blank','title'=>$empresa['nombre_completo'],'class'=>'link'));
                echo '</p>';
            ?>
	</div>

<span id="dialog-form"><div id="formulario"></div></span>

</body>
</html>

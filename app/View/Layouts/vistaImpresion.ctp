<?php
   $sistema = Configure::read('Sistema');
?>

<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
<title><?php echo $sistema['nombre'].' - '.$sistema['fecha']; ?></title>

<script> // Precondiciones Javacript
    var url = '<?php echo $this->Html->url('/'); ?>';
</script>

      <?php
        echo $this->Html->script('jquery-1.8.3');
        //echo $this->Html->script('jquery-ui-1.9.2.custom');
        echo $this->Html->script('jquery-ui.min1.11');
        echo $this->Html->script('jquery.form');
        echo $this->Html->script('chosen.jquery.min');
        //echo $this->Html->script('jquery.treeview');
        //echo $this->Html->script('pDoxaFun');
        echo $this->Html->script('pDoxa');
      
      
      
        echo $this->Html->meta('icon');  
        // CSS
        echo $this->Html->css('pDoxaImp');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
	?>
</head>

<body>
<?php echo $this->element('noscript'); ?>
<div id="layout">
    <div id="content">
        <?php echo $this->fetch('content'); ?>
    </div><!-- Fin id="content" -->
</div>
</body>
</html>
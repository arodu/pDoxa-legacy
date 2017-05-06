<!DOCTYPE html>
<html lang="en">
  <head>
    <?php echo $this->Html->charset(); ?>
    <title>
      <?php // echo $cakeDescription ?>
      <?php echo $title_for_layout; ?>
    </title>
    <?php
      echo $this->Html->meta('icon');

      echo $this->Html->css('bootstrap.min');
      echo $this->Html->css('ayuda');

      echo $this->fetch('meta');
      echo $this->fetch('css');
      echo $this->fetch('script');

      

    ?>
  </head>

  <body>
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <?php echo $this->Html->link('<span class="glyphicon glyphicon-question-sign"></span> '.$project_name,array('controller'=>'contenidos','action'=>'index'),array('escape'=>false,'class'=>'navbar-brand'));?>
        </div>
        <div class="navbar-collapse collapse">

          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholsder="Buscar..." />
          </form>
          <!--
          <ul class="nav navbar-nav navbar-right">
            <li class=""><?php echo $this->Html->link('<span class="glyphicon glyphicon-home"></span>',array('controller'=>'contenidos','action'=>'index'),array('escape'=>false));?></li>
          </ul> -->
        </div>
      </div>
    </div>
    <!-- Begin page content -->
    <div class="container">
      <?php echo $this->Session->flash('flash', array('element' => 'alert'));?>
      <?php echo $this->fetch('content'); ?>
      <!--
        <div class="page-header">
          <h1>Sticky footer</h1>
        </div>
        <p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS.</p>
        <p>Use <a href="../sticky-footer-navbar">the sticky footer with a fixed navbar</a> if need be, too.</p>

      -->
    </div>


<!--
    <div id="footer">
      <div class="container">
        <?php // echo $this->element('footer');?>
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </div>
-->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <?php echo $this->Html->script('bootstrap.min');?>

  </body>
</html>

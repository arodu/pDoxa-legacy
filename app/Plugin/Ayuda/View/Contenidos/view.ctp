<?php // echo $this->element('pager'); ?>
	<ol class="breadcrumb">
	<?php  // Breadcums
		echo '<li>'.$this->Html->link($index, array('action' => 'index')).'</li>'; 
		foreach ($ayudaContenido['ruta'] as $ruta) { ?>
			<?php 
				if($ruta['AyudaContenido']['id'] == $ayudaContenido['AyudaContenido']['id']){
					echo '<li class="active">'.$ruta['AyudaContenido']['titulo'].'</li>';
				}else{
					echo '<li>'.$this->Html->link($ruta['AyudaContenido']['titulo'], array('action' => 'view',$ruta['AyudaContenido']['id'])).'</li>';
				}
			?>
	<?php } ?>
	</ol>
	<h2><?php echo __($ayudaContenido['AyudaContenido']['titulo']); ?></h2>
	<hr/>

<div class="descripcion">
	<blockquote>
		<p class="text-justify">
			<?php echo html_entity_decode($ayudaContenido['AyudaContenido']['descripcion']); ?>
		</p>
	</blockquote>
	
<?php if (!empty($ayudaContenido['ChildAyudaContenido'])): ?>
	<blockquote>
		<!-- <h3>Otros</h3>-->
		<ul class="list-inline">
			<?php foreach ($ayudaContenido['ChildAyudaContenido'] as $hijo): ?>
				<li>
					<?php echo $this->Html->link(__($hijo['AyudaContenido']['titulo']), array('controller' => 'contenidos', 'action' => 'view', $hijo['AyudaContenido']['id'])); ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</blockquote>
<?php endif; ?>

	
</div>

    <!-- <div id="footer">
      <div class="container">
        <?php // echo $this->element('footer');?>
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </div> -->

<?php echo $this->element('pager'); ?>


<?php if($editMode){ ?>
	<!-- -------- MODO DE EDICIÓN ACTIVADO -------- -->
	<div class="panel panel-danger">
	<!-- <div class="alert alert-danger" role="alert">-->
	
	  	<div class="panel-heading"><span class="glyphicon glyphicon-warning-sign"></span> <strong>Modo de Edición Activado</strong></div>
	<div class="panel-body">
	  	<div class="btn-group">
			<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list-alt"></span> Editar Indice '),array('action' => 'indexEdit'),array('class'=>'btn btn-default btn-xs','escape'=>false));?>
			<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>  Editar '.$ayudaContenido['AyudaContenido']['titulo']),array('action' => 'edit',$ayudaContenido['AyudaContenido']['id']),array('class'=>'btn btn-default btn-xs','escape'=>false));?>
			<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span> Eliminar '.$ayudaContenido['AyudaContenido']['titulo']), array('action' => 'delete', $ayudaContenido['AyudaContenido']['id']), array('class'=>'btn btn-danger btn-xs','escape'=>false), __('Are you sure you want to delete # %s?', $ayudaContenido['AyudaContenido']['id'])); ?>
		</div>
	</div>
	<ul class="list-group">
	    <li class="list-group-item">
				<strong>URL: </strong>
					<pre><?php echo $this->Html->url(array('action'=>$this->params['action'],$ayudaContenido['AyudaContenido']['id']));?></pre>
					<pre><?php echo $this->Html->url(array('action'=>$this->params['action'],$ayudaContenido['AyudaContenido']['id']),true);?></pre>
		</li>

		<?php
			//debug($this->action);
			//debug($this->controller);
			//debug($this->params);
		?>

		<li class="list-group-item">
				<strong>CakePhp Link: </strong>
				<pre><?php
				echo htmlentities('<?php echo $this->Html->link(__(\''.$ayudaContenido['AyudaContenido']['titulo'].'\'),array(\'plugin\' => \''.$this->params['plugin'].'\',\'controller\' => \''.$this->params['controller'].'\',\'action\' => \''.$this->params['action'].'\','.$ayudaContenido['AyudaContenido']['id'].'),array(\'target\'=>\'_blank\'));?>');
				?></pre>
		</li>
	</ul>

	</div></div>
<?php } ?>

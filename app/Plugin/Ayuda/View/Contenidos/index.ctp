	<?php 
		function imprimirIndice($arbol,$html=null,$label = 'titulo'){
			$data = null;
			foreach ($arbol as $rama) {
				if($html){
					$data .= '<li>'.$html->link($rama['AyudaContenido'][$label], array('controller' => 'contenidos', 'action' => 'view', $rama['AyudaContenido']['id']));
				}else{
					$data .= '<li>'.$rama['AyudaContenido'][$label];
				}
				if($rama['children']){
					$data .= imprimirIndice($rama['children'],$html,$label);
				}
				$data .= '</li>';
			}
			$data = '<ul>'.$data.'</ul>';
			return $data;
		}
	?>

	<h2><?php echo __('<span class="glyphicon glyphicon-home"></span> '.$index); ?></h2>
	<hr/>
	<blockquote>
		<?php echo imprimirIndice($ayudaContenido,$this->Html); ?>
	</blockquote>

	<blockquote>
		<ul class="list-inline">
			<li><?php echo $this->Html->link(__(' <span class="glyphicon glyphicon-print"></span>  Imprimir Todo'), array('controller' => 'contenidos', 'action' => 'viewAll'),array('escape'=>false,'class'=>'btn btn-primary btn-sm'));?></li>
		</ul>
	</blockquote>


	<ul class="pager">
		<?php echo '<li class="previous disabled">'.'<span class="glyphicon glyphicon-chevron-left"></span>'.'</li>'; ?>

		<?php echo '<li class="disabled">'.'<span class="glyphicon glyphicon-home"></span>'.'</li>'; ?>

		<?php echo '<li class="next">'.$this->Html->link(__(' <span class="glyphicon glyphicon-chevron-right"></span>'), array('controller' => 'contenidos', 'action' => 'view'),array('escape'=>false)).'</li>'; ?>
	</ul>



	<style>
		ul{
			list-style-type: disc;
		}
	</style>
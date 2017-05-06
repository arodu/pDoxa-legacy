	<a name="inicio"></a>

	<h2><?php echo __('<span class="glyphicon glyphicon-question-sign"></span> '.$project_name); ?></h2>

	<?php echo imprimirIndice($ayudaContenido,$this->Html,""); ?>
	<hr/>
	<?php echo imprimirContenido($ayudaContenido,$this->Html,""); ?>
	<hr/>


	<style>
		ul{
			list-style-type: none;
		}
	</style>

	<?php 
		function imprimirIndice($arbol,$html=null,$i,$label = 'titulo'){
			$data = null;
			$j=1;
			foreach ($arbol as $rama) {
				$inde = ltrim($i.'.'.$j++,'.');
				if($html){
					$data .= '<li>'.$html->link($inde.' - '.$rama['AyudaContenido'][$label], '#anc'.$rama['AyudaContenido']['id']);
				}else{
					$data .= '<li>'.$rama['AyudaContenido'][$label];
				}
				if($rama['children']){
					$data .= imprimirIndice($rama['children'],$html,$inde,$label);
				}
				$data .= '</li>';
			}
			$data = '<ul>'.$data.'</ul>';
			return $data;
		}


		function imprimirContenido($arbol,$html=null,$i,$label = 'titulo'){
			$data = null;
			$j=1;
			foreach ($arbol as $rama) {
				//$data .= '<li class="visible-print-block">';
				$inde = ltrim($i.'.'.$j++,'.');

				$data .= '<a name="anc'.$rama['AyudaContenido']['id'].'"></a>';
				//$data .= '<h'.$i.'>'.$i.'.'.$j++.' '.$rama['AyudaContenido'][$label].'</h'.$i.'>';
				$data .= '<h3>'.$inde.' - '.$rama['AyudaContenido'][$label].'</h3>';
				$data .= '<p class="text-justify">'.$rama['AyudaContenido']['descripcion'].'</p>';
				$data .= '<div class="text-right hidden-print">'.$html->link('<span class="glyphicon glyphicon-chevron-up"></span>', '#inicio', array('class'=>'btn btn-default btn-xs ','title'=>'Volver al Inicio','escape'=>false)).'</div>';

				if($rama['children']){
					$data .= imprimirContenido($rama['children'],$html,$inde,$label);
				}
				//$data .= '</li>';
			}
			//$data = '<ul>'.$data.'</ul>';
			return $data;
		}
	?>
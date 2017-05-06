<?php $ayudaContenido = $this->requestAction('contenidos/indice'); ?>
<?php 
	function imprimirIndice($arbol,$html=null,$label = 'titulo'){
		$data = null;
		foreach ($arbol as $rama) {
			if($html){ $data .= '<li>'.$html->link($rama['AyudaContenido'][$label], array('controller' => 'contenidos', 'action' => 'view', $rama['AyudaContenido']['id']));
			}else{ $data .= '<li>'.$rama['AyudaContenido'][$label];
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

<?php echo imprimirIndice($ayudaContenido,$this->Html); ?>

<style>
	ul{
		/*list-style-type: circle;*/
	}
</style>

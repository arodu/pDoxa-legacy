<?php
	$left_icon	= 'glyphicon glyphicon-chevron-left';
	$right_icon	= 'glyphicon glyphicon-chevron-right';
	$home_icon	= 'glyphicon glyphicon-home';


?>
<ul class="pager">
	<?php 
	if($ayudaContenido['prev']){
		echo '<li class="previous">'.$this->Html->link(
		__('<span class="'.$left_icon.'"></span>'),
		array('controller' => 'contenidos', 'action' => 'view', $ayudaContenido['prev']['AyudaContenido']['id']),array('escape'=>false,'title'=>$ayudaContenido['prev']['AyudaContenido']['titulo'])).'</li>';
	}else{
		echo '<li class="previous">'.$this->Html->link('<span class="'.$left_icon.'"></span>', array('controller' => 'contenidos', 'action' => 'index'),array('escape'=>false,'title'=>'Indice')).'</li>';
	}

	echo '<li>'.$this->Html->link('<span class="'.$home_icon.'"></span>', array('controller' => 'contenidos', 'action' => 'index'),array('escape'=>false,'title'=>'Indice')).'</li>';

	if($ayudaContenido['next']){
		echo '<li class="next">'.$this->Html->link(__(' <span class="'.$right_icon.'"></span>'), array('controller' => 'contenidos', 'action' => 'view', $ayudaContenido['next']['AyudaContenido']['id']),array('escape'=>false,'title'=>$ayudaContenido['next']['AyudaContenido']['titulo'])).'</li>';
	}else{ echo '<li class="next disabled">'.'<span class="'.$right_icon.'"></span>'.'</li>'; }
	?>
</ul>
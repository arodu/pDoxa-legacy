<?php
$comunes = array(
    'ver' => 'ui-icon-search',
    'editar' => 'ui-icon-pencil',
    'copiar' => 'ui-icon-copy',
    'eliminar' => 'ui-icon-trash',
    'imprimir' => 'ui-icon-print',
    'agregar' => 'ui-icon-plus',
    'volver' => 'ui-icon-circle-triangle-w',
    'volver-migajas' => 'ui-icon-circle-triangle-w',
    'draggable' => 'ui-icon-arrow-4',
    'informacion' => 'ui-icon-info',
    'listar' => 'ui-icon-newwin',
    'cerrar' => 'ui-icon-close',
    'contraseña' => 'ui-icon-locked',
    'usuario' => 'ui-icon-person',
    //'' => 'ui-icon-',
);

if(!isset($title)){
    $title = "";
}

if(isset($icono)){
    if(isset($comunes[$icono])){
        $icono = $comunes[$icono];
    }else{
        $icono = 'ui-icon-'.$icono;
    }
}else{
    $icono = 'ui-icon-notice';
}

if(isset($label)){
   echo $this->Html->tag('span','',array('class'=>'ui-icon '.$icono,'style'=>'float:left; margin-right: .3em;','title'=>$title)).$label;
}else{
   echo $this->Html->tag('span','',array('class'=>'ui-icon '.$icono,'style'=>'float:left; margin-right: .3em;','title'=>$title));
}
?>
<?php
        $estado = array(0=>'experimental',1=>'alfa1',2=>'alfa2',3=>'beta',4=>'rc1',5=>'est.');

/* Datos del Sistema */
	$config['Sistema']['nombre'] = 'pDoxa';
        $config['Sistema']['texto'] = 'Sistema de Gestión de Horarios Académicos';

        $config['Sistema']['version']['principal'] = '0';       	//  0
        $config['Sistema']['version']['compatibilidad'] = '.5'; 	// .5
        $config['Sistema']['version']['aplicacion'] = '.3';     	// .0
        $config['Sistema']['version']['actualizacion'] = '-3';    	// -0
        $config['Sistema']['version']['otro'] = '';             	//  comentario (en proceso)

        $config['Sistema']['version']['estatus'] = $estado[3];

        $config['Sistema']['version']['ultimo'] = array('dia'=>18,'mes'=>9,'ano'=>2013);

		$config['Sistema']['version']['nombre'] = $config['Sistema']['version']['principal'].$config['Sistema']['version']['compatibilidad'].$config['Sistema']['version']['aplicacion'].$config['Sistema']['version']['actualizacion'].' '.$config['Sistema']['version']['estatus'].' '.$config['Sistema']['version']['otro'];

		$config['Sistema']['fecha'] = '2012 - 2014';

        $config['Externos']['jquery'] = array('nombre'=>'JQuery','version'=>'1.10.2','archivo'=>'jquery.min.js','web'=>'http://jquery.com/','lenguaje'=>'javascript');
        $config['Externos']['jquery-ui'] = array('nombre'=>'JQuery UI','version'=>'1.10.3','web'=>'http://jqueryui.com','lenguaje'=>'javascript');
        $config['Externos']['cakephp'] = array('nombre'=>'Cakephp','version'=>'2.4.0','web'=>'http://cakephp.or','lenguaje'=>'Php');
        
        $config['Aplicacion']['temas'] = array(0=>'base','black-tie','blitzer','cupertino','dark-hive','dot-luv','eggplant','excite-bike','flick','hot-sneaks','humanity','le-frog','mint-choc','overcast','pepper-grinder','redmond','smoothness','south-street','start','sunny','swanky-purse','trontastic','ui-darkness','ui-lightness','vader');
        $tema_default = 3;
		$config['Aplicacion']['tema'] = 'temas/'.$config['Aplicacion']['temas'][$tema_default];
        $config['Aplicacion']['fondo'] = 'ui-widget-content';   // $config['Aplicacion']['fondo'] = 'ui-state-default';


/* Datos de la Empresa */
	$config['Empresa']['nombre'] = 'UNERG';
        $config['Empresa']['nombre_completo'] = 'Universidad Nacional Experimental Rómulo Gallegos';
	$config['Empresa']['url'] = 'http://www.unerg.edu.ve';


/* Modalidades de los Encuentros */
	$config['Modalidad'][1]['valor'] = 1;
        $config['Modalidad']['Presencial']['valor'] = 1;
        $config['Modalidad'][1]['nombre'] = 'Presencial';
	$config['Modalidad']['Presencial']['nombre'] = 'Presencial';
        $config['Modalidad'][1]['descripcion'] = 'Encuentros de Tipo Presenciales';
	$config['Modalidad']['Presencial']['descripcion'] = 'Encuentros de Tipo Presenciales';
        
        $config['Modalidad'][2]['valor'] = 2;
	$config['Modalidad']['DistanciaHorario']['valor'] = 2;
	$config['Modalidad'][2]['nombre'] = 'Distancia con Horario';
        $config['Modalidad']['DistanciaHorario']['nombre'] = 'Distancia con Horario';
	$config['Modalidad'][2]['descripcion'] = 'Encuentros a Distancia, con horario especificado';
	$config['Modalidad']['DistanciaHorario']['descripcion'] = 'Encuentros a Distancia, con horario especificado';
        
	$config['Modalidad'][3]['valor'] = 3;
        $config['Modalidad']['Distancia']['valor'] = 3;
	$config['Modalidad'][3]['nombre'] = 'Distancia';
	$config['Modalidad']['Distancia']['nombre'] = 'Distancia';
	$config['Modalidad'][3]['descripcion'] = 'Encuentros a Distancia, Sin horario especificado';
	$config['Modalidad']['Distancia']['descripcion'] = 'Encuentros a Distancia, Sin horario especificado';
        
	$config['Modalidad'][4]['valor'] = 4;
	$config['Modalidad']['Pasantia']['valor'] = 4;
	$config['Modalidad'][4]['nombre'] = 'Pasantia';
	$config['Modalidad']['Pasantia']['nombre'] = 'Pasantia';
	$config['Modalidad'][4]['descripcion'] = 'Pasantias Academicas';
	$config['Modalidad']['Pasantia']['descripcion'] = 'Pasantias Academicas';
        
        

        
?>

<?php
App::uses('DocentesSeccion', 'Model');

/**
 * DocentesSeccion Test Case
 *
 */
class DocentesSeccionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.docentes_seccion',
		'app.docente',
		'app.area',
		'app.user',
		'app.carrera',
		'app.pensum',
		'app.materia',
		'app.departamento',
		'app.direccion',
		'app.encuentro',
		'app.tipo_aula',
		'app.aula',
		'app.aula_fisica',
		'app.proyecto',
		'app.seccion',
		'app.turno',
		'app.hora',
		'app.esquema_hora',
		'app.bloque',
		'app.dia',
		'app.esquema_dia',
		'app.encuentros_seccion',
		'app.horas_turno'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DocentesSeccion = ClassRegistry::init('DocentesSeccion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DocentesSeccion);

		parent::tearDown();
	}

}

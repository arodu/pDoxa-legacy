<?php
App::uses('AppModel', 'Model');
/**
 * Bloque Model
 *
 * @property Aula $Aula
 * @property Dia $Dia
 * @property Hora $Hora
 * @property EncuentrosSeccion $EncuentrosSeccion
 */
class Bloque extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'aula_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'dia_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'hora_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Aula' => array(
			'className' => 'Aula',
			'foreignKey' => 'aula_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Dia' => array(
			'className' => 'Dia',
			'foreignKey' => 'dia_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Hora' => array(
			'className' => 'Hora',
			'foreignKey' => 'hora_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'EncuentrosSeccion' => array(
			'className' => 'EncuentrosSeccion',
			'foreignKey' => 'encuentros_seccion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

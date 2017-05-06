<?php
App::uses('AppModel', 'Model');
/**
 * HorasTurno Model
 *
 * @property Hora $Hora
 * @property Turno $Turno
 */
class HorasTurno extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'turno_id' => array(
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
		'Hora' => array(
			'className' => 'Hora',
			'foreignKey' => 'hora_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Turno' => array(
			'className' => 'Turno',
			'foreignKey' => 'turno_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

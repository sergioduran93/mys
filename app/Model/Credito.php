<?php
class Credito extends AppModel
{
	public $belongsTo = array(
		'Representante' => array(
			'className' => 'Representante',
			'foreignKey' => 'representante_id',

			)
		);
	public $validate = array(
		'prestamo' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Solo números'
				)
				),
		'abono' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Solo números'
				),
			)
		);
}

?>
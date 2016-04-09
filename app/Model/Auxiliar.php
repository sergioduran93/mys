<?php
class Auxiliar extends AppModel {
	public $name = 'Auxiliar';
	public $displayField = 'nombre';
	public $actsAs = array( 'AuditLog.Auditable' );

	public $validate = array(
		'documento'=>array(
			'No puede estar vacia.'=>array(
				'rule'=>'notEmpty',
				'message'=>'No puede estar vacia.'
			),
			'La identificación ya existe'=>array(
				'rule'=>'isUnique',
				'message'=>'La identificación ya existe.'
			)
		)
	);
}
?>
<?php
class Vehiculo extends AppModel {
	public $name = 'Vehiculo';
	public $displayField = 'placa';
	public $actsAs = array( 'AuditLog.Auditable' );

	public $belongsTo = array('Conductor');

	public $validate = array(
		'placa'=>array(
			'No puede estar vacia.'=>array(
				'rule'=>'notEmpty',
				'message'=>'No puede estar vacia.'
			),
			'La placa ya existe'=>array(
				'rule'=>'isUnique',
				'message'=>'La placa ya existe.'
			)
		)
	);
}
?>
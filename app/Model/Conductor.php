<?php
class Conductor extends AppModel {
	public $name = 'Conductor';
	public $virtualFields = array('listNombre' => 'concat(Conductor.nombre1, " ",Conductor.nombre2, " ",Conductor.apellido1," ", Conductor.apellido2)');
//	public $virtualFields = array('listNombre','CONCAT_WS(" ",Conductor.nombre1, Conductor.nombre2, Conductor.apellido1, Conductor.apellido2)');

	public $displayField = 'listNombre';

	public $hasMany = array(
		'Vehiculo' => array(
			'className'		=> 'Vehiculo',
			'foreignKey'	=> 'conductor_id',
			'dependent'		=> false
		)
	);

	public $validate = array(
		'identificacion'=>array(
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

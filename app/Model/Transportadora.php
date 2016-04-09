<?php
class Transportadora extends AppModel {
	public $name = 'Transportadora';
	//public $virtualFields = array('listNombre' => 'concat(Conductor.nombre1, " ",Conductor.nombre2, " ",Conductor.apellido1," ", Conductor.apellido2)');
//	public $virtualFields = array('listNombre','CONCAT_WS(" ",Conductor.nombre1, Conductor.nombre2, Conductor.apellido1, Conductor.apellido2)');
/*	public $hasMany = array(
		'Agencia' => array(
			'className'		=> 'Agencia',
			'foreignKey'	=> 'transportadora_id',
			'dependent'		=> false
		)
	);*/
	public $validate = array(
		'nit'=>array(
			'El NIT de la transportadora NO puede estar vacio.'=>array(
				'rule'=>'notEmpty',
				'message'=>'El NIT de la transportadora NO puede estar vacio.'
			),
			'El NIT de la transportadora ya existe. Por favor intente nuevamente'=>array(
				'rule'=>'isUnique',
				'message'=>'El NIT de la transportadora ya existe. Por favor intente nuevamente.'
			)
		)
	);
}
?>

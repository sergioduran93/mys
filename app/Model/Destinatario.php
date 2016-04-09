<?php
class Destinatario extends AppModel {
	public $name = 'Destinatario';
	public $virtualFields = array('listNombre' => 'concat(Destinatario.nombre1, " ",Destinatario.nombre2, " ", Destinatario.apellido1, " ", Destinatario.apellido2)');
	public $displayField = 'listNombre';
	
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

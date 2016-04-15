

<?php
class Cuentarepresentante extends AppModel {
	public $name = 'Cuentarepresentante';
	/*
	public $hasMany = array(
		'Venta' => array(
			'className'		=> 'Venta',
			'foreignKey'	=> 'relacionfactura_id',
			'dependent'		=> false
		),
		'Factura'
	);
	*/
	public $belongsTo = array('Representante');

}
?>

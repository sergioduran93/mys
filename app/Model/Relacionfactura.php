

<?php
class Relacionfactura extends AppModel {
	public $name = 'Relacionfactura';
	
	public $hasMany = array(
		'Venta' => array(
			'className'		=> 'Venta',
			'foreignKey'	=> 'relacionfactura_id',
			'dependent'		=> false
		)
		/*
		'Factura' => array(
			'className'		=> 'Venta',
			'foreignKey'	=> 'total_id',
			'dependent'		=> false
		),
		*/
	);
	public $belongsTo = array('Cliente');

}
?>

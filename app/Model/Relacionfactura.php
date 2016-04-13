

<?php
class Relacionfactura extends AppModel {
	public $name = 'Relacionfactura';
	
	public $hasMany = array(
		'Venta' => array(
			'className'		=> 'Venta',
			'foreignKey'	=> 'relacionfactura_id',
			'dependent'		=> false
		),
		'Factura'
	);
	public $belongsTo = array('Cliente');

}
?>

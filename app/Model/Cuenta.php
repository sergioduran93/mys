<?php
class Cuenta extends AppModel {
	public $name = 'Cuenta';
	public $virtualFields = array('listCuenta' => 'concat(Cuenta.numero, " ", Cuenta.concepto)');
	public $displayField = 'listCuenta';
	
	//public $belongsTo = array('Conductor');

}
?>

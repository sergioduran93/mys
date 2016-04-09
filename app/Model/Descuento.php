<?php
class Descuento extends AppModel {
	public $name = 'Descuento';

	public $belongsTo = array('Cliente');

	public function beforeSave($options = Array()) {
	    return true;
	}
	
}
?>

<?php
class Oficina extends AppModel {
	public $name = 'Oficina';

	public $virtualFields = array('listNombre' => 'concat(Oficina.codigo, " - ", Oficina.nombre)');
	public $displayField = 'listNombre';

	//public $belongsTo = array('Conductor');
    public $hasMany = array('User');

}
?>
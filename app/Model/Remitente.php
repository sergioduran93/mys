<?php
class Remitente extends AppModel {
	public $name = 'Remitente';
	public $virtualFields = array('listNombre' => 'concat(Remitente.documento, " - ", Remitente.nombre)');
	public $displayField = 'listNombre';
}
?>

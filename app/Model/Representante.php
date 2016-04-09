<?php
class Representante extends AppModel {
	public $name = 'Representante';
//	public $virtualFields = array('listCodigo' => 'concat(Departamento.codigo, " - ", Departamento.nombre)');
	public $virtualFields = array('listNombre' => 'concat(Representante.codigo,"-",Representante.nombre1, " ",Representante.nombre2, " ",Representante.apellido1," ", Representante.apellido2)');
	public $displayField = 'listNombre';

	public $hasMany = array(
		'Representantexdestino' => array(
			'className'		=> 'Representantexdestino',
			'foreignKey'	=> 'representante_id',
			'dependent'		=> false
		)
	);

}
?>

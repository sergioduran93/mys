<?php
class Departamento extends AppModel {
	public $name = 'Departamento';
	public $virtualFields = array('listDepartamento' => 'concat(Departamento.codigo, " - ", Departamento.nombre)');
	public $displayField = 'listDepartamento';
	public $actsAs = array( 'AuditLog.Auditable' );

	public $hasMany = array(
		'Region' => array(
			'className'		=> 'Region',
			'foreignKey'	=> 'departamento_id',
			'dependent'		=> false
		),
		'Destino' => array(
			'className'		=> 'Destino',
			'foreignKey'	=> 'departamento_id',
			'dependent'		=> false
		)
	);

}
?>

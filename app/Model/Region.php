<?php
class Region extends AppModel {
	public $name = 'Region';
	public $actsAs = array( 'AuditLog.Auditable' );

	//public $virtualFields = array('listRegion' => 'concat(Region.codigo, " - ", Region.nombre)');

	public $displayField = 'nombre';


	public $belongsTo = array('Departamento');

	public $hasMany = array(
		'Destino' => array(
			'className'		=> 'Destino',
			'foreignKey'	=> 'region_id',
			'dependent'		=> false
		)
	);
}
?>

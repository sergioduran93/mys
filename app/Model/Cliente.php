<?php
class Cliente extends AppModel {
	public $name = 'Cliente';
	public $virtualFields = array('listNombre' => 'concat(Cliente.nombres, " ", Cliente.apellidos)',
								  'listAll' => 'concat(Cliente.documento," - ",Cliente.nombres, " ", Cliente.apellidos)');
	public $displayField = 'listNombre';
	
	
	public $hasMany = array(
		'Tarifa' => array(
			'className'		=> 'Tarifa',
			'foreignKey'	=> 'cliente_id',
			'dependent'		=> false
		),
		'Descuento' => array(
			'className'		=> 'Tarifa',
			'foreignKey'	=> 'cliente_id',
			'dependent'		=> false
		)
	);

	public $validate = array(
		'documento'=>array(
			'No puede estar vacia.'=>array(
				'rule'=>'notEmpty',
				'message'=>'No puede estar vacia.'
			),
			'La identificación ya existe'=>array(
				'rule'=>'isUnique',
				'message'=>'La identificación ya existe.'
			)
		)
	);

	public function beforeDelete(){
		$id = $this->id;
		if($id == 1){
			return false;
		} else {
			return true;
		}
	}
}
?>

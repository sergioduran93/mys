<?php
class Empaque extends AppModel {
	public $name = 'Empaque';
	public $displayField = 'nombre';

	public $hasMany = array(
		'Tarifa' => array(
			'className'		=> 'Tarifa',
			'foreignKey'	=> 'cliente_id',
			'dependent'		=> false
		)
	);
	public function beforeDelete(){
		$id = $this->id;
		if($id == 1 || $id == 2 || $id == 3 || $id == 4 || $id == 5){
			return false;
		} else {
			return true;
		}
	}
}
?>

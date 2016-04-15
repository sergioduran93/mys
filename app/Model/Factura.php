<?php
class Factura extends AppModel {
	public $name = 'Factura';
	public $belongsTo = array('Relacionfactura');
	
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

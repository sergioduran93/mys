<?php
class Tarifa extends AppModel {
	public $name = 'Tarifa';
	public $actsAs = array( 'AuditLog.Auditable' );

	public $belongsTo = array('Cliente','Empaque');

	public function checkTarifa($tarifa) {
		if(!empty($tarifa)){
			$condiciones = array(
				'Tarifa.empaque_id'     =>$tarifa['Tarifa']['empaque_id'],
				'Tarifa.cliente_id'     =>$tarifa['Tarifa']['cliente_id'],
				'Tarifa.origen'         =>$tarifa['Tarifa']['origen'],
				'Tarifa.destino'        =>$tarifa['Tarifa']['destino'],
			);
			$tarifaAntigua = $this->find('first',array('fields'=>'Tarifa.id','recursive'=>-1,'conditions'=>$condiciones));
			if(!empty($tarifaAntigua)){
				$this->delete($tarifaAntigua['Tarifa']['id']);
			}
		}
	    return true;
	}

}
?>

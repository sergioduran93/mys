<?php
class DatosController extends AppController {
	public $name = 'Datos';

	public function crear() {
		if(!empty($this->data)){
			if($this->data['Dato']['id'] == ''){
				$this->Dato->create();
			}
			if($this->Dato->save($this->data)) {
    			$this->Session->setFlash('','ok',array('mensaje'=>'Los datos de la empresa se guardaron con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar los datos de la empresa. Por favor intente nuevamente'));
			}
		}
		$dato = $this->Dato->find('first');
		$this->data = $dato;
		$destinos  = $this->Dato->importModel('Destino')->find('list');
		$despachar = $this->Dato->getEnumValues('despachar');

		$this->set(compact('despachar','destinos'));
	}


}
?>

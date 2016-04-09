<?php
class RemitentesController extends AppController {
	public $name = 'Remitentes';

	public function crear() {
		if(!empty($this->data)){
			if($this->data['Remitente']['id'] == ""){
				$this->Remitente->create();
			}
			if(!empty($this->data['Remitente']['contacto'])){
				foreach ($this->data['Remitente']['contacto']['cargo'] as $key => $value) {
					$contactos[$key]['cargo']    = $value;
					$contactos[$key]['nombre']   = $this->data['Remitente']['contacto']['nombre'][$key];
					$contactos[$key]['telefono'] = $this->data['Remitente']['contacto']['telefono'][$key];
					$contactos[$key]['correo']   = $this->data['Remitente']['contacto']['correo'][$key];
				}
				$this->request->data['Remitente']['contacto'] = json_encode($contactos);
			} else {
				$this->request->data['Remitente']['contacto'] = "[]";
			}
			if($this->Remitente->save($this->data)) {
    			$this->Session->setFlash('','ok',array('mensaje'=>'El remitente se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar el remitente. Por favor intente nuevamente'));
			}
		}
		$this->data = null;
		
		$remitentes = $this->Remitente->find('all',array('recursive'=>-1));
		foreach ($remitentes as $key => $value) {
			$remitentes[$key]['Remitente']['contacto'] = json_decode($value['Remitente']['contacto']);
		}
		$destinos   = $this->Remitente->importModel('Destino')->find('list');
		$this->generateJSON('remitentes', $remitentes, array('Remitente' => array('id','documento','nombre','telefono','direccion','celular','email')));
		$this->set(compact('destinos','remitentes'));
	}

}
?>

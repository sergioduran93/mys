<?php
class ClientesController extends AppController {
	public $name = 'Clientes';

	public function crear() {
		$role = $this->data['Cliente']['role'];
		if(!empty($this->data) && $role != 5 && $role != 6){
			$this->request->data['Cliente']['remitentes'] = json_encode($this->data['Cliente']['remitentes']);
			if($this->data['Cliente']['id'] == ""){
				$this->Cliente->create();
			}
			foreach ($this->data['Cliente']['contacto']['cargo'] as $key => $value) {
				$contactos[$key]['cargo']    = $value;
				$contactos[$key]['nombre']   = $this->data['Cliente']['contacto']['nombre'][$key];
				$contactos[$key]['telefono'] = $this->data['Cliente']['contacto']['telefono'][$key];
				$contactos[$key]['correo']   = $this->data['Cliente']['contacto']['correo'][$key];
			}
			$this->request->data['Cliente']['contacto'] = json_encode($contactos);

			if($this->Cliente->save($this->data)) {
	   			$this->Session->setFlash('','ok',array('mensaje'=>'El cliente se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar el cliente. Por favor intente nuevamente'));
			}
		}
		$this->data = null;
		$clientes = $this->Cliente->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		foreach ($clientes as $key => $value) {
			$clientes[$key]['Cliente']['contacto']   = json_decode($clientes[$key]['Cliente']['contacto']);
			$clientes[$key]['Cliente']['remitentes'] = json_decode($clientes[$key]['Cliente']['remitentes']);
		}
		//$this->log($clientes);
		$tipo       = $this->Cliente->getEnumValues('tipo');
		$cartera    = $this->Cliente->getEnumValues('cartera_negociable');
		$persona    = $this->Cliente->getEnumValues('persona');
		$activo     = $this->Cliente->getEnumValues('activo');
		$causal     = $this->Cliente->getEnumValues('causal');
		$credito    = $this->Cliente->getEnumValues('credito');
		$especial   = $this->Cliente->getEnumValues('especial');
		$remitentes = $this->Cliente->importModel('Remitente')->find('list');
		$destinos   = $this->Cliente->importModel('Destino')->find('list');
		$this->generateJSON('clientes', $clientes, array('Cliente' => array('id','documento','listNombre','telefono','telefono2','direccion','celular')));

		$this->set(compact('clientes','tipo','activo','causal','credito','especial','cartera','persona','destinos','remitentes'));
	}

	public function eliminar($id = null) {
		if($this->Cliente->delete($id)){
	   		$this->Session->setFlash('','ok',array('mensaje'=>'El cliente se elimino con exito'));
		} else {
	   		$this->Session->setFlash('','error',array('mensaje'=>'El cliente no se pudo eliminar'));
		}
    	$this->redirect(array('action' => 'crear'));
	}

	public function crear2($clienteDoc = null, $clienteNom = null) {
		$this->layout = "empty";
		if(!empty($this->data)){
			$this->request->data['Cliente']['remitentes'] = json_encode($this->data['Cliente']['remitentes']);
			if($this->data['Cliente']['id'] == ""){
				$this->Cliente->create();
			}
			foreach ($this->data['Cliente']['contacto']['cargo'] as $key => $value) {
				$contactos[$key]['cargo']    = $value;
				$contactos[$key]['nombre']   = $this->data['Cliente']['contacto']['nombre'][$key];
				$contactos[$key]['telefono'] = $this->data['Cliente']['contacto']['telefono'][$key];
			}
			$this->request->data['Cliente']['contacto'] = json_encode($contactos);
			$this->Cliente->save($this->data);
		}
		if($clienteDoc == "*"){
			$clienteDoc = null;
		}
		$post['Cliente']['documento'] = $clienteDoc;
		$post['Cliente']['nombres']   = $clienteNom;
		$this->data = $post;
		$tipo       = $this->Cliente->getEnumValues('tipo');
		$cartera    = $this->Cliente->getEnumValues('cartera_negociable');
		$persona    = $this->Cliente->getEnumValues('persona');
		$activo     = $this->Cliente->getEnumValues('activo');
		$causal     = $this->Cliente->getEnumValues('causal');
		$credito    = $this->Cliente->getEnumValues('credito');
		$especial   = $this->Cliente->getEnumValues('especial');
		$remitentes = $this->Cliente->importModel('Remitente')->find('list');
		$destinos   = $this->Cliente->importModel('Destino')->find('list');

		$this->set(compact('tipo','activo','causal','credito','especial','cartera','persona','destinos','remitentes'));
	}
}
?>

<?php
class DestinatariosController extends AppController {
	public $name = 'Destinatarios';

	public function crear() {
		$role = $this->data['Destinatario']['role'];
		if(!empty($this->data) && $role != 5){
			$this->request->data['Destinatario']['destinos'] = json_encode($this->data['Destinatario']['destinos']);
			if($this->data['Destinatario']['id'] == ""){
				$this->Destinatario->create();
			}
			foreach ($this->data['Destinatario']['contacto']['nombre'] as $key => $value) {
				$contactos[$key]['nombre']   = $value;
				$contactos[$key]['telefono'] = $this->data['Destinatario']['contacto']['telefono'][$key];
			}
			$this->request->data['Destinatario']['contacto'] = json_encode($contactos);

			if($this->Destinatario->save($this->data)) {
				if($this->data['Destinatario']['clienteId'] != null){
					$this->redirect(array('controller'=>'ventas','action' => 'crear',$this->data['Destinatario']['clienteId'],$this->Destinatario->id,$this->data['Destinatario']['remitenteId'],$this->data['Destinatario']['origenId'],$this->data['Destinatario']['destinoId']));
				}
    			$this->Session->setFlash('','ok',array('mensaje'=>'El destinatario se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar el destinatario. Por favor intente nuevamente'));
			}
		}
		$this->data = null;
		$destinatarios = $this->Destinatario->find('all',array('recursive'=>-1));
		foreach ($destinatarios as $key => $value) {
			$destinatarios[$key]['Destinatario']['destinos']  = json_decode($destinatarios[$key]['Destinatario']['destinos'],true);
			$destinatarios[$key]['Destinatario']['contacto']  = json_decode($destinatarios[$key]['Destinatario']['contacto'],true);
			$destinatarios[$key]['Destinatario']['contacto1'] = $destinatarios[$key]['Destinatario']['contacto'][0]['nombre'];
			$destinatarios[$key]['Destinatario']['email1']    = '<a href="mailto:'.$destinatarios[$key]['Destinatario']['email'].'">'.$destinatarios[$key]['Destinatario']['email'].'</a>';
		}
		//$this->log($destinatarios);
		$tipo     = $this->Destinatario->getEnumValues('tipo');
		$destinos = $this->Destinatario->importModel('Destino')->find('list');
		$this->generateJSON('destinatarios', $destinatarios, array('Destinatario' => array('id','documento','listNombre','telefono','email1','direccion','contacto1')));

		$this->set(compact('destinatarios','tipo','destinos'));
	}

	public function crear2($destinoId = null,$destinatarioDoc = null, $destinatarioNom = null) {
		$this->layout = "empty";
		if(!empty($this->data)){
			$this->request->data['Destinatario']['destinos'] = json_encode($this->data['Destinatario']['destinos']);

			if($this->data['Destinatario']['id'] == ""){
				$this->Destinatario->create();
			}
			foreach ($this->data['Destinatario']['contacto']['nombre'] as $key => $value) {
				$contactos[$key]['nombre']   = $value;
				$contactos[$key]['telefono'] = $this->data['Destinatario']['contacto']['telefono'][$key];
			}
			$this->request->data['Destinatario']['contacto'] = json_encode($contactos);

			if($this->Destinatario->save($this->data)) {
    			$this->Session->setFlash('','ok',array('mensaje'=>'El destinatario se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar el destinatario. Por favor intente nuevamente'));
			}
		}
		//$this->log($destinatarios);
		if($destinatarioDoc == "*"){
			$destinatarioDoc = null;
		}
		$post['Destinatario']['documento'] = $destinatarioDoc;
		$post['Destinatario']['nombre1']   = $destinatarioNom;
		$this->data = $post;

		$tipo     = $this->Destinatario->getEnumValues('tipo');
		$destinos = $this->Destinatario->importModel('Destino')->find('list');

		$this->set(compact('destinoId','tipo','destinos'));
	}
}
?>

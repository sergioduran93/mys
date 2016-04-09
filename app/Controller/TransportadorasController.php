<?php
class TransportadorasController extends AppController {
	public $name = 'Transportadoras';

	public function crear() {
		$role = $this->data['Transportadora']['role'];
		if(!empty($this->data) && $role != 5 && $role != 6){
			$this->request->data['Transportadora']['destinos'] = json_encode($this->data['Transportadora']['destinos']);
			$agenciasArray = array();
			foreach ($this->data['Transportadora']['agencias']['municipio'] as $key => $value) {
				$agenciasArray[$key]['municipio'] = $value;
				$agenciasArray[$key]['contacto']  = $this->data['Transportadora']['agencias']['contacto'][$key];
				$agenciasArray[$key]['celular']   = $this->data['Transportadora']['agencias']['celular'][$key];
				$agenciasArray[$key]['telefono1'] = $this->data['Transportadora']['agencias']['telefono1'][$key];
				$agenciasArray[$key]['telefono2'] = $this->data['Transportadora']['agencias']['telefono2'][$key];
				$agenciasArray[$key]['telefono3'] = $this->data['Transportadora']['agencias']['telefono3'][$key];
			}
			$this->request->data['Transportadora']['agencias'] = json_encode($agenciasArray);
			
			if($this->data['Transportadora']['id'] == ''){
				$this->Transportadora->create();
    			$this->Session->setFlash('','ok',array('mensaje'=>'La transportadora se creo con exito'));
			} else {
				$agenciaList['Agencia']['transportadora_id'] = $this->data['Transportadora']['id'];
    			$this->Session->setFlash('','ok',array('mensaje'=>'La transportadora se edito con exito'));
			}
			if(!$this->Transportadora->save($this->data)){
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar la transportadora. Por favor intente nuevamente'));
			}
		}
		$this->data = null;
		$credito         = $this->Transportadora->getEnumValues('credito');
		$activo          = $this->Transportadora->getEnumValues('activo');		
		$destinos        = $this->Transportadora->importModel('Destino')->find('list');
		$transportadoras = $this->Transportadora->find('all',array('recursive'=>-1));
		foreach ($transportadoras as $key => $value) {
			$transportadoras[$key]['Transportadora']['agencias']  = json_decode($value['Transportadora']['agencias'],true);
			$transportadoras[$key]['Transportadora']['destinos']  = json_decode($value['Transportadora']['destinos'],true);
			$transportadoras[$key]['Transportadora']['municipio'] = $destinos[$transportadoras[$key]['Transportadora']['destinos'][0]];
		}
		$transportadorasJson = json_encode($transportadoras);
		$this->generateJSON( 'transportadoras', $transportadoras, array('Transportadora' => array('id','nit','razon','direccion','contacto','celular','telefono1','municipio')));
		$this->set(compact('transportadoras','credito','activo','transportadorasJson','destinos'));
	}

	public function eliminar($id = null) {
		if(!empty($id)){
			if($this->Transportadora->delete($id)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La transportadora se elimino con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La transportadora no se pudo eliminar'));
			}
		}
		$this->redirect(array('action' => 'crear'));
		
	}
}
?>

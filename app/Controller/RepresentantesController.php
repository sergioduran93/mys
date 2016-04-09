<?php
class RepresentantesController extends AppController {
	public $name = 'Representantes';

	public function crear($id = null) {
		$role = $this->data['Representante']['role'];
		if(!empty($this->data) && $role != 5 && $role != 6){
			$desti = $this->data['Representante']['destinos'];
			if($this->data['Representante']['id'] == ""){
				$this->Representante->create();
				App::import('model', 'Destinatario');
				$destinatarioImport                             = new Destinatario();
				$destinatarioNuevo['Destinatario']              = $this->data['Representante'];
				$destinatarioNuevo['Destinatario']['documento'] = $destinatarioNuevo['Destinatario']['identificacion'];
				$destinatarioNuevo['Destinatario']['telefono']  = $destinatarioNuevo['Destinatario']['telefono1'];
				$destinatarioNuevo['Destinatario']['destinos']  = json_encode($desti);
				$destinatarioNuevo['Destinatario']['tipo']      = 'Natural';
				$destinatarioImport->create();
				$destinatarioImport->save($destinatarioNuevo);
				$this->Representante->create();
				$this->Representante->save($this->data);
				$rxd['Representantexdestino']['representante_id'] = $this->Representante->id;
				$neg['Negociacion']['representante']              = $this->Representante->id;
			} else {				
				$this->Representante->save($this->data);
				$this->Representante->Representantexdestino->deleteAll(array('Representantexdestino.representante_id'=>$this->data['Representante']['id']));
				$this->Representante->importModel('Negociacion')->deleteAll(array('Negociacion.representante'=>$this->data['Representante']['id']));
				$rxd['Representantexdestino']['representante_id'] = $this->data['Representante']['id'];
				$neg['Negociacion']['representante']              = $this->data['Representante']['id'];
			}
			foreach ($desti as $key3 => $value3) {
				$this->Representante->Representantexdestino->create();
				$rxd['Representantexdestino']['destino_id'] = $value3;
				$this->Representante->Representantexdestino->save($rxd);
			}

			foreach ($this->data['Representante']['clientes'] as $key => $value) {
				$neg['Negociacion']['base_clie']    = $this->data['Representante']['base_clie'][$key];
				$neg['Negociacion']['caja_clie']    = $this->data['Representante']['caja_clie'][$key];
				$neg['Negociacion']['sobre_clie']   = $this->data['Representante']['sobre_clie'][$key];
				$neg['Negociacion']['paquete_clie'] = $this->data['Representante']['paquete_clie'][$key];
				$neg['Negociacion']['clientes']     = $this->data['Representante']['clientes'][$key];
				$this->Representante->importModel('Negociacion')->save($neg);
			}
		}
		$this->data = null;
		$tipo           = $this->Representante->getEnumValues('tipo');
		$marca          = $this->Representante->getEnumValues('marca');
		$oficina        = $this->Representante->getEnumValues('oficina');
		$banco          = $this->Representante->getEnumValues('banco');
		$tipo           = $this->Representante->getEnumValues('tipo');
		$contraentrega  = $this->Representante->getEnumValues('contraentrega');
		$servicio       = $this->Representante->getEnumValues('servicio');
		$giro           = $this->Representante->getEnumValues('giro');
		$destinos       = $this->Representante->importModel('Destino')->find('list');
		$representantes = $this->Representante->find('all',array('recursive'=>-1));
		$clientes       = $this->Representante->importModel('Cliente')->find('list',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$empaques       = $this->Representante->importModel('Empaque')->find('list',array('recursive'=>-1));
		foreach ($representantes as $key => $value) {
			$des    = $this->Representante->Representantexdestino->find('all',array('recursive'=>-1,'fields'=>array('Representantexdestino.destino_id'),'conditions'=>array('Representantexdestino.representante_id'=>$value['Representante']['id'])));
			$neg    = $this->Representante->importModel('Negociacion')->find('all',array('recursive'=>-1,'order'=>'Negociacion.clientes','conditions'=>array('Negociacion.representante'=>$value['Representante']['id'])));
			$desti  = array();
			$negoci = array();
			foreach ($des as $key2 => $value2) {
				$desti[] = $value2['Representantexdestino']['destino_id'];
			}
			$representantes[$key]['Representante']['destinos']    = $desti;
			$representantes[$key]['Representante']['negociacion'] = $neg;
		}
		$this->generateJSON('representantes', $representantes, array('Representante' => array('id','identificacion','codigo','listNombre','telefono1','celular','oficina')));
		
		$this->set(compact('id','empaques','clientes','oficina','banco','tipo','contraentrega','servicio','giro','destinos','representantes','negoci'));
	
	}

	public function rangos($repreId = null) {
		$this->layout = 'empty';
		if($repreId != null){
			$repre  = $this->Representante->find('first',array('recursive'=>-1,'conditions'=>array('Representante.id'=>$repreId),'fields'=>array('Representante.rangos')));
			$rangos = $repre['Representante']['rangos'];
		} else {
			$rangos['datos'] = '';
		}
		$this->set(compact('rangos'));
	}

	public function crear3() {
		if(!empty($this->data)){
			$desti = $this->data['Representante']['destinos'];
			if($this->data['Representante']['id'] == ""){
				$this->Representante->create();
				$this->Representante->save($this->data);
				$rxd['Representantexdestino']['representante_id'] = $this->Representante->id;
				$neg['Negociacion']['representante']              = $this->Representante->id;
			} else {				
				$this->Representante->save($this->data);
				$this->Representante->Representantexdestino->deleteAll(array('Representantexdestino.representante_id'=>$this->data['Representante']['id']));
				$this->Representante->importModel('Negociacion')->deleteAll(array('Negociacion.representante'=>$this->data['Representante']['id']));
				$rxd['Representantexdestino']['representante_id'] = $this->data['Representante']['id'];
				$neg['Negociacion']['representante']              = $this->data['Representante']['id'];
			}

			foreach ($desti as $key3 => $value3) {
				$this->Representante->Representantexdestino->create();
				$rxd['Representantexdestino']['destino_id'] = $value3;
				$this->Representante->Representantexdestino->save($rxd);
			}

			foreach ($this->data['Representante']['sobreespecial'] as $key => $value) {
				$neg['Negociacion']['sobreespecial'] = $this->data['Representante']['sobreespecial'][$key];
				$neg['Negociacion']['digitar']       = $this->data['Representante']['digitar'][$key];
				$neg['Negociacion']['escanear']      = $this->data['Representante']['escanear'][$key];
				$neg['Negociacion']['rangos']        = $this->data['Representante']['rangos'][$key];
				$neg['Negociacion']['clientes']      = $this->data['Representante']['clientes'][$key];
				$this->Representante->importModel('Negociacion')->save($neg);
			}
		}
		$tipo           = $this->Representante->getEnumValues('tipo');
		$marca          = $this->Representante->getEnumValues('marca');
		$oficina        = $this->Representante->getEnumValues('oficina');
		$banco          = $this->Representante->getEnumValues('banco');
		$tipo           = $this->Representante->getEnumValues('tipo');
		$contraentrega  = $this->Representante->getEnumValues('contraentrega');
		$servicio       = $this->Representante->getEnumValues('servicio');
		$giro           = $this->Representante->getEnumValues('giro');
		$destinos       = $this->Representante->importModel('Destino')->find('list');
		$representantes = $this->Representante->find('all',array('recursive'=>-1));
		$clientes       = $this->Representante->importModel('Cliente')->find('list',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		foreach ($representantes as $key => $value) {
			$des    = $this->Representante->Representantexdestino->find('all',array('recursive'=>-1,'fields'=>array('Representantexdestino.destino_id'),'conditions'=>array('Representantexdestino.representante_id'=>$value['Representante']['id'])));
			$neg    = $this->Representante->importModel('Negociacion')->find('all',array('recursive'=>-1,'order'=>'Negociacion.clientes','conditions'=>array('Negociacion.representante'=>$value['Representante']['id'])));
			$desti  = array();
			$negoci = array();
			foreach ($des as $key2 => $value2) {
				$desti[] = $value2['Representantexdestino']['destino_id'];
			}
			$representantes[$key]['Representante']['destinos']    = $desti;
			$representantes[$key]['Representante']['negociacion'] = $neg;
		}
		$this->generateJSON('representantes', $representantes, array('Representante' => array('id','identificacion','codigo','listNombre','telefono1','celular','oficina')));
		
		$this->set(compact('clientes','oficina','banco','tipo','contraentrega','servicio','giro','destinos','representantes','negoci'));
	
	}

	public function eliminar($id = null) {
		if($this->Representante->delete($id)){
	   		$this->Session->setFlash('','ok',array('mensaje'=>'El Representante se elimino con exito'));
		} else {
	   		$this->Session->setFlash('','error',array('mensaje'=>'El Representante no se pudo eliminar'));
		}
    	$this->redirect(array('action' => 'crear'));
	}
}
?>

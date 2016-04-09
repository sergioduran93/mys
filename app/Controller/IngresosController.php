<?php
class IngresosController extends AppController {
	public $name = 'Ingresos';

	public function crear() {
		
		if(!empty($this->data)){
			$arr              = array();
			$arr['conductor'] = $this->data['Ingreso']['conductor'];
			$arr['placa']     = $this->data['Ingreso']['placa'];
			$arr['usuario']   = $this->data['Ingreso']['usuario'];
			$arr['oficina']   = $this->data['Ingreso']['oficina'];
			$arr              = json_encode($arr);
			$aux = array();
			
			$guiasTrasl = $this->Ingreso->importModel('Venta')->find('list',array('fields'=>array('Venta.empaque_info'),'conditions'=>array('Venta.despachada'=>"EnTraslado :".$this->data['Ingreso']['oficina'])));
			foreach ($guiasTrasl as $key => $value) {
				$emp = json_decode($value,true);
				$guiasTrasl[$key] = array_filter(explode(",", implode("", $emp['barras'])));
			}

			foreach ($this->data['ingresos']['id'] as $key => $value) {
				if($this->data['ingresos']['nit'][$key] != "" && $this->data['ingresos']['cliente'][$key] != "" && $this->data['ingresos']['barras'][$key] != ""){
					$aux[$key]['Ingreso']['fecha']   = date("Y-m-d H:i:s");
					$aux[$key]['Ingreso']['barras']  = $this->data['ingresos']['barras'][$key];
					$aux[$key]['Ingreso']['cliente'] = $this->data['ingresos']['id'][$key];
					$aux[$key]['Ingreso']['info']    = $arr;
					$aux[$key]['Ingreso']['estado']  = 0;
				}
				if($this->data['ingresos']['barras2'][$key] != ""){
					foreach ($guiasTrasl as $key2 => $value2) {
						$index = array_search($this->data['ingresos']['barras2'][$key], $value2);
						if($index > -1){
							unset($guiasTrasl[$key2][$index]);
						}
					}
				}
			}
			$traslOK = array();
			foreach ($guiasTrasl as $key => $value) {
				if(empty($value)){
					$traslOK[] = $key;
				}
			}
			if(!empty($traslOK)){
				$this->Ingreso->importModel('Venta')->updateAll(array('Venta.despachada'=>$this->data['Ingreso']['oficina']),array('Venta.id'=>$traslOK));
			}
			if(count($aux)>0){
				$this->Ingreso->create();
				if($this->Ingreso->saveAll($aux)) {
						$this->Session->setFlash('','ok',array('mensaje'=>'El ingreso de la mercancia se guardo con exito'));
				} else {
					$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar el ingreso de la mercancia. Por favor intente nuevamente'));
				}
			}
			
		}
		$this->data = null;
		$conductores = $this->Ingreso->importModel('Conductor')->find('all',array('recursive'=>-1,'conditions'=>array('Conductor.conductor2'=>'1')));
		$vehiculos   = $this->Ingreso->importModel('Vehiculo')->find('all',array('recursive'=>-1));
		$clientes    = $this->Ingreso->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.tipo'=>'Clientes')));
		$auxiliares  = $this->Ingreso->importModel('Auxiliar')->find('list');
		
		foreach ($conductores as $key => $value) {
			$conductorId[$value['Conductor']['id']]  = $value['Conductor']['identificacion'];
			$conductorNom[$value['Conductor']['id']] = $value['Conductor']['listNombre'];
			$conductorCel[$value['Conductor']['id']] = $value['Conductor']['celular'];
		}

		foreach ($vehiculos as $key => $value) {
			$vehiculo[$value['Vehiculo']['id']]      = $value['Vehiculo']['placa'];
			$vehiculoTipo[$value['Vehiculo']['id']]  = $value['Vehiculo']['tipo'];
			$vehiculoMarca[$value['Vehiculo']['id']] = $value['Vehiculo']['marca'];
		}
		$cliente    = $this->Ingreso->importModel('Cliente')->find('list',array('conditions'=>array('Cliente.id >'=>'1')));
		$clienteNit = $this->Ingreso->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'conditions'=>array('Cliente.id >'=>'1')));
		
		$this->listar(array('Ingreso.estado'=>0),'ingresoCrear');
		$this->set(compact('auxiliares','vehiculoMarca','vehiculoTipo','clientes','conductorCel','conductorId','conductorNom','vehiculo','cliente','clienteNit'));
	}

	public function listar($conditions = null, $file = "ingresos") {
		$ingresos    = $this->Ingreso->find('all',array('conditions'=>$conditions,'order' => array('Ingreso.cliente')));
		$conductores = $this->Ingreso->importModel('Conductor')->find('list',array('conditions'=>array('Conductor.conductor2'=>1)));
		$conductorId = $this->Ingreso->importModel('Conductor')->find('list',array('conditions'=>array('Conductor.conductor2'=>1),'fields'=>array('Conductor.identificacion')));
		$clientes    = $this->Ingreso->importModel('Cliente')->find('list',array('conditions'=>array('Cliente.tipo'=>'Clientes')));
		$clienteId   = $this->Ingreso->importModel('Cliente')->find('list',array('conditions'=>array('Cliente.tipo'=>'Clientes'),'fields'=>array('Cliente.documento')));
		$vehiculos   = $this->Ingreso->importModel('Vehiculo')->find('list');
		$usuarios    = $this->Ingreso->importModel('User')->find('list');
		$oficinas    = $this->Ingreso->importModel('Oficina')->find('list');
		$cuenta = array();
		foreach ($ingresos as $key => $value) {
			$info = json_decode($value['Ingreso']['info'],true);
			$ingresos[$key]['Ingreso']['cliente']     = $clientes[$value['Ingreso']['cliente']];
			$ingresos[$key]['Ingreso']['clienteId']   = $clienteId[$value['Ingreso']['cliente']];
			$ingresos[$key]['Ingreso']['oficina']     = $oficinas[$info['oficina']];
			$ingresos[$key]['Ingreso']['usuario']     = $usuarios[$info['usuario']];
			$ingresos[$key]['Ingreso']['placa']       = $vehiculos[$info['placa']];
			$ingresos[$key]['Ingreso']['conductor']   = $conductores[$info['conductor']];
			$ingresos[$key]['Ingreso']['conductorId'] = $conductorId[$info['conductor']];
			$cuenta[$conductores[$info['conductor']].'*'.$vehiculos[$info['placa']]][$clientes[$value['Ingreso']['cliente']]] = $cuenta[$value['Ingreso']['cliente']] + 1;
		}
		$this->generateJSON($file, $ingresos, array('Ingreso' => array('id','fecha','barras','cliente','clienteId','placa','conductor','conductorId','usuario','oficina')));
		$this->set(compact('cuenta'));
	}

}
?>

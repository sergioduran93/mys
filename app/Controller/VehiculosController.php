<?php
class VehiculosController extends AppController {
	public $name = 'Vehiculos';
/*
	public function admin_crear() {
		$this->crear();
		$this->render('crear');
	}
*/

	public function negociacion() {
		$role = $this->data['Vehiculo']['role'];
		if(!empty($this->data)){
			$rang = array();
			foreach ($this->data['Vehiculo']['rangoUnidad']['desde'] as $key => $value) {
				$rang[$key]['desde']      = $value;
				$rang[$key]['desde2']     = $this->data['Vehiculo']['rangoUnidad']['desde2'][$key];
				$rang[$key]['hasta']      = $this->data['Vehiculo']['rangoUnidad']['hasta'][$key];
				$rang[$key]['hasta2']     = $this->data['Vehiculo']['rangoUnidad']['hasta2'][$key];
				$rang[$key]['descuento']  = $this->data['Vehiculo']['rangoUnidad']['descuento'][$key];
				$rang[$key]['descuento2'] = $this->data['Vehiculo']['rangoUnidad']['descuento2'][$key];
			}
			$rangJson = json_encode($rang);
			if($this->data['Vehiculo']['Radio'] == 'TodasRegiones'){
				$todasReg = $this->Vehiculo->importModel('Destino')->find('list',array('fields'=>array('id','id'),'conditions'=>array('Destino.region_id !='=>null)));
				$vehNeg = array();
				foreach ($todasReg as $key => $value) {
					$vehNeg[$key]['VehiculoNegociacion']             = $this->data['Vehiculo'];
					$vehNeg[$key]['VehiculoNegociacion']['id']       = '';
					$vehNeg[$key]['VehiculoNegociacion']['vehiculo'] = $this->data['Vehiculo']['id'];
					$vehNeg[$key]['VehiculoNegociacion']['destino']  = $value;
					$vehNeg[$key]['VehiculoNegociacion']['rangos']   = $rangJson;
				}
				$todasReg = $this->Vehiculo->importModel('VehiculoNegociacion')->saveAll($vehNeg);
			} else if($this->data['Vehiculo']['Radio'] == 'Region'){
				$todasReg = $this->Vehiculo->importModel('Destino')->find('list',array('fields'=>array('id','id'),'conditions'=>array('Destino.region_id'=>$this->data['Vehiculo']['region'])));
				$vehNeg = array();
				foreach ($todasReg as $key => $value) {
					$vehNeg[$key]['VehiculoNegociacion']             = $this->data['Vehiculo'];
					$vehNeg[$key]['VehiculoNegociacion']['id']       = '';
					$vehNeg[$key]['VehiculoNegociacion']['vehiculo'] = $this->data['Vehiculo']['id'];
					$vehNeg[$key]['VehiculoNegociacion']['destino']  = $value;
					$vehNeg[$key]['VehiculoNegociacion']['rangos']   = $rangJson;
				}
				$todasReg = $this->Vehiculo->importModel('VehiculoNegociacion')->saveAll($vehNeg);
			} else if($this->data['Vehiculo']['Radio'] == 'Destino'){
				$vehNeg = array();
				$vehNeg['VehiculoNegociacion']             = $this->data['Vehiculo'];
				$vehNeg['VehiculoNegociacion']['id']       = '';
				$vehNeg['VehiculoNegociacion']['vehiculo'] = $this->data['Vehiculo']['id'];
				$vehNeg['VehiculoNegociacion']['destino']  = $this->data['Vehiculo']['destino'];
				$vehNeg['VehiculoNegociacion']['rangos']   = $rangJson;
			
				$todasReg = $this->Vehiculo->importModel('VehiculoNegociacion')->save($vehNeg);
			}
		}
		$this->data = null;
		$vehiculos = $this->Vehiculo->find('all',array('recursive'=>0));
		$destinos  = $this->Vehiculo->importModel('Destino')->find('list');
		$regiones  = $this->Vehiculo->importModel('Region')->find('list');
		foreach ($vehiculos as $key => $value) {
			$vehiculos[$key]['Conductor']['ciudad']     = $destinos[$vehiculos[$key]['Conductor']['ciudad']];
			$vehiculos[$key]['Vehiculo']['destinos']    = json_decode($vehiculos[$key]['Vehiculo']['destinos'],true);
			$vehiculos[$key]['Vehiculo']['rangoUnidad'] = json_decode($vehiculos[$key]['Vehiculo']['rangoUnidad'],true);
		}

		$this->generateJSON('vehiculos', $vehiculos, array('Vehiculo' => array('id','placa','tipo','marca','modelo','numero_motor','numero_chasis')));
		
		$this->set(compact('vehiculos','regiones','destinos'));
	}

	public function crear() {
		$role = $this->data['Vehiculo']['role'];
		if(!empty($this->data) && $role != 5 && $role != 6){
			if($this->data['Vehiculo']['id'] == ''){
				$this->Vehiculo->create();
			}
			if($this->Vehiculo->save($this->data)) {
    			$this->Session->setFlash('','ok',array('mensaje'=>'El vehiculo se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar el vehiculo. Por favor intente nuevamente'));
			}
		}
		$this->data = null;
		$vehiculos = $this->Vehiculo->find('all',array('recursive'=>0));
		$destinos  = $this->Vehiculo->importModel('Destino')->find('list');
		foreach ($vehiculos as $key => $value) {
			$vehiculos[$key]['Conductor']['ciudad']     = $destinos[$vehiculos[$key]['Conductor']['ciudad']];
			$vehiculos[$key]['Vehiculo']['destinos']    = json_decode($vehiculos[$key]['Vehiculo']['destinos'],true);
			$vehiculos[$key]['Vehiculo']['rangoUnidad'] = json_decode($vehiculos[$key]['Vehiculo']['rangoUnidad'],true);
		}
		$propietarios = $this->Vehiculo->Conductor->find('all',array('recursive'=>-1,'conditions'=>array('Conductor.propietario'=>1)));
		
		foreach ($propietarios as $key => $value) {
			$propietarios[$key]['Conductor']['ciudad'] = $destinos[$propietarios[$key]['Conductor']['ciudad']];
		}
		
		$tipo  = $this->Vehiculo->getEnumValues('tipo');
		$marca = $this->Vehiculo->getEnumValues('marca');

		$this->generateJSON('vehiculos', $vehiculos, array('Vehiculo' => array('id','placa','tipo','marca','modelo','numero_motor','numero_chasis')));
		$this->generateJSON('propietarios', $propietarios, array('Conductor' => array('id','identificacion','listNombre','ciudad','telefono','celular','direccion')));
		
		$this->set(compact('vehiculos','tipo','marca','propietarios','destinos'));
	}

	public function asignar() {
		if(!empty($this->data)){

		}
		$destinos = $this->Vehiculo->importModel('Destino')->find('all',array('recursive'=> 0));
		$regiones = $this->Vehiculo->importModel('Region')->find('list');
		$destinosList = $this->Vehiculo->importModel('Destino')->find('list',array('recursive'=> 0));

		foreach ($destinos as $key=>$value){
			$destinosInfo[$key]['Destino']['departamentoCodigo'] = $value['Departamento']['codigo'];
			$destinosInfo[$key]['Destino']['departamentoNombre'] = $value['Departamento']['nombre'];
			$destinosInfo[$key]['Destino']['regionCodigo']       = $value['Region']['codigo'];
			$destinosInfo[$key]['Destino']['regionNombre']       = $value['Region']['nombre'];
			$destinosInfo[$key]['Destino']['codigo']             = $value['Destino']['codigo'];
			$destinosInfo[$key]['Destino']['nombre']             = $value['Destino']['nombre'];
		}

		//$this->generateJSON('destinos_Tarifas', $destinosInfo, array('Destino' => array('id','regionId','departamentoCodigo','departamentoNombre','regionCodigo','regionNombre','codigo','nombre')));

		$this->set(compact('clientes','destinosInfo','destinosList','regiones'));
	}

}
?>

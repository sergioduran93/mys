<?php
class DescuentosController extends AppController {
	public $name = 'Descuentos';

	public function crear() {
		if(!empty($this->data)){
			$this->Session->setFlash('','ok',array('mensaje'=>'El Descuento fue guardado con éxito'));
			if(!empty($this->data['Descuento']['cliente_id'])){
				$DescuentoNuevo['Descuento']['cliente_id']    = $this->data['Descuento']['cliente_id'];
				$DescuentoNuevo['Descuento']['origen']        = $this->data['Descuento']['destino3'];
				$DescuentoNuevo['Descuento']['actual_codigo'] = $this->Descuento->generateCode(5);

				if($this->data['Descuento']['descuento'] == "TodasRegiones"){
					$destinosRegion = $this->Descuento->importModel('Destino')->find('all',array('recursive'=> -1,'fields'=>'Destino.id','conditions'=>array('Destino.region_id !='=>0)));
					foreach ($destinosRegion as $key => $value) {
						$DescuentoNuevo['Descuento']['destino']         = $value['Destino']['id'];
						$DescuentoNuevo['Descuento']['kilo_inicial']    = null;
						$DescuentoNuevo['Descuento']['kilo_final']      = null;
						$DescuentoNuevo['Descuento']['kilo_porcentaje'] = null;
						foreach ($this->data['Descuento']['rangoUnidad']['desde'] as $i => $desde) {
							if(!empty($desde) && !empty($this->data['Descuento']['rangoUnidad']['hasta'][$i]) && !empty($this->data['Descuento']['rangoUnidad']['descuento'][$i])){
								$DescuentoNuevo['Descuento']['unidad_inicial']    = $desde;
								$DescuentoNuevo['Descuento']['unidad_final']      = $this->data['Descuento']['rangoUnidad']['hasta'][$i];
								$DescuentoNuevo['Descuento']['unidad_porcentaje'] = $this->data['Descuento']['rangoUnidad']['descuento'][$i];
								$this->Descuento->create();
								$this->Descuento->save($DescuentoNuevo);
							}
						}
						$DescuentoNuevo['Descuento']['unidad_inicial']    = null;
						$DescuentoNuevo['Descuento']['unidad_final']      = null;
						$DescuentoNuevo['Descuento']['unidad_porcentaje'] = null;
						foreach ($this->data['Descuento']['rangoKilo']['desde'] as $i => $desde) {
							if(!empty($desde) && !empty($this->data['Descuento']['rangoKilo']['hasta'][$i]) && !empty($this->data['Descuento']['rangoKilo']['descuento'][$i])){
								$DescuentoNuevo['Descuento']['kilo_inicial']    = $desde;
								$DescuentoNuevo['Descuento']['kilo_final']      = $this->data['Descuento']['rangoKilo']['hasta'][$i];
								$DescuentoNuevo['Descuento']['kilo_porcentaje'] = $this->data['Descuento']['rangoKilo']['descuento'][$i];
								$this->Descuento->create();
								$this->Descuento->save($DescuentoNuevo);
							}
						}
					}
				}
				if($this->data['Descuento']['descuento'] == "Region"){
					$destinosRegion = $this->Descuento->importModel('Destino')->find('all',array('recursive'=> -1,'fields'=>'Destino.id','conditions'=>array('Destino.region_id'=>$this->data['Descuento']['region'])));
					foreach ($destinosRegion as $key => $value) {					
						$DescuentoNuevo['Descuento']['destino'] = $value['Destino']['id'];
						$DescuentoNuevo['Descuento']['kilo_inicial'] = null;
						$DescuentoNuevo['Descuento']['kilo_final'] = null;
						$DescuentoNuevo['Descuento']['kilo_porcentaje'] = null;
						foreach ($this->data['Descuento']['rangoUnidad']['desde'] as $i => $desde) {
							if(!empty($desde) && !empty($this->data['Descuento']['rangoUnidad']['hasta'][$i]) && !empty($this->data['Descuento']['rangoUnidad']['descuento'][$i])){
								$DescuentoNuevo['Descuento']['unidad_inicial']    = $desde;
								$DescuentoNuevo['Descuento']['unidad_final']      = $this->data['Descuento']['rangoUnidad']['hasta'][$i];
								$DescuentoNuevo['Descuento']['unidad_porcentaje'] = $this->data['Descuento']['rangoUnidad']['descuento'][$i];
								$this->Descuento->create();
								$this->Descuento->save($DescuentoNuevo);
							}
						}
						$DescuentoNuevo['Descuento']['unidad_inicial']    = null;
						$DescuentoNuevo['Descuento']['unidad_final']      = null;
						$DescuentoNuevo['Descuento']['unidad_porcentaje'] = null;
						foreach ($this->data['Descuento']['rangoKilo']['desde'] as $i => $desde) {
							if(!empty($desde) && !empty($this->data['Descuento']['rangoKilo']['hasta'][$i]) && !empty($this->data['Descuento']['rangoKilo']['descuento'][$i])){
								$DescuentoNuevo['Descuento']['kilo_inicial']    = $desde;
								$DescuentoNuevo['Descuento']['kilo_final']      = $this->data['Descuento']['rangoKilo']['hasta'][$i];
								$DescuentoNuevo['Descuento']['kilo_porcentaje'] = $this->data['Descuento']['rangoKilo']['descuento'][$i];
								$this->Descuento->create();
								$this->Descuento->save($DescuentoNuevo);
							}
						}
					}
				}
				if($this->data['Descuento']['descuento'] == "Destino"){
					$DescuentoNuevo['Descuento']['destino'] = $this->data['Descuento']['destino_id'];
					$DescuentoNuevo['Descuento']['kilo_inicial'] = null;
					$DescuentoNuevo['Descuento']['kilo_final'] = null;
					$DescuentoNuevo['Descuento']['kilo_porcentaje'] = null;
					foreach ($this->data['Descuento']['rangoUnidad']['desde'] as $i => $desde) {
						if(!empty($desde) && !empty($this->data['Descuento']['rangoUnidad']['hasta'][$i]) && !empty($this->data['Descuento']['rangoUnidad']['descuento'][$i])){
							$DescuentoNuevo['Descuento']['unidad_inicial']    = $desde;
							$DescuentoNuevo['Descuento']['unidad_final']      = $this->data['Descuento']['rangoUnidad']['hasta'][$i];
							$DescuentoNuevo['Descuento']['unidad_porcentaje'] = $this->data['Descuento']['rangoUnidad']['descuento'][$i];
							$this->Descuento->create();
							$this->Descuento->save($DescuentoNuevo);
						}
					}
					$DescuentoNuevo['Descuento']['unidad_inicial']    = null;
					$DescuentoNuevo['Descuento']['unidad_final']      = null;
					$DescuentoNuevo['Descuento']['unidad_porcentaje'] = null;
					foreach ($this->data['Descuento']['rangoKilo']['desde'] as $i => $desde) {
						if(!empty($desde) && !empty($this->data['Descuento']['rangoKilo']['hasta'][$i]) && !empty($this->data['Descuento']['rangoKilo']['descuento'][$i])){
							$DescuentoNuevo['Descuento']['kilo_inicial']    = $desde;
							$DescuentoNuevo['Descuento']['kilo_final']      = $this->data['Descuento']['rangoKilo']['hasta'][$i];
							$DescuentoNuevo['Descuento']['kilo_porcentaje'] = $this->data['Descuento']['rangoKilo']['descuento'][$i];
							$this->Descuento->create();
							$this->Descuento->save($DescuentoNuevo);
						}
					}
				}
			} else {
				$this->Session->setFlash('','error',array('mensaje'=>'Cliente no válido, por favor intente nuevamente'));
			}
		}

		$clientes = $this->Descuento->Cliente->find('all',array('recursive'=>-1));
		$destinos = $this->Descuento->importModel('Destino')->find('all',array('recursive'=> 0));
		$regiones = $this->Descuento->importModel('Region')->find('list');
		$destinosList = $this->Descuento->importModel('Destino')->find('list',array('recursive'=> 0));

		foreach ($destinos as $key=>$value){
			$destinosInfo[$key]['Destino']['departamentoCodigo'] = $value['Departamento']['codigo'];
			$destinosInfo[$key]['Destino']['departamentoNombre'] = $value['Departamento']['nombre'];
			$destinosInfo[$key]['Destino']['regionId']           = $value['Region']['id'];
			$destinosInfo[$key]['Destino']['regionCodigo']       = $value['Region']['codigo'];
			$destinosInfo[$key]['Destino']['regionNombre']       = $value['Region']['nombre'];
			$destinosInfo[$key]['Destino']['codigo']             = $value['Destino']['codigo'];
			$destinosInfo[$key]['Destino']['nombre']             = $value['Destino']['nombre'];
			$destinosInfo[$key]['Destino']['id']                 = $value['Destino']['id'];
		}

		$this->generateJSON('clientes_Descuentos', $clientes, array('Cliente' => array('id','id','documento','listNombre','telefono','telefono2','direccion','celular')), 1);
		$this->generateJSON('destinos_Descuentos', $destinosInfo, array('Destino' => array('id','regionId','departamentoCodigo','departamentoNombre','regionCodigo','regionNombre','codigo','nombre')));

		$this->set(compact('clientes','destinosInfo','destinosList','regiones'));
	}

	public function excel($clienteId = null) {
		if(!empty($clienteId)){
			Configure::write('debug', 0);
			$descuentos = $this->Descuento->find('all',array('order' => array('Descuento.origen', 'Descuento.destino DESC', 'Descuento.unidad_inicial ASC', 'Descuento.kilo_inicial ASC'),'fields'=>array('Descuento.unidad_inicial','Descuento.unidad_final','Descuento.unidad_porcentaje','Descuento.kilo_inicial','Descuento.kilo_final','Descuento.kilo_porcentaje','Descuento.origen','Descuento.destino','Cliente.nombres','Cliente.apellidos','Cliente.documento','Cliente.telefono','Cliente.direccion','Cliente.email'),'conditions'=>array('Descuento.cliente_id'=>$clienteId)));
			$destinos = $this->Descuento->importModel('Destino')->find('list');
			foreach ($descuentos as $key => $value) {
				$descuentos[$key]['Descuento']['origen']  = $destinos[$descuentos[$key]['Descuento']['origen']];
				$descuentos[$key]['Descuento']['destino'] = $destinos[$descuentos[$key]['Descuento']['destino']];
			}
			$this->ExcelWrite->descuentos($descuentos);
		} else {
			$this->Session->setFlash('','error',array('mensaje'=>'No se ha seleccionado un cliente.'));
    		$this->redirect(array('action' => 'crear'));
		}
	}

	public function deshacer($clienteId = null) {
		if(!empty($clienteId)){
			$descuentos = $this->Descuento->find('all',array('order' => array('Descuento.origen', 'Descuento.destino DESC', 'Descuento.unidad_inicial ASC', 'Descuento.kilo_inicial ASC'),'fields'=>array('Descuento.unidad_inicial','Descuento.unidad_final','Descuento.unidad_porcentaje','Descuento.kilo_inicial','Descuento.kilo_final','Descuento.kilo_porcentaje','Descuento.origen','Descuento.destino','Cliente.nombres','Cliente.apellidos','Cliente.documento','Cliente.telefono','Cliente.direccion','Cliente.email'),'conditions'=>array('Descuento.cliente_id'=>$clienteId)));
			
			$this->Descuento->deleteAll(array('Descuento.actual' => 1,'Descuento.cliente_id'=>$clienteId),false);
			$this->Descuento->updateAll(
				array('Descuento.actual' => 1),
				array('Descuento.actual' => 0,'Descuento.cliente_id'=>$clienteId)
			);
			$this->Session->setFlash('','ok',array('mensaje'=>'Los descuentos fueron modificados con éxito.'));			
		} else {
			$this->Session->setFlash('','error',array('mensaje'=>'No se ha seleccionado un cliente.'));
		}
    	$this->redirect(array('action' => 'crear'));
	}

}
?>

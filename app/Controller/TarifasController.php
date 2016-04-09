<?php
class TarifasController extends AppController {
	public $name = 'Tarifas';

	public function getTarifa($cliente = null,$origen = null, $destino = null) {
		$this->autoRender = false;
		$tarifas   = array();
		if(!empty($cliente) && !empty($origen) && !empty($destino)){
			$tarifas = $this->Tarifa->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
		}
		return json_encode($tarifas);
	}
	public function getDescuentos($cliente = null,$origen = null, $destino = null) {
		$this->autoRender = false;
		$descuentos = $this->Tarifa->importModel('Descuento')->find('all',array('order'=>array('Descuento.kilo_inicial'=>'ASC','Descuento.unidad_inicial'=>'ASC'),'recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
		$desc    = array();
        $index = 0;
        $init  = 1;
		foreach ($descuentos as $key => $value) {
			if($value['Descuento']['unidad_inicial'] != ""){
				$desc['Todo'][$index]['desde']      = $value['Descuento']['unidad_inicial'];
				$desc['Todo'][$index]['hasta']      = $value['Descuento']['unidad_final'];
				$desc['Todo'][$index]['descuento']  = $value['Descuento']['unidad_porcentaje'];
				$desc['Todo'][$index]['desde2']     = "";
				$desc['Todo'][$index]['hasta2']     = "";
				$desc['Todo'][$index]['descuento2'] = "";
			} else {
				if($init == 1){
					$max   = $index;
					$index = 0;
					$init  = 0;
				}
				if($index >= $max){
					$desc['Todo'][$index]['desde']      = "";
					$desc['Todo'][$index]['hasta']      = "";
					$desc['Todo'][$index]['descuento']  = "";
				}
				$desc['Todo'][$index]['desde2']      = $value['Descuento']['kilo_inicial'];
				$desc['Todo'][$index]['hasta2']      = $value['Descuento']['kilo_final'];
				$desc['Todo'][$index]['descuento2']  = $value['Descuento']['kilo_porcentaje'];
			}
			$index = $index + 1;
		}
		return json_encode($desc);
	}
	public function tarifaDescuentos(){
		if(!empty($this->data)){
			$this->request->data['Tarifa'] = $this->data['Convenio'];
			$this->Session->setFlash('','ok',array('mensaje'=>'La tarifa fue guardada con éxito'));
			$DescuentoNuevo['Descuento']['cliente_id']    = 1;
			$DescuentoNuevo['Descuento']['origen']        = $this->data['Tarifa']['destino3'];
			if($this->data['Tarifa']['tarifa'] == "TodasRegiones"){
				$destinosRegion = $this->Tarifa->importModel('Destino')->find('all',array('recursive'=> -1,'fields'=>'Destino.id','conditions'=>array('Destino.region_id !='=>0)));
				foreach ($destinosRegion as $key => $value) {					
					$DescuentoNuevo['Descuento']['destino']         = $value['Destino']['id'];
					$DescuentoNuevo['Descuento']['kilo_inicial']    = null;
					$DescuentoNuevo['Descuento']['kilo_final']      = null;
					$DescuentoNuevo['Descuento']['kilo_porcentaje'] = null;
					$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['origen'],'Descuento.destino' => $DescuentoNuevo['Descuento']['destino']), false);
					$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['destino'],'Descuento.destino' => $DescuentoNuevo['Descuento']['origen']), false);
					foreach ($this->data['Tarifa']['rangoUnidad']['desde'] as $i => $desde) {
						if(!empty($desde) && !empty($this->data['Tarifa']['rangoUnidad']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoUnidad']['descuento'][$i])){
							$DescuentoNuevo['Descuento']['unidad_inicial']    = $desde;
							$DescuentoNuevo['Descuento']['unidad_final']      = $this->data['Tarifa']['rangoUnidad']['hasta'][$i];
							$DescuentoNuevo['Descuento']['unidad_porcentaje'] = $this->data['Tarifa']['rangoUnidad']['descuento'][$i];
							$this->Tarifa->importModel('Descuento')->create();
							$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
							if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
								$DescuentoNuevo2                         = $DescuentoNuevo;
								$DescuentoNuevo2['Descuento']['origen']  = $value['Destino']['id'];
								$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
								$this->Tarifa->importModel('Descuento')->create();
								$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
							}
						}
					}
					$DescuentoNuevo['Descuento']['unidad_inicial']    = null;
					$DescuentoNuevo['Descuento']['unidad_final']      = null;
					$DescuentoNuevo['Descuento']['unidad_porcentaje'] = null;
					foreach ($this->data['Tarifa']['rangoKilo']['desde'] as $i => $desde) {
						if(!empty($desde) && !empty($this->data['Tarifa']['rangoKilo']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoKilo']['descuento'][$i])){
							$DescuentoNuevo['Descuento']['kilo_inicial']    = $desde;
							$DescuentoNuevo['Descuento']['kilo_final']      = $this->data['Tarifa']['rangoKilo']['hasta'][$i];
							$DescuentoNuevo['Descuento']['kilo_porcentaje'] = $this->data['Tarifa']['rangoKilo']['descuento'][$i];
							$this->Tarifa->importModel('Descuento')->create();
							$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
							if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
								$DescuentoNuevo2                         = $DescuentoNuevo;
								$DescuentoNuevo2['Descuento']['origen']  = $value['Destino']['id'];
								$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
								$this->Tarifa->importModel('Descuento')->create();
								$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
							}
						}
					}
				}
			}
			if($this->data['Tarifa']['tarifa'] == "Region"){
				$destinosRegion = $this->Tarifa->importModel('Destino')->find('all',array('recursive'=> -1,'fields'=>'Destino.id','conditions'=>array('Destino.region_id'=>$this->data['Tarifa']['region'])));
				foreach ($destinosRegion as $key => $value) {
					$DescuentoNuevo['Descuento']['destino']         = $value['Destino']['id'];
					$DescuentoNuevo['Descuento']['kilo_inicial']    = null;
					$DescuentoNuevo['Descuento']['kilo_final']      = null;
					$DescuentoNuevo['Descuento']['kilo_porcentaje'] = null;
					$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['origen'],'Descuento.destino' => $DescuentoNuevo['Descuento']['destino']), false);
					$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['destino'],'Descuento.destino' => $DescuentoNuevo['Descuento']['origen']), false);

					foreach ($this->data['Tarifa']['rangoUnidad']['desde'] as $i => $desde) {
						if(!empty($desde) && !empty($this->data['Tarifa']['rangoUnidad']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoUnidad']['descuento'][$i])){
							$DescuentoNuevo['Descuento']['unidad_inicial']    = $desde;
							$DescuentoNuevo['Descuento']['unidad_final']      = $this->data['Tarifa']['rangoUnidad']['hasta'][$i];
							$DescuentoNuevo['Descuento']['unidad_porcentaje'] = $this->data['Tarifa']['rangoUnidad']['descuento'][$i];
							$this->Tarifa->importModel('Descuento')->create();
							$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
							if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
								$DescuentoNuevo2                         = $DescuentoNuevo;
								$DescuentoNuevo2['Descuento']['origen']  = $value['Destino']['id'];
								$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
								$this->Tarifa->importModel('Descuento')->create();
								$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
							}
						}
					}
					$DescuentoNuevo['Descuento']['unidad_inicial']    = null;
					$DescuentoNuevo['Descuento']['unidad_final']      = null;
					$DescuentoNuevo['Descuento']['unidad_porcentaje'] = null;
					foreach ($this->data['Tarifa']['rangoKilo']['desde'] as $i => $desde) {
						if(!empty($desde) && !empty($this->data['Tarifa']['rangoKilo']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoKilo']['descuento'][$i])){
							$DescuentoNuevo['Descuento']['kilo_inicial']    = $desde;
							$DescuentoNuevo['Descuento']['kilo_final']      = $this->data['Tarifa']['rangoKilo']['hasta'][$i];
							$DescuentoNuevo['Descuento']['kilo_porcentaje'] = $this->data['Tarifa']['rangoKilo']['descuento'][$i];
							$this->Tarifa->importModel('Descuento')->create();
							$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
							if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
								$DescuentoNuevo2                         = $DescuentoNuevo;
								$DescuentoNuevo2['Descuento']['origen']  = $value['Destino']['id'];
								$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
								$this->Tarifa->importModel('Descuento')->create();
								$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
							}
						}
					}
				}
			}

			if($this->data['Tarifa']['tarifa'] == "Destino"){
				$DescuentoNuevo['Descuento']['destino'] = $this->data['Tarifa']['destino_id'];
				$DescuentoNuevo['Descuento']['kilo_inicial']    = null;
				$DescuentoNuevo['Descuento']['kilo_final']      = null;
				$DescuentoNuevo['Descuento']['kilo_porcentaje'] = null;
				$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['origen'],'Descuento.destino' => $DescuentoNuevo['Descuento']['destino']), false);
				$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['destino'],'Descuento.destino' => $DescuentoNuevo['Descuento']['origen']), false);
				
				foreach ($this->data['Tarifa']['rangoUnidad']['desde'] as $i => $desde) {
					if(!empty($desde) && !empty($this->data['Tarifa']['rangoUnidad']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoUnidad']['descuento'][$i])){
						$DescuentoNuevo['Descuento']['unidad_inicial']    = $desde;
						$DescuentoNuevo['Descuento']['unidad_final']      = $this->data['Tarifa']['rangoUnidad']['hasta'][$i];
						$DescuentoNuevo['Descuento']['unidad_porcentaje'] = $this->data['Tarifa']['rangoUnidad']['descuento'][$i];
						$this->Tarifa->importModel('Descuento')->create();
						$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
						if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
							$DescuentoNuevo2                         = $DescuentoNuevo;
							$DescuentoNuevo2['Descuento']['origen']  = $this->data['Tarifa']['destino_id'];
							$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->importModel('Descuento')->create();
							$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
						}
					}
				}
				$DescuentoNuevo['Descuento']['unidad_inicial']    = null;
				$DescuentoNuevo['Descuento']['unidad_final']      = null;
				$DescuentoNuevo['Descuento']['unidad_porcentaje'] = null;
				foreach ($this->data['Tarifa']['rangoKilo']['desde'] as $i => $desde) {
					if(!empty($desde) && !empty($this->data['Tarifa']['rangoKilo']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoKilo']['descuento'][$i])){
						$DescuentoNuevo['Descuento']['kilo_inicial']    = $desde;
						$DescuentoNuevo['Descuento']['kilo_final']      = $this->data['Tarifa']['rangoKilo']['hasta'][$i];
						$DescuentoNuevo['Descuento']['kilo_porcentaje'] = $this->data['Tarifa']['rangoKilo']['descuento'][$i];
						$this->Tarifa->importModel('Descuento')->create();
						$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
						if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
							$DescuentoNuevo2                         = $DescuentoNuevo;
							$DescuentoNuevo2['Descuento']['origen']  = $this->data['Tarifa']['destino_id'];
							$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->importModel('Descuento')->create();
							$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
						}
					}
				}
			}
			$this->Session->setFlash('','ok',array('mensaje'=>'La Tarifa se guardo con éxito'));				
		}
		$this->data = null;
		$descuentos = $this->Tarifa->importModel('Descuento')->find('all',array('order'=>array('Descuento.origen'=>'ASC','Descuento.destino'=>'ASC','Descuento.kilo_inicial'=>'ASC','Descuento.unidad_inicial'=>'ASC'),'recursive'=>-1,'conditions'=>array('Descuento.cliente_id'=>1)));
		$desc       = array();
		$maxDesc = count($descuentos);
		if($maxDesc > 0){
			$destinos = $this->Tarifa->importModel('Destino')->find('list');
			$origen   = $descuentos[0]['Descuento']['origen'];
			$destino  = $descuentos[0]['Descuento']['destino'];
			foreach ($descuentos as $key => $value) {
				if($value['Descuento']['origen'] != $origen || $value['Descuento']['destino'] != $destino){
					$mayor = $uni['desde'];
					if(count($uni['desde2']) > count($uni['desde'])){
						$mayor = $uni['desde2'];
					}
					foreach ($mayor as $key3 => $value3) {
						$desc[$origen][$destino]['Todo'][$key3]['desde']      = $uni['desde'][$key3]      ? $uni['desde'][$key3] : "";
						$desc[$origen][$destino]['Todo'][$key3]['hasta']      = $uni['hasta'][$key3]      ? $uni['hasta'][$key3] : "";
						$desc[$origen][$destino]['Todo'][$key3]['descuento']  = $uni['descuento'][$key3]  ? $uni['descuento'][$key3] : "";
						$desc[$origen][$destino]['Todo'][$key3]['desde2']     = $uni['desde2'][$key3]     ? $uni['desde2'][$key3] : "";
						$desc[$origen][$destino]['Todo'][$key3]['hasta2']     = $uni['hasta2'][$key3]     ? $uni['hasta2'][$key3] : "";
						$desc[$origen][$destino]['Todo'][$key3]['descuento2'] = $uni['descuento2'][$key3] ? $uni['descuento2'][$key3] : "";
					}
					$uni = array();
				}
				$origen  = $value['Descuento']['origen'];
				$destino = $value['Descuento']['destino'];
				if($value['Descuento']['unidad_inicial'] != ""){
					$uni['desde'][]      = $value['Descuento']['unidad_inicial'];
					$uni['hasta'][]      = $value['Descuento']['unidad_final'];
					$uni['descuento'][]  = $value['Descuento']['unidad_porcentaje'];
				} else if($value['Descuento']['kilo_inicial'] != ""){
					$uni['desde2'][]     = $value['Descuento']['kilo_inicial'];
					$uni['hasta2'][]     = $value['Descuento']['kilo_final'];
					$uni['descuento2'][] = $value['Descuento']['kilo_porcentaje'];
				}
				if($key == ($maxDesc-1)){
					$mayor = $uni['desde'];
					if(count($uni['desde2']) > count($uni['desde'])){
						$mayor = $uni['desde2'];
					}
					foreach ($mayor as $key3 => $value3) {
						$desc[$origen][$destino]['Todo'][$key3]['desde']      = $uni['desde'][$key3]      ? $uni['desde'][$key3] : "";
						$desc[$origen][$destino]['Todo'][$key3]['hasta']      = $uni['hasta'][$key3]      ? $uni['hasta'][$key3] : "";
						$desc[$origen][$destino]['Todo'][$key3]['descuento']  = $uni['descuento'][$key3]  ? $uni['descuento'][$key3] : "";
						$desc[$origen][$destino]['Todo'][$key3]['desde2']     = $uni['desde2'][$key3]     ? $uni['desde2'][$key3] : "";
						$desc[$origen][$destino]['Todo'][$key3]['hasta2']     = $uni['hasta2'][$key3]     ? $uni['hasta2'][$key3] : "";
						$desc[$origen][$destino]['Todo'][$key3]['descuento2'] = $uni['descuento2'][$key3] ? $uni['descuento2'][$key3] : "";
					}
					$uni = array();
				}
			}
		}

		//$tarifas      = $this->Tarifa->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.cliente_id'=>1)));
		$destinos     = $this->Tarifa->importModel('Destino')->find('all',array('recursive'=> 0));
		$regiones     = $this->Tarifa->importModel('Region')->find('list');
		$destinosList = $this->Tarifa->importModel('Destino')->find('list',array('recursive'=> 0));

		foreach ($destinos as $key=>$value){
			$destinosInfo[$key]['Destino']['regionId']           = $value['Region']['id'];
			$destinosInfo[$key]['Destino']['regionCodigo']       = $value['Region']['codigo'];
			$destinosInfo[$key]['Destino']['regionNombre']       = $value['Region']['nombre'];
			$destinosInfo[$key]['Destino']['codigo']             = $value['Destino']['codigo'];
			$destinosInfo[$key]['Destino']['nombre']             = $value['Destino']['nombre'];
			$destinosInfo[$key]['Destino']['id']                 = $value['Destino']['id'];
		}
		$this->generateJSON('destinos_Tarifas', $destinosInfo, array('Destino' => array('id','regionId','regionCodigo','regionNombre','codigo','nombre')));

		$this->set(compact('desc','destinosInfo','destinosList','regiones'));
	}
	public function crear() {
		if(!empty($this->data)){
			$this->request->data['Convenio']['valor_sobre']   = str_replace(",","",$this->data['Convenio']['valor_sobre']);
			$this->request->data['Convenio']['valor_paquete'] = str_replace(",","",$this->data['Convenio']['valor_paquete']);
			$this->request->data['Convenio']['valor_caja']    = str_replace(",","",$this->data['Convenio']['valor_caja']);
			$this->request->data['Convenio']['valor_devol']   = str_replace(",","",$this->data['Convenio']['valor_devol']);
			$this->request->data['Convenio']['valor_otros']   = str_replace(",","",$this->data['Convenio']['valor_otros']);
			$this->request->data['Convenio']['declarado']     = str_replace(",","",$this->data['Convenio']['declarado']);
			$this->request->data['Tarifa'] = $this->data['Convenio'];
			$this->Session->setFlash('','ok',array('mensaje'=>'La tarifa fue guardada con éxito'));

			$otrosEmpaques       = json_decode($this->data['Tarifa']['otros_empaques'],true);
			$otrosEmpaquesLlenos = array();
			if(!empty($otrosEmpaques)){
				foreach ($otrosEmpaques['datos'] as $key => $value) {
					if(!empty($value['empaque_id']) && !empty($value['tarifa']) && !empty($value['max_kilo'])){
						$otrosEmpaquesLlenos['empaque_id'][] = $value['empaque_id'];
						$otrosEmpaquesLlenos['tarifa'][]     = $value['tarifa'];
						$otrosEmpaquesLlenos['max_kilo'][]   = $value['max_kilo'];
					}
				}
			}
			$TarifaNuevo['Tarifa']['cliente_id']       = 1;
			$TarifaNuevo['Tarifa']['valor_adicional']  = $this->data['Tarifa']['valor_adicional'];
			$TarifaNuevo['Tarifa']['declarado']        = $this->data['Tarifa']['declarado'];
			$TarifaNuevo['Tarifa']['porcen_declarado'] = $this->data['Tarifa']['porcen_declarado'];

			$DescuentoNuevo['Descuento']['cliente_id']    = 1;
			$DescuentoNuevo['Descuento']['origen']        = $this->data['Tarifa']['destino3'];

			if($this->data['Tarifa']['tarifa'] == "TodasRegiones"){
				$destinosRegion = $this->Tarifa->importModel('Destino')->find('all',array('recursive'=> -1,'fields'=>'Destino.id','conditions'=>array('Destino.region_id !='=>0)));
				foreach ($destinosRegion as $key => $value) {					
					$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];

					$DescuentoNuevo['Descuento']['destino']         = $value['Destino']['id'];
					$DescuentoNuevo['Descuento']['kilo_inicial']    = null;
					$DescuentoNuevo['Descuento']['kilo_final']      = null;
					$DescuentoNuevo['Descuento']['kilo_porcentaje'] = null;
					$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['origen'],'Descuento.destino' => $DescuentoNuevo['Descuento']['destino']), false);
					$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['destino'],'Descuento.destino' => $DescuentoNuevo['Descuento']['origen']), false);
					foreach ($this->data['Tarifa']['rangoUnidad']['desde'] as $i => $desde) {
						if(!empty($desde) && !empty($this->data['Tarifa']['rangoUnidad']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoUnidad']['descuento'][$i])){
							$DescuentoNuevo['Descuento']['unidad_inicial']    = $desde;
							$DescuentoNuevo['Descuento']['unidad_final']      = $this->data['Tarifa']['rangoUnidad']['hasta'][$i];
							$DescuentoNuevo['Descuento']['unidad_porcentaje'] = $this->data['Tarifa']['rangoUnidad']['descuento'][$i];
							$this->Tarifa->importModel('Descuento')->create();
							$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
							if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
								$DescuentoNuevo2                         = $DescuentoNuevo;
								$DescuentoNuevo2['Descuento']['origen']  = $value['Destino']['id'];
								$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
								$this->Tarifa->importModel('Descuento')->create();
								$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
							}
						}
					}
					$DescuentoNuevo['Descuento']['unidad_inicial']    = null;
					$DescuentoNuevo['Descuento']['unidad_final']      = null;
					$DescuentoNuevo['Descuento']['unidad_porcentaje'] = null;
					foreach ($this->data['Tarifa']['rangoKilo']['desde'] as $i => $desde) {
						if(!empty($desde) && !empty($this->data['Tarifa']['rangoKilo']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoKilo']['descuento'][$i])){
							$DescuentoNuevo['Descuento']['kilo_inicial']    = $desde;
							$DescuentoNuevo['Descuento']['kilo_final']      = $this->data['Tarifa']['rangoKilo']['hasta'][$i];
							$DescuentoNuevo['Descuento']['kilo_porcentaje'] = $this->data['Tarifa']['rangoKilo']['descuento'][$i];
							$this->Tarifa->importModel('Descuento')->create();
							$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
							if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
								$DescuentoNuevo2                         = $DescuentoNuevo;
								$DescuentoNuevo2['Descuento']['origen']  = $value['Destino']['id'];
								$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
								$this->Tarifa->importModel('Descuento')->create();
								$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
							}
						}
					}

					if(!empty($this->data['Tarifa']['valor_sobre']) && !empty($this->data['Tarifa']['max_sobre'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 1;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_sobre'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_sobre'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
						$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
						$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
					if(!empty($this->data['Tarifa']['valor_paquete']) && !empty($this->data['Tarifa']['max_paquete'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 2;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_paquete'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_paquete'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
						$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
						$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
					if(!empty($this->data['Tarifa']['valor_caja']) && !empty($this->data['Tarifa']['max_caja'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 3;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_caja'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_caja'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
						$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
						$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
					if(!empty($this->data['Tarifa']['valor_devol']) && !empty($this->data['Tarifa']['max_devol'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 4;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_devol'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_devol'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
						$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
						$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
					if(!empty($this->data['Tarifa']['valor_otros']) && !empty($this->data['Tarifa']['max_otros'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 5;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_otros'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_otros'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
						$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
						$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
					if(!empty($otrosEmpaques)){
						foreach ($otrosEmpaquesLlenos['empaque_id'] as $i => $j) {
							$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
							$TarifaNuevo['Tarifa']['empaque_id'] = $otrosEmpaquesLlenos['empaque_id'][$i];
							$TarifaNuevo['Tarifa']['tarifa']     = $otrosEmpaquesLlenos['tarifa'][$i];
							$TarifaNuevo['Tarifa']['max_kilo']   = $otrosEmpaquesLlenos['max_kilo'][$i];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
							$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
							$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
						}
					}
				}
			}

			if($this->data['Tarifa']['tarifa'] == "Region"){
				$destinosRegion = $this->Tarifa->importModel('Destino')->find('all',array('recursive'=> -1,'fields'=>'Destino.id','conditions'=>array('Destino.region_id'=>$this->data['Tarifa']['region'])));
				foreach ($destinosRegion as $key => $value) {
					$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
					$DescuentoNuevo['Descuento']['destino']         = $value['Destino']['id'];
					$DescuentoNuevo['Descuento']['kilo_inicial']    = null;
					$DescuentoNuevo['Descuento']['kilo_final']      = null;
					$DescuentoNuevo['Descuento']['kilo_porcentaje'] = null;
					$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['origen'],'Descuento.destino' => $DescuentoNuevo['Descuento']['destino']), false);
					$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['destino'],'Descuento.destino' => $DescuentoNuevo['Descuento']['origen']), false);

					foreach ($this->data['Tarifa']['rangoUnidad']['desde'] as $i => $desde) {
						if(!empty($desde) && !empty($this->data['Tarifa']['rangoUnidad']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoUnidad']['descuento'][$i])){
							$DescuentoNuevo['Descuento']['unidad_inicial']    = $desde;
							$DescuentoNuevo['Descuento']['unidad_final']      = $this->data['Tarifa']['rangoUnidad']['hasta'][$i];
							$DescuentoNuevo['Descuento']['unidad_porcentaje'] = $this->data['Tarifa']['rangoUnidad']['descuento'][$i];
							$this->Tarifa->importModel('Descuento')->create();
							$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
							if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
								$DescuentoNuevo2                         = $DescuentoNuevo;
								$DescuentoNuevo2['Descuento']['origen']  = $value['Destino']['id'];
								$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
								$this->Tarifa->importModel('Descuento')->create();
								$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
							}
						}
					}
					$DescuentoNuevo['Descuento']['unidad_inicial']    = null;
					$DescuentoNuevo['Descuento']['unidad_final']      = null;
					$DescuentoNuevo['Descuento']['unidad_porcentaje'] = null;
					foreach ($this->data['Tarifa']['rangoKilo']['desde'] as $i => $desde) {
						if(!empty($desde) && !empty($this->data['Tarifa']['rangoKilo']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoKilo']['descuento'][$i])){
							$DescuentoNuevo['Descuento']['kilo_inicial']    = $desde;
							$DescuentoNuevo['Descuento']['kilo_final']      = $this->data['Tarifa']['rangoKilo']['hasta'][$i];
							$DescuentoNuevo['Descuento']['kilo_porcentaje'] = $this->data['Tarifa']['rangoKilo']['descuento'][$i];
							$this->Tarifa->importModel('Descuento')->create();
							$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
							if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
								$DescuentoNuevo2                         = $DescuentoNuevo;
								$DescuentoNuevo2['Descuento']['origen']  = $value['Destino']['id'];
								$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
								$this->Tarifa->importModel('Descuento')->create();
								$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
							}
						}
					}


					if(!empty($this->data['Tarifa']['valor_sobre']) && !empty($this->data['Tarifa']['max_sobre'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 1;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_sobre'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_sobre'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
						$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
						$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
					if(!empty($this->data['Tarifa']['valor_paquete']) && !empty($this->data['Tarifa']['max_paquete'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 2;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_paquete'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_paquete'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
						$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
						$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
					if(!empty($this->data['Tarifa']['valor_caja']) && !empty($this->data['Tarifa']['max_caja'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 3;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_caja'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_caja'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
						$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
						$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
					if(!empty($this->data['Tarifa']['valor_devol']) && !empty($this->data['Tarifa']['max_devol'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 4;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_devol'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_devol'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
						$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
						$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
					if(!empty($this->data['Tarifa']['valor_otros']) && !empty($this->data['Tarifa']['max_otros'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 5;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_otros'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_otros'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
						$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
						$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
					if(!empty($otrosEmpaquesLlenos)){
						foreach ($otrosEmpaquesLlenos['empaque_id'] as $i => $j) {
							$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
							$TarifaNuevo['Tarifa']['empaque_id'] = $otrosEmpaquesLlenos['empaque_id'][$i];
							$TarifaNuevo['Tarifa']['tarifa']     = $otrosEmpaquesLlenos['tarifa'][$i];
							$TarifaNuevo['Tarifa']['max_kilo']   = $otrosEmpaquesLlenos['max_kilo'][$i];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
							$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
							$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
						}
					}
				}
			}

			if($this->data['Tarifa']['tarifa'] == "Destino"){
				$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino_id'];

				$DescuentoNuevo['Descuento']['destino'] = $this->data['Tarifa']['destino_id'];
				$DescuentoNuevo['Descuento']['kilo_inicial']    = null;
				$DescuentoNuevo['Descuento']['kilo_final']      = null;
				$DescuentoNuevo['Descuento']['kilo_porcentaje'] = null;
				$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['origen'],'Descuento.destino' => $DescuentoNuevo['Descuento']['destino']), false);
				$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['destino'],'Descuento.destino' => $DescuentoNuevo['Descuento']['origen']), false);
				
				foreach ($this->data['Tarifa']['rangoUnidad']['desde'] as $i => $desde) {
					if(!empty($desde) && !empty($this->data['Tarifa']['rangoUnidad']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoUnidad']['descuento'][$i])){
						$DescuentoNuevo['Descuento']['unidad_inicial']    = $desde;
						$DescuentoNuevo['Descuento']['unidad_final']      = $this->data['Tarifa']['rangoUnidad']['hasta'][$i];
						$DescuentoNuevo['Descuento']['unidad_porcentaje'] = $this->data['Tarifa']['rangoUnidad']['descuento'][$i];
						$this->Tarifa->importModel('Descuento')->create();
						$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
						if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
							$DescuentoNuevo2                         = $DescuentoNuevo;
							$DescuentoNuevo2['Descuento']['origen']  = $this->data['Tarifa']['destino_id'];
							$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->importModel('Descuento')->create();
							$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
						}
					}
				}
				$DescuentoNuevo['Descuento']['unidad_inicial']    = null;
				$DescuentoNuevo['Descuento']['unidad_final']      = null;
				$DescuentoNuevo['Descuento']['unidad_porcentaje'] = null;
				foreach ($this->data['Tarifa']['rangoKilo']['desde'] as $i => $desde) {
					if(!empty($desde) && !empty($this->data['Tarifa']['rangoKilo']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoKilo']['descuento'][$i])){
						$DescuentoNuevo['Descuento']['kilo_inicial']    = $desde;
						$DescuentoNuevo['Descuento']['kilo_final']      = $this->data['Tarifa']['rangoKilo']['hasta'][$i];
						$DescuentoNuevo['Descuento']['kilo_porcentaje'] = $this->data['Tarifa']['rangoKilo']['descuento'][$i];
						$this->Tarifa->importModel('Descuento')->create();
						$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
						if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
							$DescuentoNuevo2                         = $DescuentoNuevo;
							$DescuentoNuevo2['Descuento']['origen']  = $this->data['Tarifa']['destino_id'];
							$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->importModel('Descuento')->create();
							$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
						}
					}
				}

				if(!empty($this->data['Tarifa']['valor_sobre']) && !empty($this->data['Tarifa']['max_sobre'])){
					$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
					$TarifaNuevo['Tarifa']['empaque_id'] = 1;
					$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_sobre'];
					$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_sobre'];
					$this->Tarifa->create();
					$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
				}
				$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino_id'];				
				if(!empty($this->data['Tarifa']['valor_paquete']) && !empty($this->data['Tarifa']['max_paquete'])){
					$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
					$TarifaNuevo['Tarifa']['empaque_id'] = 2;
					$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_paquete'];
					$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_paquete'];
					$this->Tarifa->create();
					$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
				}
				$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino_id'];
				if(!empty($this->data['Tarifa']['valor_caja']) && !empty($this->data['Tarifa']['max_caja'])){
					$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
					$TarifaNuevo['Tarifa']['empaque_id'] = 3;
					$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_caja'];
					$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_caja'];
					$this->Tarifa->create();
					$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
				}
				$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino_id'];
				if(!empty($this->data['Tarifa']['valor_devol']) && !empty($this->data['Tarifa']['max_devol'])){
					$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
					$TarifaNuevo['Tarifa']['empaque_id'] = 4;
					$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_devol'];
					$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_devol'];
					$this->Tarifa->create();
					$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
				}
				$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino_id'];
				if(!empty($this->data['Tarifa']['valor_otros']) && !empty($this->data['Tarifa']['max_otros'])){
					$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
					$TarifaNuevo['Tarifa']['empaque_id'] = 5;
					$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_otros'];
					$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_otros'];
					$this->Tarifa->create();
					$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
				}
				$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino_id'];
				if(!empty($otrosEmpaquesLlenos)){
					foreach ($otrosEmpaquesLlenos['empaque_id'] as $i => $j) {
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = $otrosEmpaquesLlenos['empaque_id'][$i];
						$TarifaNuevo['Tarifa']['tarifa']     = $otrosEmpaquesLlenos['tarifa'][$i];
						$TarifaNuevo['Tarifa']['max_kilo']   = $otrosEmpaquesLlenos['max_kilo'][$i];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
					}
				}
			}
			$this->Session->setFlash('','ok',array('mensaje'=>'La Tarifa se guardo con éxito'));				
		
		}
		$this->data = null;
		
		
		//$tarifas      = $this->Tarifa->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.cliente_id'=>1)));
		$destinos     = $this->Tarifa->importModel('Destino')->find('all',array('recursive'=> 0));
		$regiones     = $this->Tarifa->importModel('Region')->find('list');
		$destinosList = $this->Tarifa->importModel('Destino')->find('list',array('recursive'=> 0));

		foreach ($destinos as $key=>$value){
			$destinosInfo[$key]['Destino']['regionId']           = $value['Region']['id'];
			$destinosInfo[$key]['Destino']['regionCodigo']       = $value['Region']['codigo'];
			$destinosInfo[$key]['Destino']['regionNombre']       = $value['Region']['nombre'];
			$destinosInfo[$key]['Destino']['codigo']             = $value['Destino']['codigo'];
			$destinosInfo[$key]['Destino']['nombre']             = $value['Destino']['nombre'];
			$destinosInfo[$key]['Destino']['id']                 = $value['Destino']['id'];
		}
		$this->generateJSON('destinos_Tarifas', $destinosInfo, array('Destino' => array('id','regionId','regionCodigo','regionNombre','codigo','nombre')));

		$this->set(compact('destinosInfo','destinosList','regiones'));

	}
	public function conveniosDescuentos() {
		if(!empty($this->data)){
			$this->request->data['Tarifa'] = $this->data['Convenio'];
			$this->Session->setFlash('','ok',array('mensaje'=>'La tarifa fue guardada con éxito'));

			if(empty($this->data['Tarifa']['cliente_id'])){
				$this->Session->setFlash('','error',array('mensaje'=>'El cliente no existe.'));
			} else {
				$DescuentoNuevo['Descuento']['cliente_id']    = $this->data['Tarifa']['cliente_id'];
				$DescuentoNuevo['Descuento']['origen']        = $this->data['Tarifa']['destino3'];

				if($this->data['Tarifa']['tarifa'] == "TodasRegiones"){
					$destinosRegion = $this->Tarifa->importModel('Destino')->find('all',array('recursive'=> -1,'fields'=>'Destino.id','conditions'=>array('Destino.region_id !='=>0)));
					foreach ($destinosRegion as $key => $value) {					
						$DescuentoNuevo['Descuento']['destino']         = $value['Destino']['id'];
						$DescuentoNuevo['Descuento']['kilo_inicial']    = null;
						$DescuentoNuevo['Descuento']['kilo_final']      = null;
						$DescuentoNuevo['Descuento']['kilo_porcentaje'] = null;
						$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['origen'],'Descuento.destino' => $DescuentoNuevo['Descuento']['destino']), false);
						$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['destino'],'Descuento.destino' => $DescuentoNuevo['Descuento']['origen']), false);
						foreach ($this->data['Tarifa']['rangoUnidad']['desde'] as $i => $desde) {
							if(!empty($desde) && !empty($this->data['Tarifa']['rangoUnidad']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoUnidad']['descuento'][$i])){
								$DescuentoNuevo['Descuento']['unidad_inicial']    = $desde;
								$DescuentoNuevo['Descuento']['unidad_final']      = $this->data['Tarifa']['rangoUnidad']['hasta'][$i];
								$DescuentoNuevo['Descuento']['unidad_porcentaje'] = $this->data['Tarifa']['rangoUnidad']['descuento'][$i];
								$this->Tarifa->importModel('Descuento')->create();
								$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
								if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
									$DescuentoNuevo2                         = $DescuentoNuevo;
									$DescuentoNuevo2['Descuento']['origen']  = $value['Destino']['id'];
									$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
									$this->Tarifa->importModel('Descuento')->create();
									$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
								}
							}
						}
						$DescuentoNuevo['Descuento']['unidad_inicial']    = null;
						$DescuentoNuevo['Descuento']['unidad_final']      = null;
						$DescuentoNuevo['Descuento']['unidad_porcentaje'] = null;
						foreach ($this->data['Tarifa']['rangoKilo']['desde'] as $i => $desde) {
							if(!empty($desde) && !empty($this->data['Tarifa']['rangoKilo']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoKilo']['descuento'][$i])){
								$DescuentoNuevo['Descuento']['kilo_inicial']    = $desde;
								$DescuentoNuevo['Descuento']['kilo_final']      = $this->data['Tarifa']['rangoKilo']['hasta'][$i];
								$DescuentoNuevo['Descuento']['kilo_porcentaje'] = $this->data['Tarifa']['rangoKilo']['descuento'][$i];
								$this->Tarifa->importModel('Descuento')->create();
								$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
								if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
									$DescuentoNuevo2                         = $DescuentoNuevo;
									$DescuentoNuevo2['Descuento']['origen']  = $value['Destino']['id'];
									$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
									$this->Tarifa->importModel('Descuento')->create();
									$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
								}
							}
						}
					}
				}

				if($this->data['Tarifa']['tarifa'] == "Region"){
					$destinosRegion = $this->Tarifa->importModel('Destino')->find('all',array('recursive'=> -1,'fields'=>'Destino.id','conditions'=>array('Destino.region_id'=>$this->data['Tarifa']['region'])));
					foreach ($destinosRegion as $key => $value) {					
						$DescuentoNuevo['Descuento']['destino'] = $value['Destino']['id'];
						$DescuentoNuevo['Descuento']['kilo_inicial'] = null;
						$DescuentoNuevo['Descuento']['kilo_final'] = null;
						$DescuentoNuevo['Descuento']['kilo_porcentaje'] = null;
						$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['origen'],'Descuento.destino' => $DescuentoNuevo['Descuento']['destino']), false);
						$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['destino'],'Descuento.destino' => $DescuentoNuevo['Descuento']['origen']), false);
						
						foreach ($this->data['Tarifa']['rangoUnidad']['desde'] as $i => $desde) {
							if(!empty($desde) && !empty($this->data['Tarifa']['rangoUnidad']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoUnidad']['descuento'][$i])){
								$DescuentoNuevo['Descuento']['unidad_inicial']    = $desde;
								$DescuentoNuevo['Descuento']['unidad_final']      = $this->data['Tarifa']['rangoUnidad']['hasta'][$i];
								$DescuentoNuevo['Descuento']['unidad_porcentaje'] = $this->data['Tarifa']['rangoUnidad']['descuento'][$i];
								$this->Tarifa->importModel('Descuento')->create();
								$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
								if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
									$DescuentoNuevo2                         = $DescuentoNuevo;
									$DescuentoNuevo2['Descuento']['origen']  = $value['Destino']['id'];
									$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
									$this->Tarifa->importModel('Descuento')->create();
									$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
								}
							}
						}
						$DescuentoNuevo['Descuento']['unidad_inicial']    = null;
						$DescuentoNuevo['Descuento']['unidad_final']      = null;
						$DescuentoNuevo['Descuento']['unidad_porcentaje'] = null;
						foreach ($this->data['Tarifa']['rangoKilo']['desde'] as $i => $desde) {
							if(!empty($desde) && !empty($this->data['Tarifa']['rangoKilo']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoKilo']['descuento'][$i])){
								$DescuentoNuevo['Descuento']['kilo_inicial']    = $desde;
								$DescuentoNuevo['Descuento']['kilo_final']      = $this->data['Tarifa']['rangoKilo']['hasta'][$i];
								$DescuentoNuevo['Descuento']['kilo_porcentaje'] = $this->data['Tarifa']['rangoKilo']['descuento'][$i];
								$this->Tarifa->importModel('Descuento')->create();
								$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
								if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
									$DescuentoNuevo2                         = $DescuentoNuevo;
									$DescuentoNuevo2['Descuento']['origen']  = $value['Destino']['id'];
									$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
									$this->Tarifa->importModel('Descuento')->create();
									$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
								}
							}
						}
					}
				}

				if($this->data['Tarifa']['tarifa'] == "Destino"){
					$DescuentoNuevo['Descuento']['destino'] = $this->data['Tarifa']['destino_id'];
					$DescuentoNuevo['Descuento']['kilo_inicial']    = null;
					$DescuentoNuevo['Descuento']['kilo_final']      = null;
					$DescuentoNuevo['Descuento']['kilo_porcentaje'] = null;
					$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['origen'],'Descuento.destino' => $DescuentoNuevo['Descuento']['destino']), false);
					$this->Tarifa->importModel('Descuento')->deleteAll(array('Descuento.cliente_id' => $this->data['Tarifa']['cliente_id'],'Descuento.origen' => $DescuentoNuevo['Descuento']['destino'],'Descuento.destino' => $DescuentoNuevo['Descuento']['origen']), false);
					foreach ($this->data['Tarifa']['rangoUnidad']['desde'] as $i => $desde) {
						if(!empty($desde) && !empty($this->data['Tarifa']['rangoUnidad']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoUnidad']['descuento'][$i])){
							$DescuentoNuevo['Descuento']['unidad_inicial']    = $desde;
							$DescuentoNuevo['Descuento']['unidad_final']      = $this->data['Tarifa']['rangoUnidad']['hasta'][$i];
							$DescuentoNuevo['Descuento']['unidad_porcentaje'] = $this->data['Tarifa']['rangoUnidad']['descuento'][$i];
							$this->Tarifa->importModel('Descuento')->create();
							$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
							if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
								$DescuentoNuevo2                         = $DescuentoNuevo;
								$DescuentoNuevo2['Descuento']['origen']  = $this->data['Tarifa']['destino_id'];
								$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
								$this->Tarifa->importModel('Descuento')->create();
								$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
							}
						}
					}
					$DescuentoNuevo['Descuento']['unidad_inicial']    = null;
					$DescuentoNuevo['Descuento']['unidad_final']      = null;
					$DescuentoNuevo['Descuento']['unidad_porcentaje'] = null;
					foreach ($this->data['Tarifa']['rangoKilo']['desde'] as $i => $desde) {
						if(!empty($desde) && !empty($this->data['Tarifa']['rangoKilo']['hasta'][$i]) && !empty($this->data['Tarifa']['rangoKilo']['descuento'][$i])){
							$DescuentoNuevo['Descuento']['kilo_inicial']    = $desde;
							$DescuentoNuevo['Descuento']['kilo_final']      = $this->data['Tarifa']['rangoKilo']['hasta'][$i];
							$DescuentoNuevo['Descuento']['kilo_porcentaje'] = $this->data['Tarifa']['rangoKilo']['descuento'][$i];
							$this->Tarifa->importModel('Descuento')->create();
							$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo);
							if($DescuentoNuevo['Descuento']['destino'] != $DescuentoNuevo['Descuento']['origen']){
								$DescuentoNuevo2                         = $DescuentoNuevo;
								$DescuentoNuevo2['Descuento']['origen']  = $this->data['Tarifa']['destino_id'];
								$DescuentoNuevo2['Descuento']['destino'] = $this->data['Tarifa']['destino3'];
								$this->Tarifa->importModel('Descuento')->create();
								$this->Tarifa->importModel('Descuento')->save($DescuentoNuevo2);
							}
						}
					}
				}
    			$this->Session->setFlash('','ok',array('mensaje'=>'La Tarifa se guardo con éxito'));				
			}
		}
		$this->data   = null;

		$clientes     = $this->Tarifa->Cliente->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1,'Cliente.tipo'=>"Clientes")));
		$destinos     = $this->Tarifa->importModel('Destino')->find('all',array('recursive'=> 0));
		$regiones     = $this->Tarifa->importModel('Region')->find('list');
		$destinosList = $this->Tarifa->importModel('Destino')->find('list',array('recursive'=> 0));
		
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

		$this->generateJSON('clientes_Tarifas', $clientes, array('Cliente' => array('id','id','documento','listNombre','telefono','telefono2','direccion','celular')), 1);
		$this->generateJSON('destinos_Tarifas', $destinosInfo, array('Destino' => array('id','regionId','departamentoCodigo','departamentoNombre','regionCodigo','regionNombre','codigo','nombre')));

		$this->set(compact('clientes','destinosInfo','destinosList','regiones'));

	}
	public function convenios() {
		if(!empty($this->data)){
			$this->request->data['Convenio']['valor_sobre']   = str_replace(",","",$this->data['Convenio']['valor_sobre']);
			$this->request->data['Convenio']['valor_paquete'] = str_replace(",","",$this->data['Convenio']['valor_paquete']);
			$this->request->data['Convenio']['valor_caja']    = str_replace(",","",$this->data['Convenio']['valor_caja']);
			$this->request->data['Convenio']['valor_devol']   = str_replace(",","",$this->data['Convenio']['valor_devol']);
			$this->request->data['Convenio']['valor_otros']   = str_replace(",","",$this->data['Convenio']['valor_otros']);
			$this->request->data['Convenio']['declarado']     = str_replace(",","",$this->data['Convenio']['declarado']);
			$this->request->data['Tarifa'] = $this->data['Convenio'];
			$this->Session->setFlash('','ok',array('mensaje'=>'La tarifa fue guardada con éxito'));

			if(empty($this->data['Tarifa']['cliente_id'])){
				$this->Session->setFlash('','error',array('mensaje'=>'El cliente no existe.'));
			} else {
				$otrosEmpaques       = json_decode($this->data['Tarifa']['otros_empaques'],true);
				$otrosEmpaquesLlenos = array();
				if(!empty($otrosEmpaques)){
					foreach ($otrosEmpaques['datos'] as $key => $value) {
						if(!empty($value['empaque_id']) && !empty($value['tarifa']) && !empty($value['max_kilo'])){
							$otrosEmpaquesLlenos['empaque_id'][] = $value['empaque_id'];
							$otrosEmpaquesLlenos['tarifa'][]     = $value['tarifa'];
							$otrosEmpaquesLlenos['max_kilo'][]   = $value['max_kilo'];
							if($value['largo'] != "" && $value['ancho'] != "" && $value['alto'] != "" && $value['peso'] != ""){
								$otrosEmpaquesLlenos['largo'][] = $value['largo'];
								$otrosEmpaquesLlenos['ancho'][] = $value['ancho'];
								$otrosEmpaquesLlenos['alto'][]  = $value['alto'];
								$otrosEmpaquesLlenos['peso'][]  = $value['peso'];
							} else {
								$otrosEmpaquesLlenos['largo'][] = 0;
								$otrosEmpaquesLlenos['ancho'][] = 0;
								$otrosEmpaquesLlenos['alto'][]  = 0;
								$otrosEmpaquesLlenos['peso'][]  = 0;
							}
						}
					}
				}
				$TarifaNuevo['Tarifa']['cliente_id']       = $this->data['Tarifa']['cliente_id'];
				$TarifaNuevo['Tarifa']['valor_adicional']  = $this->data['Tarifa']['valor_adicional'];
				$TarifaNuevo['Tarifa']['declarado']        = $this->data['Tarifa']['declarado'];
				$TarifaNuevo['Tarifa']['porcen_declarado'] = $this->data['Tarifa']['porcen_declarado'];

				if($this->data['Tarifa']['tarifa'] == "TodasRegiones"){
					$destinosRegion = $this->Tarifa->importModel('Destino')->find('all',array('recursive'=> -1,'fields'=>'Destino.id','conditions'=>array('Destino.region_id !='=>0)));
					foreach ($destinosRegion as $key => $value) {					
						$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];

						if(!empty($this->data['Tarifa']['valor_sobre']) && !empty($this->data['Tarifa']['max_sobre'])){
							$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
							$TarifaNuevo['Tarifa']['empaque_id'] = 1;
							$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_sobre'];
							$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_sobre'];
							$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_sobre'];
							$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_sobre'];
							$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_sobre'];
							$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_sobre'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
							$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
							$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
						}
						$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
						if(!empty($this->data['Tarifa']['valor_paquete']) && !empty($this->data['Tarifa']['max_paquete'])){
							$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
							$TarifaNuevo['Tarifa']['empaque_id'] = 2;
							$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_paquete'];
							$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_paquete'];
							$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_paquete'];
							$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_paquete'];
							$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_paquete'];
							$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_paquete'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
							$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
							$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
						}
						$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
						if(!empty($this->data['Tarifa']['valor_caja']) && !empty($this->data['Tarifa']['max_caja'])){
							$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
							$TarifaNuevo['Tarifa']['empaque_id'] = 3;
							$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_caja'];
							$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_caja'];
							$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_caja'];
							$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_caja'];
							$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_caja'];
							$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_caja'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
							$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
							$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
						}
						$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
						if(!empty($this->data['Tarifa']['valor_devol']) && !empty($this->data['Tarifa']['max_devol'])){
							$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
							$TarifaNuevo['Tarifa']['empaque_id'] = 4;
							$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_devol'];
							$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_devol'];
							$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_devol'];
							$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_devol'];
							$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_devol'];
							$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_devol'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
							$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
							$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
						}
						$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
						if(!empty($this->data['Tarifa']['valor_otros']) && !empty($this->data['Tarifa']['max_otros'])){
							$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
							$TarifaNuevo['Tarifa']['empaque_id'] = 5;
							$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_otros'];
							$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_otros'];
							$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_otros'];
							$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_otros'];
							$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_otros'];
							$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_otros'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
							$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
							$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
						}
						$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
						if(!empty($otrosEmpaques)){
							foreach ($otrosEmpaquesLlenos['empaque_id'] as $i => $j) {
								$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
								$TarifaNuevo['Tarifa']['empaque_id'] = $otrosEmpaquesLlenos['empaque_id'][$i];
								$TarifaNuevo['Tarifa']['tarifa']     = $otrosEmpaquesLlenos['tarifa'][$i];
								$TarifaNuevo['Tarifa']['max_kilo']   = $otrosEmpaquesLlenos['max_kilo'][$i];
								$TarifaNuevo['Tarifa']['largo']      = $otrosEmpaquesLlenos['largo'][$i];
								$TarifaNuevo['Tarifa']['ancho']      = $otrosEmpaquesLlenos['ancho'][$i];
								$TarifaNuevo['Tarifa']['alto']       = $otrosEmpaquesLlenos['alto'][$i];
								$TarifaNuevo['Tarifa']['peso']       = $otrosEmpaquesLlenos['peso'][$i];
								$this->Tarifa->create();
								$this->Tarifa->checkTarifa($TarifaNuevo);
								$this->Tarifa->save($TarifaNuevo);
								$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
								$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
								$this->Tarifa->create();
								$this->Tarifa->checkTarifa($TarifaNuevo);
								$this->Tarifa->save($TarifaNuevo);
							}
						}
					}
				}

				if($this->data['Tarifa']['tarifa'] == "Region"){
					$destinosRegion = $this->Tarifa->importModel('Destino')->find('all',array('recursive'=> -1,'fields'=>'Destino.id','conditions'=>array('Destino.region_id'=>$this->data['Tarifa']['region'])));
					foreach ($destinosRegion as $key => $value) {					
						$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];

						if(!empty($this->data['Tarifa']['valor_sobre']) && !empty($this->data['Tarifa']['max_sobre'])){
							$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
							$TarifaNuevo['Tarifa']['empaque_id'] = 1;
							$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_sobre'];
							$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_sobre'];
							$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_sobre'];
							$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_sobre'];
							$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_sobre'];
							$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_sobre'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
							$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
							$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
						}
						$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
						if(!empty($this->data['Tarifa']['valor_paquete']) && !empty($this->data['Tarifa']['max_paquete'])){
							$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
							$TarifaNuevo['Tarifa']['empaque_id'] = 2;
							$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_paquete'];
							$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_paquete'];
							$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_paquete'];
							$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_paquete'];
							$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_paquete'];
							$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_paquete'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
							$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
							$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
						}
						$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
						if(!empty($this->data['Tarifa']['valor_caja']) && !empty($this->data['Tarifa']['max_caja'])){
							$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
							$TarifaNuevo['Tarifa']['empaque_id'] = 3;
							$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_caja'];
							$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_caja'];
							$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_caja'];
							$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_caja'];
							$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_caja'];
							$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_caja'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
							$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
							$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
						}
						$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
						if(!empty($this->data['Tarifa']['valor_devol']) && !empty($this->data['Tarifa']['max_devol'])){
							$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
							$TarifaNuevo['Tarifa']['empaque_id'] = 4;
							$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_devol'];
							$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_devol'];
							$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_devol'];
							$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_devol'];
							$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_devol'];
							$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_devol'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
							$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
							$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
						}
						$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
						if(!empty($this->data['Tarifa']['valor_otros']) && !empty($this->data['Tarifa']['max_otros'])){
							$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
							$TarifaNuevo['Tarifa']['empaque_id'] = 5;
							$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_otros'];
							$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_otros'];
							$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_otros'];
							$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_otros'];
							$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_otros'];
							$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_otros'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
							$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
							$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
						}
						$TarifaNuevo['Tarifa']['destino'] = $value['Destino']['id'];
						if(!empty($otrosEmpaquesLlenos)){
							foreach ($otrosEmpaquesLlenos['empaque_id'] as $i => $j) {
								$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
								$TarifaNuevo['Tarifa']['empaque_id'] = $otrosEmpaquesLlenos['empaque_id'][$i];
								$TarifaNuevo['Tarifa']['tarifa']     = $otrosEmpaquesLlenos['tarifa'][$i];
								$TarifaNuevo['Tarifa']['max_kilo']   = $otrosEmpaquesLlenos['max_kilo'][$i];
								$TarifaNuevo['Tarifa']['largo']      = $otrosEmpaquesLlenos['largo'][$i];
								$TarifaNuevo['Tarifa']['ancho']      = $otrosEmpaquesLlenos['ancho'][$i];
								$TarifaNuevo['Tarifa']['alto']       = $otrosEmpaquesLlenos['alto'][$i];
								$TarifaNuevo['Tarifa']['peso']       = $otrosEmpaquesLlenos['peso'][$i];
								$this->Tarifa->create();
								$this->Tarifa->checkTarifa($TarifaNuevo);
								$this->Tarifa->save($TarifaNuevo);
								$TarifaNuevo['Tarifa']['origen']  = $TarifaNuevo['Tarifa']['destino'];
								$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino3'];
								$this->Tarifa->create();
								$this->Tarifa->checkTarifa($TarifaNuevo);
								$this->Tarifa->save($TarifaNuevo);
							}
						}
					}
				}

				if($this->data['Tarifa']['tarifa'] == "Destino"){
					$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino_id'];

					if(!empty($this->data['Tarifa']['valor_sobre']) && !empty($this->data['Tarifa']['max_sobre'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 1;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_sobre'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_sobre'];
						$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_sobre'];
						$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_sobre'];
						$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_sobre'];
						$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_sobre'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino_id'];				
					if(!empty($this->data['Tarifa']['valor_paquete']) && !empty($this->data['Tarifa']['max_paquete'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 2;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_paquete'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_paquete'];
						$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_paquete'];
						$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_paquete'];
						$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_paquete'];
						$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_paquete'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino_id'];
					if(!empty($this->data['Tarifa']['valor_caja']) && !empty($this->data['Tarifa']['max_caja'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 3;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_caja'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_caja'];
						$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_caja'];
						$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_caja'];
						$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_caja'];
						$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_caja'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino_id'];
					if(!empty($this->data['Tarifa']['valor_devol']) && !empty($this->data['Tarifa']['max_devol'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 4;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_devol'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_devol'];
						$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_devol'];
						$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_devol'];
						$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_devol'];
						$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_devol'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
						$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino_id'];
					if(!empty($this->data['Tarifa']['valor_otros']) && !empty($this->data['Tarifa']['max_otros'])){
						$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
						$TarifaNuevo['Tarifa']['empaque_id'] = 5;
						$TarifaNuevo['Tarifa']['tarifa']     = $this->data['Tarifa']['valor_otros'];
						$TarifaNuevo['Tarifa']['max_kilo']   = $this->data['Tarifa']['max_otros'];
						$TarifaNuevo['Tarifa']['largo']      = $this->data['Tarifa']['largo_otros'];
						$TarifaNuevo['Tarifa']['ancho']      = $this->data['Tarifa']['ancho_otros'];
						$TarifaNuevo['Tarifa']['alto']       = $this->data['Tarifa']['alto_otros'];
						$TarifaNuevo['Tarifa']['peso']       = $this->data['Tarifa']['peso_otros'];
						$this->Tarifa->create();
						$this->Tarifa->checkTarifa($TarifaNuevo);
							$this->Tarifa->save($TarifaNuevo);
					}
					$TarifaNuevo['Tarifa']['destino'] = $this->data['Tarifa']['destino_id'];
					if(!empty($otrosEmpaquesLlenos)){
						foreach ($otrosEmpaquesLlenos['empaque_id'] as $i => $j) {
							$TarifaNuevo['Tarifa']['origen']     = $this->data['Tarifa']['destino3'];
							$TarifaNuevo['Tarifa']['empaque_id'] = $otrosEmpaquesLlenos['empaque_id'][$i];
							$TarifaNuevo['Tarifa']['tarifa']     = $otrosEmpaquesLlenos['tarifa'][$i];
							$TarifaNuevo['Tarifa']['max_kilo']   = $otrosEmpaquesLlenos['max_kilo'][$i];
							$TarifaNuevo['Tarifa']['largo']      = $otrosEmpaquesLlenos['largo'][$i];
							$TarifaNuevo['Tarifa']['ancho']      = $otrosEmpaquesLlenos['ancho'][$i];
							$TarifaNuevo['Tarifa']['alto']       = $otrosEmpaquesLlenos['alto'][$i];
							$TarifaNuevo['Tarifa']['peso']       = $otrosEmpaquesLlenos['peso'][$i];
							$this->Tarifa->create();
							$this->Tarifa->checkTarifa($TarifaNuevo);
								$this->Tarifa->save($TarifaNuevo);
						}
					}
				}
    			$this->Session->setFlash('','ok',array('mensaje'=>'La Tarifa se guardo con éxito'));				
			}
		}
		$this->data   = null;


		$clientes     = $this->Tarifa->Cliente->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$destinos     = $this->Tarifa->importModel('Destino')->find('all',array('recursive'=> 0));
		$regiones     = $this->Tarifa->importModel('Region')->find('list');
		$destinosList = $this->Tarifa->importModel('Destino')->find('list',array('recursive'=> 0));
		
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

		$this->generateJSON('clientes_Tarifas', $clientes, array('Cliente' => array('id','id','documento','listNombre','telefono','telefono2','direccion','celular')), 1);
		$this->generateJSON('destinos_Tarifas', $destinosInfo, array('Destino' => array('id','regionId','departamentoCodigo','departamentoNombre','regionCodigo','regionNombre','codigo','nombre')));

		$this->set(compact('clientes','destinosInfo','destinosList','regiones'));

	}
	public function otros() {
		//$ruta = $this->params['controller'].'/'.$this->params['action'];
		$empaques = $this->Tarifa->importModel('Empaque')->find('list',array('conditions'=>array('Empaque.id >'=>5)));
		$this->layout = 'empty';
		$this->set(compact('empaques'));
	}
	public function otrosConv() {
		//$ruta = $this->params['controller'].'/'.$this->params['action'];
		$empaques = $this->Tarifa->importModel('Empaque')->find('list',array('conditions'=>array('Empaque.id >'=>5)));
		$this->layout = 'empty';
		$this->set(compact('empaques'));
	}
	public function excel($clienteId = null, $preview = null) {
		if(!empty($clienteId)){
			Configure::write('debug', 0);
			$Tarifas = $this->Tarifa->find('all',array('order' => array('Tarifa.origen', 'Tarifa.destino DESC'),'fields'=>array('Cliente.nombres','Cliente.apellidos','Cliente.documento','Cliente.telefono','Cliente.direccion','Cliente.email','Empaque.nombre','Tarifa.cliente_id','Tarifa.tarifa','Tarifa.tarifa','Tarifa.max_kilo','Tarifa.origen','Tarifa.destino','Tarifa.empaque_id','Tarifa.valor_adicional'),'conditions'=>array('Tarifa.cliente_id'=>$clienteId)));
			$destinos = $this->Tarifa->importModel('Destino')->find('list');
			$empaques = $this->Tarifa->Empaque->find('list');

			$tar = array();
			foreach ($Tarifas as $key => $value) {
				$tar[$destinos[$value['Tarifa']['origen']]][$destinos[$value['Tarifa']['destino']]] [$empaques[$value['Tarifa']['empaque_id']]] ['Tarifa'] = $value['Tarifa']['tarifa'];
				$tar[$destinos[$value['Tarifa']['origen']]][$destinos[$value['Tarifa']['destino']]] [$empaques[$value['Tarifa']['empaque_id']]] ['Max']    = $value['Tarifa']['max_kilo'];
				$tar[$destinos[$value['Tarifa']['origen']]][$destinos[$value['Tarifa']['destino']]] ['Adicion'] = $value['Tarifa']['valor_adicional'];
				$emp[] = $empaques[$value['Tarifa']['empaque_id']];
			}
			$emp = array_unique($emp);
			sort($emp);

			$cli['Cliente'] = $Tarifas[0]['Cliente'];

			$this->ExcelWrite->Tarifas($cli,$tar,$emp,$preview);
		} else {
			$this->Session->setFlash('','error',array('mensaje'=>'No se ha seleccionado un cliente.'));
    		$this->redirect(array('action' => 'crear'));
		}
	}

	public function excel2($clienteId = null, $preview = null) {
		if(!empty($clienteId)){
			Configure::write('debug', 0);
			$Tarifas = $this->Tarifa->find('all',array('order' => array('Tarifa.origen', 'Tarifa.destino DESC'),'fields'=>array('Cliente.nombres','Cliente.apellidos','Cliente.documento','Cliente.telefono','Cliente.direccion','Cliente.email','Empaque.nombre','Tarifa.cliente_id','Tarifa.tarifa','Tarifa.tarifa','Tarifa.max_kilo','Tarifa.origen','Tarifa.destino','Tarifa.empaque_id','Tarifa.valor_adicional'),'conditions'=>array('Tarifa.cliente_id'=>$clienteId)));
			$destinos = $this->Tarifa->importModel('Destino')->find('list');
			$empaques = $this->Tarifa->Empaque->find('list');

			$tar = array();
			foreach ($Tarifas as $key => $value) {
				$tar[$destinos[$value['Tarifa']['origen']]][$destinos[$value['Tarifa']['destino']]] [$empaques[$value['Tarifa']['empaque_id']]] ['Tarifa'] = $value['Tarifa']['tarifa'];
				$tar[$destinos[$value['Tarifa']['origen']]][$destinos[$value['Tarifa']['destino']]] [$empaques[$value['Tarifa']['empaque_id']]] ['Max']    = $value['Tarifa']['max_kilo'];
				$tar[$destinos[$value['Tarifa']['origen']]][$destinos[$value['Tarifa']['destino']]] ['Adicion'] = $value['Tarifa']['valor_adicional'];
				$emp[] = $empaques[$value['Tarifa']['empaque_id']];
			}
			$emp = array_unique($emp);
			sort($emp);

			$cli['Cliente'] = $Tarifas[0]['Cliente'];

			$this->ExcelWrite->Tarifas($cli,$tar,$emp,$preview);
		} else {
			$this->Session->setFlash('','error',array('mensaje'=>'No se ha seleccionado un cliente.'));
    		$this->redirect(array('action' => 'convenios'));
		}
	}

	public function excel2D($clienteId = null, $preview = null) {
		if(!empty($clienteId)){
			Configure::write('debug', 0);
			$descuentos = $this->Tarifa->importModel('Descuento')->find('all',array('order'=>array('Descuento.origen'=>'ASC','Descuento.destino'=>'ASC','Descuento.kilo_inicial'=>'ASC','Descuento.unidad_inicial'=>'ASC'),'recursive'=>-1,'conditions'=>array('Descuento.cliente_id'=>$clienteId)));
			$desc       = array();
			if(count($descuentos) > 0){
				$destinos = $this->Tarifa->importModel('Destino')->find('list');
				$origen   = $destinos[$descuentos[0]['Descuento']['origen']];
				$destino  = $destinos[$descuentos[0]['Descuento']['destino']];
				$desc[$origen][$destino]['Uni'] = $uni;
				foreach ($descuentos as $key => $value) {
					if($destinos[$value['Descuento']['origen']] != $origen || $destinos[$value['Descuento']['destino']] != $destino){
						$uni = array();
						$kil = array();
					}
					$origen  = $destinos[$value['Descuento']['origen']];
					$destino = $destinos[$value['Descuento']['destino']];
					if($value['Descuento']['unidad_inicial'] != ""){
						$uni['Desde'][] = $value['Descuento']['unidad_inicial'];
						$uni['Hasta'][] = $value['Descuento']['unidad_final'];
						$uni['Porce'][] = $value['Descuento']['unidad_porcentaje'];
					} else if($value['Descuento']['kilo_inicial'] != ""){
						$kil['Desde'][] = $value['Descuento']['kilo_inicial'];
						$kil['Hasta'][] = $value['Descuento']['kilo_final'];
						$kil['Porce'][] = $value['Descuento']['kilo_porcentaje'];
					}
					$desc[$origen][$destino]['Uni'] = $uni;
					$desc[$origen][$destino]['Kil'] = $kil;
				}
			}
			$cli = $this->Tarifa->Cliente->find('first',array('recursive'=>-1,'conditions'=>array('Cliente.id'=>$clienteId)));
			$this->ExcelWrite->TarifasD($cli,$desc,$preview);
		} else {
			$this->Session->setFlash('','error',array('mensaje'=>'No se ha seleccionado un cliente.'));
    		$this->redirect(array('action' => 'convenios'));
		}
	}
	public function excelDescargar($cliente = null) {
		$this->excel2($cliente);
	}
	public function excelDescargarD($cliente = null) {
		$this->excel2D($cliente);
	}
	public function excelVer($cliente = null) {
		if (!empty($cliente)) {
			$this->excel2($cliente,"Ver");
		} else {
			$this->layout = 'empty';
		}
	}

	public function excelVerD($cliente = null) {
		if (!empty($cliente)) {
			$this->excel2D($cliente,"Ver");
		} else {
			$this->layout = 'empty';
		}
	}

	public function editarTarifas($clienteId = null) {
		if(!empty($clienteId)){
			Configure::write('debug', 0);
			$Tarifas = $this->Tarifa->find('all',array('order' => array('Tarifa.origen', 'Tarifa.destino DESC'),'fields'=>array('Cliente.nombres','Cliente.apellidos','Cliente.documento','Cliente.telefono','Cliente.direccion','Cliente.email','Empaque.nombre','Tarifa.cliente_id','Tarifa.tarifa','Tarifa.tarifa','Tarifa.max_kilo','Tarifa.origen','Tarifa.destino','Tarifa.empaque_id','Tarifa.valor_adicional'),'conditions'=>array('Tarifa.cliente_id'=>$clienteId)));
			$destinos = $this->Tarifa->importModel('Destino')->find('list');
			$empaques = $this->Tarifa->Empaque->find('list');

			$tar = array();
			foreach ($Tarifas as $key => $value) {
				$tar[$destinos[$value['Tarifa']['origen']]][$destinos[$value['Tarifa']['destino']]] [$empaques[$value['Tarifa']['empaque_id']]] ['Tarifa'] = $value['Tarifa']['tarifa'];
				$emp[] = $empaques[$value['Tarifa']['empaque_id']];
			}
			$emp = array_unique($emp);
			sort($emp);

			$cli['Cliente'] = $Tarifas[0]['Cliente'];
			$html = '<table id="qwer"  cellpadding="0" cellspacing="0" border="0"><thead><tr><th>Origen</th><th>Destino</th>';
			foreach ($emp as $key => $value) {
				$html = $html . '<th>'.$value.'</th>';
			}
			$html = $html . '</tr></thead><tbody>';

			foreach ($tar as $origen => $todo) {
				foreach ($todo as $destino => $valores) {
					$row = $row + 1;
					$html = $html . '<tr><td>'.$origen.'</td><td>'.$destino.'</td>';
					foreach ($valores as $tipo => $valor) {
						foreach ($valor as $key => $value) {
							$html = $html . '<td class="tarifaVal" base="'.round($value).'">'.round($value).'</td>';
						}
					}
					for ($i=count($valores); $i < count($emp); $i++) { 
						$html = $html . '<td></td>';
					}
					$html = $html.'</tr>';
				}
			}
			$html = $html . '</tbody></table>';
		} else {
			$this->Session->setFlash('','error',array('mensaje'=>'No se ha seleccionado un cliente.'));
    		$this->redirect(array('action' => 'tarifas'));
		}
		if(!empty($this->data)){
        	$config = $this->Tarifa->importModel('Configuracion')->find('first');
        	if($this->data['Tarifa']['incrementar'] != ""){
        		$config['Configuracion']['tarifa_incremento'] = $this->data['Tarifa']['incrementar'];
        		$this->Tarifa->updateAll(array('Tarifa.tarifa'=>'Tarifa.tarifa+(Tarifa.tarifa*'.$this->data['Tarifa']['incrementar'].'/100)'),array('Tarifa.destino'=>$this->data['Tarifa']['destino']));
        	} else {
        		$config['Configuracion']['tarifa_decremento'] = $this->data['Tarifa']['disminuir'];
        		$this->Tarifa->updateAll(array('Tarifa.tarifa'=>'Tarifa.tarifa-(Tarifa.tarifa*'.$this->data['Tarifa']['incrementar'].'/100)'),array('Tarifa.destino'=>$this->data['Tarifa']['destino']));
        	}
        	$this->Tarifa->importModel('Configuracion')->save($config);
		}
		$destinos = $this->Tarifa->importModel('Destino')->find('list');
		$regiones = $this->Tarifa->importModel('Region')->find('list');
		$this->set(compact('html','destinos','regiones'));
		$this->layout = 'empty';
	}

	public function incremento($clienteId = null) {
		$config    = $this->Tarifa->importModel('Configuracion')->find('first');
		$descuento = floatval($config['Configuracion']['tarifa_incremento'])/100;
		$this->Tarifa->updateAll(array('Tarifa.tarifa' =>'Tarifa.tarifa/(1+'.$descuentos.')'),array('Tarifa.destino'=>$this->data['Tarifa']['destino']));
		$config['Configuracion']['tarifa_incremento'] = 0;
		$this->Tarifa->importModel('Configuracion')->save($config);
	}

	public function decremento($clienteId = null) {
		$config    = $this->Tarifa->importModel('Configuracion')->find('first');
		$descuento = floatval($config['Configuracion']['tarifa_decremento'])/100;
		$this->Tarifa->updateAll(array('Tarifa.tarifa' =>'Tarifa.tarifa/(1-'.$descuentos.')'),array('Tarifa.destino'=>$this->data['Tarifa']['destino']));
		$config['Configuracion']['tarifa_decremento'] = 0;
		$this->Tarifa->importModel('Configuracion')->save($config);
	}
}
?>

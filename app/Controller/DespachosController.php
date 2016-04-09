<?php
class DespachosController extends AppController {
	public $name = 'Despachos';

	public function crear() {
		if(!empty($this->data)){
			$this->request->data['Despacho']['fecha'] = date("Y-m-d H:i:s");
			$this->request->data['Despacho']['guias'] = json_encode($this->data['Despacho']['guias2']);
			if($this->data['Despacho']['id'] == ''){
				$this->Despacho->create();
			}
			if($this->Despacho->save($this->data)) {
				$this->Despacho->importModel('Venta')->updateAll(array('Venta.despachada'=>"'Despachada'",'Venta.tipo_despacho'=>"'Vehiculo'",'Venta.despacho'=>$this->Despacho->id),array('Venta.id'=>$this->data['Despacho']['guias2']));
    			$this->Session->setFlash('','ok',array('mensaje'=>'El Despacho se guardo con exito'));
				$this->redirect(array('action' => 'imprimir',$this->Despacho->id));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar el Despacho. Por favor intente nuevamente'));
			}
		}
		$this->data = null;
		$negociadores  = $this->Despacho->importModel('Auxiliar')->find('list',array('conditions'=>array('Auxiliar.negociar'=>'Si')));
		$placas        = $this->Despacho->importModel('Vehiculo')->find('list');
		$vehiculos     = $this->Despacho->importModel('Vehiculo')->find('all',array('recursive'=>-1));
		$conductores   = $this->Despacho->importModel('Conductor')->find('all',array('conditions'=>array('Conductor.conductor2'=>1)));	
		$conductoresId = $this->Despacho->importModel('Conductor')->find('list',array('fields'=>array('Conductor.identificacion'),'conditions'=>array('Conductor.conductor2'=>1)));
		$destinos      = $this->Despacho->importModel('Destino')->find('list');
		
		$user          = $this->Auth->user();
		$user          = $this->Despacho->importModel('User')->read(null,$user['id']);
		$ventas        = $this->Despacho->importModel('Venta')->find('all',array('conditions'=>array('Venta.lista'=>1,'Venta.despachada'=>$user['Oficina']['id'])));
		$ventasL       = array();
		$empaques      = $this->Despacho->importModel('Empaque')->find('list');
		foreach ($ventas as $key => $value) {
			$ventasL[$value['Venta']['id']] = 'Remesa:'.str_replace('-','',$value['Venta']['remesa'])." || ".$destinos[$value['Venta']['destino']]." || ".$value['Venta']['nombreDest'];
			$empaquesInfo                   = json_decode($value['Venta']['empaque_info'],true);
			$cantidad                       = 0;
			$empaqueAnt                     = $empaquesInfo['empaques'][0];
			$flagE                          = true; 
			$barras = implode("", $empaquesInfo['barras']);
			$pistola[$value['Venta']['id']] = array_values(array_filter(explode(",",$barras)));
			foreach ($empaquesInfo['empaques'] as $key2 => $value2) {
				$cantidad = $cantidad + floatval($empaquesInfo['cantidad'][$key2]);
				if($value2 != $empaqueAnt){
					$flagE = false;
				}
			}
			if($flagE){
				$ventas[$key]['Venta']['empaque'] = $empaques[$empaqueAnt];
			} else {
				$ventas[$key]['Venta']['empaque'] = 'Otros';
			}
			$ventas[$key]['Venta']['barras']   = $barras;
			$ventas[$key]['Venta']['cantidad'] = $cantidad;
			$ventas[$key]['Venta']['destinoN'] = $destinos[$value['Venta']['destino']];
		}

		$this->generateJSON('ventas', $ventas, array('Venta' => array('id','remesa','barras','nombreDest','direccionDest','destinoN','telefonoDest','cantidad','empaque')));
		$this->set(compact('pistola','ventasL','ventas','negociadores','vehiculos','placas','conductoresId','conductores','destinos'));
	}

	public function traslado() {
		if(!empty($this->data)){
			$this->request->data['Despacho']['fecha'] = date("Y-m-d g:i");
			$this->request->data['Despacho']['guias'] = json_encode($this->data['Despacho']['guias2']);
			App::import('model', 'Traslado');
        	$trasladoImport = new Traslado();
			if($this->data['Despacho']['id'] == ''){
				$trasladoImport->create();
			}
			$this->request->data['Traslado'] = $this->data['Despacho'];
			if($trasladoImport->save($this->data)) {
				$dest = 'EnTraslado :'.$this->data['Despacho']['destino'];
				$this->Despacho->importModel('Venta')->updateAll(array('Venta.despachada'=>'"'.$dest.'"'),array('Venta.id'=>$this->data['Despacho']['guias2']));
    			$this->Session->setFlash('','ok',array('mensaje'=>'El traslado se realizo con exito'));
				$this->redirect(array('controller'=>'traslados','action' => 'imprimir',$trasladoImport->id));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido realizar el despacho. Por favor intente nuevamente'));
			}
		}
		$this->data = null;
		$negociadores  = $this->Despacho->importModel('Auxiliar')->find('list',array('conditions'=>array('Auxiliar.negociar'=>'Si')));
		$placas        = $this->Despacho->importModel('Vehiculo')->find('list');
		$vehiculos     = $this->Despacho->importModel('Vehiculo')->find('all',array('recursive'=>-1));
		$conductores   = $this->Despacho->importModel('Conductor')->find('all',array('conditions'=>array('Conductor.conductor2'=>1)));	
		$conductoresId = $this->Despacho->importModel('Conductor')->find('list',array('fields'=>array('Conductor.identificacion'),'conditions'=>array('Conductor.conductor2'=>1)));
		$oficinas      = $this->Despacho->importModel('Oficina')->find('all');
		$oficinasL     = $this->Despacho->importModel('Oficina')->find('list');
		
		$user          = $this->Auth->user();
		$user          = $this->Despacho->importModel('User')->read(null,$user['id']);
		$ventas        = $this->Despacho->importModel('Venta')->find('all',array('conditions'=>array('Venta.lista'=>1,'Venta.despachada'=>$user['Oficina']['id'])));
		$ventasL       = array();
		$empaques      = $this->Despacho->importModel('Empaque')->find('list');
		foreach ($ventas as $key => $value) {
			$ventasL[$value['Venta']['id']] = 'Remesa:'.str_replace('-','',$value['Venta']['remesa'])." || ".$value['Venta']['destinoNombre']." || ".$value['Venta']['nombreDest'];
			$empaquesInfo                   = json_decode($value['Venta']['empaque_info'],true);
			$cantidad                       = 0;
			$empaqueAnt                     = $empaquesInfo['empaques'][0];
			$flagE                          = true;
			$barras = implode("", $empaquesInfo['barras']);
			$pistola[$value['Venta']['id']] = array_filter(explode(",",$barras));
			foreach ($empaquesInfo['empaques'] as $key2 => $value2) {
				$cantidad = $cantidad + floatval($empaquesInfo['cantidad'][$key2]);
				if($value2 != $empaqueAnt){
					$flagE = false;
				}
			}
			if($flagE){
				$ventas[$key]['Venta']['empaque'] = $empaques[$empaqueAnt];
			} else {
				$ventas[$key]['Venta']['empaque'] = 'Otros';
			}
			$ventas[$key]['Venta']['barras']   = $barras;
			$ventas[$key]['Venta']['cantidad'] = $cantidad;
			$ventas[$key]['Venta']['destinoN'] = $ventas[$key]['Venta']['destinoNombre'];
		}

		$this->generateJSON('traslados', $ventas, array('Venta' => array('id','remesa','barras','nombreDest','direccionDest','destinoN','telefonoDest','cantidad','empaque')));
		$this->set(compact('pistola','oficinas','oficinasL','ventasL','ventas','negociadores','vehiculos','placas','conductoresId','conductores','destinos'));
	}

	public function getNegociacion($vehiculoId = null,$destinoId = null) {
		$this->autoRender = false;
		$user      = $this->Auth->user();
		$user      = $this->Despacho->importModel('User')->read(null,$user['id']);
		$vehiculos = $this->Despacho->importModel('VehiculoNegociacion')->find('first',array('recursive'=>'-1','conditions'=>array('VehiculoNegociacion.vehiculo'=>$vehiculoId,'VehiculoNegociacion.destino'=>$destinoId)));
		$ventas    = $this->Despacho->importModel('Venta')->find('all',array('conditions'=>array('Venta.lista'=>1,'Venta.despachada'=>$user['Oficina']['id'])));
		$data      = array();
		$nego      = json_decode($vehiculos['VehiculoNegociacion']['rangos'],true);
		$valorAdic = floatval($vehiculos['VehiculoNegociacion']['valor_adicional']);

		foreach ($ventas as $key => $value) {
			$empaquesInfo = json_decode($value['Venta']['empaque_info'],true);
			$cantidad     = 0;
			$valor        = 0;
			$valoK        = 0;
			$kiloT        = 0;
			$kiloTVol     = 0;
			$kiloS        = 0;
			$pesoVolMax   = 0;
			foreach ($empaquesInfo['empaques'] as $key2 => $value2) {
				$kiloTVol   = $kiloTVol + floatval($empaquesInfo['pesoVol'][$key2]);
				$kiloT      = $kiloT + floatval($empaquesInfo['peso'][$key2]);
				$cantidadU  = floatval($empaquesInfo['cantidad'][$key2]);
				if($value2 == '1'){
					$kiloS = $kiloS + (floatval($vehiculos['VehiculoNegociacion']['max_sobre'])*$cantidadU);
					$valor = $valor + (floatval($vehiculos['VehiculoNegociacion']['valor_sobre'])*$cantidadU);
				} else if($value2 == '2'){
					$kiloS = $kiloS + (floatval($vehiculos['VehiculoNegociacion']['max_paquete'])*$cantidadU);
					$valor = $valor + (floatval($vehiculos['VehiculoNegociacion']['valor_paquete'])*$cantidadU);
				} else if($value2 == '3'){
					$kiloS = $kiloS + (floatval($vehiculos['VehiculoNegociacion']['max_caja'])*$cantidadU);
					$valor = $valor + (floatval($vehiculos['VehiculoNegociacion']['valor_caja'])*$cantidadU);
				} else if($value2 == '4'){
					$kiloS = $kiloS + (floatval($vehiculos['VehiculoNegociacion']['max_devol'])*$cantidadU);
					$valor = $valor + (floatval($vehiculos['VehiculoNegociacion']['valor_devol'])*$cantidadU);
				} else {
					$kiloS = $kiloS + (floatval($vehiculos['VehiculoNegociacion']['max_base'])*$cantidadU);
					$valor = $valor + (floatval($vehiculos['VehiculoNegociacion']['valor_base'])*$cantidadU);
				}
				$cantidad = $cantidad + $cantidadU;
			}
			$valorAd = 0;
			if($kiloTVol > $kiloT && $kiloTVol > $kiloS){
				$dif = $kiloTVol - $kiloS;
			}
			if($kiloT > $kiloTVol && $kiloT > $kiloS){
				$dif = $kiloT - $kiloS;
			}

			$valorAd = ($dif*floatval($vehiculos['VehiculoNegociacion']['valor_adicional']));
			
			$descCant = 0;
			//$valor = floatval('5') * $cantidad;
			foreach ($nego as $key3 => $value3) {
				if($cantidad >= floatval($value3['desde']) && $cantidad <= floatval($value3['hasta'])) {
					$descCant = ($valor * (floatval($value3['descuento']/100)));
				}
				if($dif > 0){
					if($kiloS >= floatval($value3['desde2']) && $kiloS <= floatval($value3['hasta2'])) {
						$valorAd = ($valorAd - ($valorAd * (floatval($value3['descuento2']/100))));
					}
				}
			}
			$valor = $valor - $descCant + $valorAd;

			$data[$value['Venta']['id']] = $valor;
		}
		return json_encode($data);
	}

	public function getEmpaques($vehiculoId = null, $ventaId = null) {
		$this->autoRender = false;
		$user      = $this->Auth->user();
		$user      = $this->Despacho->importModel('User')->read(null,$user['id']);
		$vehiculos = $this->Despacho->importModel('Vehiculo')->find('first',array('recursive'=>'-1','conditions'=>array('Vehiculo.id'=>$vehiculoId)));
		$ventas    = $this->Despacho->importModel('Venta')->find('all',array('conditions'=>array('Venta.despachada'=>$user['Oficina']['id'],'Venta.id'=>$ventaId)));
		$data      = array();
		$nego      = json_decode($vehiculos['Vehiculo']['rangoUnidad'],true);
		$valorAdic = floatval($vehiculos['Vehiculo']['valor_adicional']);

		$destinos    = $this->Despacho->importModel('Destino')->find('list');
		$empaques    = $this->Despacho->importModel('Empaque')->find('list');

		foreach ($ventas as $key => $value) {
			$empaquesInfo = json_decode($value['Venta']['empaque_info'],true);
			
			foreach ($empaquesInfo['empaques'] as $key2 => $value2) {
				$cantidad   = 0;
				$valor      = 0;
				$valoK      = 0;
				$kiloT      = 0;
				$kiloS      = 0;
				$pesoVolMax = 0;

				if(floatval($empaquesInfo['pesoVol'][$key2]) >= floatval($empaquesInfo['peso'][$key2])) {
					$kiloT = $kiloT + floatval($empaquesInfo['pesoVol'][$key2]);
				} else {
					$kiloT = $kiloT + floatval($empaquesInfo['peso'][$key2]);
				}
				$pesoVolMax = $pesoVolMax + $kiloT;
				$cantidadU  = floatval($empaquesInfo['cantidad'][$key2]);
				if($value2 == '1'){
					$kiloS = $kiloS + (floatval($vehiculos['Vehiculo']['max_sobre'])*$cantidadU);
					$valor = $valor + (floatval($vehiculos['Vehiculo']['valor_sobre'])*$cantidadU);
				} else if($value2 == '2'){
					$kiloS = $kiloS + (floatval($vehiculos['Vehiculo']['max_paquete'])*$cantidadU);
					$valor = $valor + (floatval($vehiculos['Vehiculo']['valor_paquete'])*$cantidadU);
				} else if($value2 == '3'){
					$kiloS = $kiloS + (floatval($vehiculos['Vehiculo']['max_caja'])*$cantidadU);
					$valor = $valor + (floatval($vehiculos['Vehiculo']['valor_caja'])*$cantidadU);
				} else if($value2 == '4'){
					$kiloS = $kiloS + (floatval($vehiculos['Vehiculo']['max_devol'])*$cantidadU);
					$valor = $valor + (floatval($vehiculos['Vehiculo']['valor_devol'])*$cantidadU);
				} else {
					$kiloS = $kiloS + (floatval($vehiculos['Vehiculo']['max_base'])*$cantidadU);
					$valor = $valor + (floatval($vehiculos['Vehiculo']['valor_base'])*$cantidadU);
				}
				$cantidad = $cantidad + $cantidadU;
				
				$empaL[$key2]['Empa']['id']            = $key2;
				$empaL[$key2]['Empa']['remesa']        = $value['Venta']['remesa'];
				$empaL[$key2]['Empa']['nombreDest']    = $value['Venta']['nombreDest'];
				$empaL[$key2]['Empa']['direccionDest'] = $value['Venta']['direccionDest'];
				$empaL[$key2]['Empa']['destinoN']      = $destinos[$value['Venta']['destino']];
				$empaL[$key2]['Empa']['telefonoDest']  = $value['Venta']['telefonoDest'];
				$empaL[$key2]['Empa']['cantidad']      = $empaquesInfo['cantidad'][$key2];
				$empaL[$key2]['Empa']['empaque']       = $empaques[$value2];
				$empaL[$key2]['Empa']['valor']         = $valor;
			}
		/*	if($pesoVolMax > $kiloS) {
				$dif = $pesoVolMax - $kiloS;
				$valor = $valor + ($dif*floatval($vehiculos['Vehiculo']['valor_adicional']));
			}
			//$valor = floatval('5') * $cantidad;
			foreach ($nego as $key3 => $value3) {
				if($cantidad >= floatval($value3['desde']) && $cantidad <= floatval($value3['hasta'])) {
					$valor = $valor - ($valor * (floatval($value3['descuento']/100)));
				}
				if($kiloS >= floatval($value3['desde2']) && $kiloS <= floatval($value3['hasta2'])) {
					$valor = $valor + ($valoK - ($valoK * (floatval($value3['descuento2']/100))));
				}
			}
	
			$data[$value['Venta']['id']] = $valor;*/
		}
		$this->generateJSON('empaques_despacho', $empaL, array('Empa' => array('id','remesa','nombreDest','direccionDest','destinoN','telefonoDest','cantidad','empaque')));

		return json_encode($empaL);
	}

	public function crear2() {
		if(!empty($this->data)){
			$venta                   = $this->Despacho->importModel('Venta')->find('first',array('recursive'=>-1,'conditions'=>array('Venta.id'=>$this->data['Despacho']['guia'])));
			$venta['Venta']['id']    = '';
			$venta['Venta']['clase'] = 'Especial';
			$empaquesInfo            = json_decode($venta['Venta']['empaque_info'],true);
			foreach ($this->data['Despacho']['remesaId'] as $key => $value) {
				$dif = floatval($empaquesInfo['cantidad'][$value]) - floatval($this->data['Despacho']['cantidad'][$key]);
				if($dif > 0){
					$empaquesInfo['cantidad'][$value] = $dif;
				} else {
					unset($empaquesInfo['empaques'][$value]);
					unset($empaquesInfo['cantidad'][$value]);
					unset($empaquesInfo['largo'][$value]);
					unset($empaquesInfo['ancho'][$value]);
					unset($empaquesInfo['alto'][$value]);
					unset($empaquesInfo['peso'][$value]);
					unset($empaquesInfo['pesoVol'][$value]);
					unset($empaquesInfo['valor'][$value]);
					unset($empaquesInfo['kiloAd'][$value]);
				}
			}
			$venta['Venta']['empaque_info'] = json_encode($empaquesInfo);
			$this->Despacho->importModel('Venta')->create();
			$this->Despacho->importModel('Venta')->save($venta);
		//	$this->log($this->data);
			/*
			$this->request->data['Despacho']['guias'] = json_encode($this->data['Despacho']['guias2']);
			if($this->data['Despacho']['id'] == ''){
				$this->Despacho->create();
			}
			if($this->Despacho->save($this->data)) {
				//$this->Despacho->importModel('Venta')->updateAll(array('Venta.despachada'=>"'Si'"),array('Venta.id'=>$this->data['Despacho']['guias2']));
    			$this->Session->setFlash('','ok',array('mensaje'=>'La Despacho se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar la Despacho. Por favor intente nuevamente'));
			}
			*/
		}
		$negociadores  = $this->Despacho->importModel('Auxiliar')->find('list',array('conditions'=>array('Auxiliar.negociar'=>'Si')));
		$placas        = $this->Despacho->importModel('Vehiculo')->find('list');
		$vehiculos     = $this->Despacho->importModel('Vehiculo')->find('all',array('recursive'=>-1));
		$conductores   = $this->Despacho->importModel('Conductor')->find('all',array('conditions'=>array('Conductor.conductor2'=>1)));	
		$conductoresId = $this->Despacho->importModel('Conductor')->find('list',array('fields'=>array('Conductor.identificacion'),'conditions'=>array('Conductor.conductor2'=>1)));
		$destinos      = $this->Despacho->importModel('Destino')->find('list');
		
		$user          = $this->Auth->user();
		$user          = $this->Despacho->importModel('User')->read(null,$user['id']);
		$ventas        = $this->Despacho->importModel('Venta')->find('all',array('conditions'=>array('Venta.despachada'=>$user['Oficina']['id'])));
		$ventasL       = array();
		$empaques      = $this->Despacho->importModel('Empaque')->find('list');
		foreach ($ventas as $key => $value) {
			$ventasL[$value['Venta']['id']] = 'Remesa:'.$value['Venta']['remesa']." || ".$destinos[$value['Venta']['destino']]." || ".$value['Venta']['nombreDest'];
			$empaquesInfo                   = json_decode($value['Venta']['empaque_info'],true);
			$cantidad                       = 0;
			$empaqueAnt                     = $empaquesInfo['empaques'][0];
			$flagE                          = true; 
			foreach ($empaquesInfo['empaques'] as $key2 => $value2) {
				$cantidad = $cantidad + floatval($empaquesInfo['cantidad'][$key2]);
				if($value2 != $empaqueAnt){
					$flagE = false;
				}
			}
			if($flagE){
				$ventas[$key]['Venta']['empaque'] = $empaques[$empaqueAnt];
			} else {
				$ventas[$key]['Venta']['empaque'] = 'Otros';
			}
			$ventas[$key]['Venta']['cantidad'] = $cantidad;
			$ventas[$key]['Venta']['destinoN'] = $destinos[$value['Venta']['destino']];
		}

		$this->generateJSON('empaques_despacho', null, array('Venta' => array('id','remesa','nombreDest','direccionDest','destinoN','telefonoDest','cantidad','empaque')));
		$this->set(compact('ventasL','ventas','negociadores','vehiculos','placas','conductoresId','conductores','destinos'));
	}

	public function crear3() {
		if(!empty($this->data)){
		/*	$this->request->data['Despacho']['guias'] = json_encode($this->data['Despacho']['guias2']);
			if($this->data['Despacho']['id'] == ''){
				$this->Despacho->create();
			}
			if($this->Despacho->save($this->data)) {
				//$this->Despacho->importModel('Venta')->updateAll(array('Venta.despachada'=>"'Si'"),array('Venta.id'=>$this->data['Despacho']['guias2']));
    			$this->Session->setFlash('','ok',array('mensaje'=>'La Despacho se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar la Despacho. Por favor intente nuevamente'));
			}*/
		}
		$negociadores  = $this->Despacho->importModel('Auxiliar')->find('list',array('conditions'=>array('Auxiliar.negociar'=>'Si')));
		$placas        = $this->Despacho->importModel('Vehiculo')->find('list');
		$vehiculos     = $this->Despacho->importModel('Vehiculo')->find('all',array('recursive'=>-1));
		$conductores   = $this->Despacho->importModel('Conductor')->find('all',array('conditions'=>array('Conductor.conductor2'=>1)));	
		$conductoresId = $this->Despacho->importModel('Conductor')->find('list',array('fields'=>array('Conductor.identificacion'),'conditions'=>array('Conductor.conductor2'=>1)));
		$destinos      = $this->Despacho->importModel('Destino')->find('list');
		
		$user          = $this->Auth->user();
		$user          = $this->Despacho->importModel('User')->read(null,$user['id']);
		$ventas        = $this->Despacho->importModel('Venta')->find('all',array('conditions'=>array('Venta.despachada'=>$user['Oficina']['id'])));
		$ventasL       = array();
		$arbol         = "";
		$empaques      = $this->Despacho->importModel('Empaque')->find('list');
		foreach ($ventas as $key => $value) {
			$ventasL[$value['Venta']['id']] = 'Remesa:'.$value['Venta']['remesa']." || ".$destinos[$value['Venta']['destino']]." || ".$value['Venta']['nombreDest'];
			//$arbol = $arbol . "<li class='jstree-ocl'>".'<span class="selec" style="display:none;" guiaId="'.$value['Venta']['destino'].'"></span>Remesa:'.$value['Venta']['remesa']." || ".$destinos[$value['Venta']['destino']]." || ".$value['Venta']['nombreDest']."<ul>";
			$arbol = $arbol . '
			<div class="panel panel-default ventaTab tab'.$value['Venta']['destino'].'" style="margin:0px;">
				<div class="panel-heading">
					<div style="height:20px">
						<span class="glyphicon glyphicon-chevron-right" style="float:left;"></span>
						<h4 data-toggle="collapse" data-parent="#accordion" href="#Ref'.$value['Venta']['remesa'].'" style="cursor:pointer;float:left;margin-top: 0px;">'.$ventasL[$value['Venta']['id']].'</h4>
						<div style="float:right;">
							<div class="input checkbox">
								<input type="checkbox" name="data[Despacho][checkbox][]" value="'.$value['Venta']['remesa'].'" id="Check'.$value['Venta']['remesa'].'">
								<label for="Check'.$value['Venta']['remesa'].'">Despachar</label>
							</div>
						</div>
					</div>
				</div>
			<div id="Ref'.$value['Venta']['remesa'].'" class="panel-collapse collapse" style="height: auto;">
			<div class="panel-body">';
			$empaquesInfo                   = json_decode($value['Venta']['empaque_info'],true);
			$cantidad                       = 0;
			$empaqueAnt                     = $empaquesInfo['empaques'][0];
			$flagE                          = true; 
			foreach ($empaquesInfo['empaques'] as $key2 => $value2) {
				//$arbol = $arbol . "<li rel='file'><div style='width:40%;float:left;'>".$empaques[$empaquesInfo['empaques'][$key2]]."</div><div style='width:40%;float:left;'>Cantidad: ".$empaquesInfo['cantidad'][$key2]."</div></li>";
				$arbol = $arbol . '
					<h4 style="width:20%;float:left;margin-top:0px;">'.$empaques[$empaquesInfo['empaques'][$key2]].'</h4>
					<h5 style="width:16%;float:left;margin-top:0px;">Largo: '.$empaquesInfo['largo'][$key2].'</h5>
					<h5 style="width:16%;float:left;margin-top:0px;">Ancho: '.$empaquesInfo['ancho'][$key2].'</h5>
					<h5 style="width:16%;float:left;margin-top:0px;">Alto: '.$empaquesInfo['alto'][$key2].'</h5>
					<h4 style="width:16%;float:left;margin-top:0px;">Cant: '.$empaquesInfo['cantidad'][$key2].'</h4>
					<input name="data[Despacho]['.$value['Venta']['remesa'].']['.$empaques[$empaquesInfo['empaques'][$key2]].'][]" style="float:left;width:16%" type="text"><hr class="clearing"/>';
				$cantidad = $cantidad + floatval($empaquesInfo['cantidad'][$key2]);
				if($value2 != $empaqueAnt){
					$flagE = false;
				}
			}
			$arbol = $arbol . "</div></div></div>";
			if($flagE){
				$ventas[$key]['Venta']['empaque'] = $empaques[$empaqueAnt];
			} else {
				$ventas[$key]['Venta']['empaque'] = 'Otros';
			}
			$ventas[$key]['Venta']['cantidad'] = $cantidad;
			$ventas[$key]['Venta']['destinoN'] = $destinos[$value['Venta']['destino']];
		}

		$this->generateJSON('ventas', $ventas, array('Venta' => array('id','remesa','nombreDest','direccionDest','destinoN','telefonoDest','cantidad','empaque')));
		$this->set(compact('arbol','ventasL','ventas','negociadores','vehiculos','placas','conductoresId','conductores','destinos'));
	}


	public function virtual(){
		if(!empty($this->data)){
			if(count($this->data['Despacho']['virtual'])>1){
				$this->Despacho->importModel('Venta')->updateAll(array('Venta.despachada' => '"Despachada"','Venta.virtual'=>$this->data['Despacho']['usuario'],'Venta.fecha_virtual'=>'"'.date("Y-m-d g:i").'"'),array('Venta.id' => $this->data['Despacho']['virtual']));
			} else {
				$this->Despacho->importModel('Venta')->updateAll(array(
					'Venta.despachada' => '"Despachada"',
					'Venta.virtual'=>$this->data['Despacho']['usuario'],
					'Venta.fecha_virtual'=>'"'.date("Y-m-d g:i").'"'),
				array('Venta.id' => $this->data['Despacho']['virtual'][0]));
			}
		}
		$empaques = $this->Despacho->importModel('Empaque')->find('list');
		$areasL   = $this->Despacho->importModel('Area')->find('list');
		$areas    = $this->Despacho->importModel('Area')->find('all');
		$destinos = $this->Despacho->importModel('Destino')->find('list');
		$ventas   = $this->Despacho->importModel('Venta')->find('all',array('conditions'=>array('Venta.despachada'=>'DespachadaRepre')));
		foreach ($ventas as $key => $value) {
			$empaqueInfo = json_decode($value['Venta']['empaque_info'], true);
			$suma = 0;
			foreach ($empaqueInfo['cantidad'] as $key2 => $value2) {
				$suma = $suma + $value2;
			}
			if(count($empaqueInfo) > 0){
				$ventas[$key]['Venta']['empaque'] = 'Otros';
			} else {
				$ventas[$key]['Venta']['empaque'] = $empaques[$empaqueInfo['empaques'][0]];
			}
			$ventas[$key]['Venta']['cantidad'] = $suma;
			$ventas[$key]['Venta']['origenN']  = $destinos[$value['Venta']['origen']];
			$ventas[$key]['Venta']['destinoN'] = $destinos[$value['Venta']['destino']];
		}
		foreach ($areas as $key => $value) {
			$areas[$key]['Area']['destinos'] = json_decode($value['Area']['destinos'],true);
		}
		$this->generateJSON('ventas_virtual', $ventas, array('Venta' => array('id','origen','destino','remesa','nombreDest','nombreClien','origenN','destinoN','cantidad','empaque')));
		$this->set(compact('areas','areasL'));
	}


	public function auxImprimir($venta){
		# code...
	}

	function imprimir($id = null){
		$ofici     = $this->Despacho->importModel('Oficina')->find('list');
		$desti     = $this->Despacho->importModel('Destino')->find('list');
		$empaq     = $this->Despacho->importModel('Empaque')->find('list');
		$despa     = $this->Despacho->find('first',array('conditions'=>array('Despacho.id'=>$id)));
		$usuario   = $this->Despacho->importModel('User')->find('first',array('conditions'=>array('User.id'=>$despa['Despacho']['usuario'])));
		$negoc     = $this->Despacho->importModel('Auxiliar')->find('first',array('conditions'=>array('Auxiliar.id'=>$despa['Despacho']['negociador'])));
		$vehiculo  = $this->Despacho->importModel('Vehiculo')->find('first',array('recursive'=>-1,'conditions'=>array('Vehiculo.id'=>$despa['Despacho']['placa'])));
		$conductor = $this->Despacho->importModel('Conductor')->find('first',array('recursive'=>-1,'conditions'=>array('Conductor.id'=>$despa['Despacho']['conductor'])));
		$venta     = $this->Despacho->importModel('Venta')->find('all',array('recursive'=>-1,'conditions'=>array('Venta.id'=>json_decode($despa['Despacho']['guias'],true))));
		$despa['Despacho']['destino'] = $desti[$despa['Despacho']['destino']];
		$despa['Despacho']['origen']  = $desti[$despa['Despacho']['origen']];
		$despa['Despacho']['valor']   = number_format($despa['Despacho']['valor'], 0, '.', ',');
		
		$usuario   = $usuario['User']['listNombre'];
		$valores   = json_decode($despa['Despacho']['valores'],true);

		$cantTotal = 0;
		foreach ($venta as $key => $value) {
			$empaquesInfo = json_decode($value['Venta']['empaque_info'],true);
			if(count(array_unique($empaquesInfo['empaques'])) > 1){
				$venta[$key]['Venta']['empaque'] = 'Otros';
			} else {
				$venta[$key]['Venta']['empaque'] = $empaq[$empaquesInfo['empaques'][0]];
			}
			$cant = 0;
			foreach ($empaquesInfo['empaques'] as $key2 => $value2) {
				$cant = $cant + $empaquesInfo['cantidad'][$key2];
			}
			$venta[$key]['Venta']['cantidad'] = $cant;
			$cantTotal = $cantTotal + $cant;
			$venta[$key]['Venta']['valor']    = number_format($valores[$key], 0, '.', ',');
			$count = array_filter($valores,"0");
			$this->log($count);
			unset($venta[$key]['Venta']['empaque_info']);














			$envio['hoja'][]         = '**DESTINATARIO**';
			$envio['hoja'][]         = '**PRUEBA DE ENTREGA**';
			$envio['n'][]            = 1;
			$envio['n'][]            = 1;
			$envio['guia'][]         = $value['Venta']['remesa'];
			$envio['guia'][]         = $value['Venta']['remesa'];
			$envio['contactoR'][]    = $value['Venta']['contacto'];
			$envio['contactoR'][]    = $value['Venta']['contacto'];
			$envio['contactoTelR'][] = $value['Venta']['contacto_tel'];
			$envio['contactoTelR'][] = $value['Venta']['contacto_tel'];
			$oficinaB                = $this->Despacho->importModel('Oficina')->find('first',array('recursive'=>-1,'fields'=>array('nombre','hasta','desde','resolucion','prefijo','codigo'),'conditions'=>array('Oficina.id'=>$value['Venta']['oficina'])));
			$envio['oficina'][]      = $oficinaB['Oficina']['nombre'];
			$envio['oficina'][]      = $oficinaB['Oficina']['nombre'];
			$envio['resolucion'][]   = 'Res. '.$oficinaB['Oficina']['resolucion'].' Autoriza del: '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['desde'].' al '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['hasta'];
			$envio['resolucion'][]   = 'Res. '.$oficinaB['Oficina']['resolucion'].' Autoriza del: '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['desde'].' al '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['hasta'];
			$envio['fecha'][]        = $value['Venta']['fecha'];
			$envio['fecha'][]        = $value['Venta']['fecha'];
			$envio['vence'][]        = $value['Venta']['fecha'];
			$envio['vence'][]        = $value['Venta']['fecha'];
			$envio['factura'][]      = $value['Venta']['facturacion'];
			$envio['factura'][]      = $value['Venta']['facturacion'];
			$envio['servicio'][]     = 'Envío de Encomiendas';
			$envio['servicio'][]     = 'Envío de Encomiendas';
			$envio['docRef'][]       = $value['Venta']['tipo'].' '.$value['Venta']['documento1'].' '.$value['Venta']['documento2'].' '.$value['Venta']['documento3'];
			$envio['docRef'][]       = $value['Venta']['tipo'].' '.$value['Venta']['documento1'].' '.$value['Venta']['documento2'].' '.$value['Venta']['documento3'];
			$envio['hora'][]         = $value['Venta']['hora'];
			$envio['hora'][]         = $value['Venta']['hora'];
			$envio['cliente'][]      = $value['Venta']['nombreClien'];
			$envio['cliente'][]      = $value['Venta']['nombreClien'];
			$envio['nit'][]          = $value['Venta']['documentoClien'];
			$envio['nit'][]          = $value['Venta']['documentoClien'];
			$envio['direccionC'][]   = $value['Venta']['direccionClien'];
			$envio['direccionC'][]   = $value['Venta']['direccionClien'];
			$envio['telefonoC'][]    = $value['Venta']['telefonoClien'];
			$envio['telefonoC'][]    = $value['Venta']['telefonoClien'];
			$envio['otro_remi'][]    = $value['Venta']['otro_remi'];
			$envio['otro_remi'][]    = $value['Venta']['otro_remi'];
			if($value['Venta']['otro_remi'] == 0){
				$envio['otro_remi'][]  = false;
				$envio['otro_remi'][]  = false;
				$envio['remitente'][]  = "";
				$envio['remitente'][]  = "";
				$envio['nitR'][]       = "";
				$envio['nitR'][]       = "";
				$envio['direccionR'][] = "";
				$envio['direccionR'][] = "";
				$envio['telefonoR'][]  = "";
				$envio['telefonoR'][]  = "";
			} else {
				$envio['otro_remi'][]  = true;
				$envio['otro_remi'][]  = true;
				$envio['remitente'][]  = $value['Venta']['nombreRemi'];
				$envio['remitente'][]  = $value['Venta']['nombreRemi'];
				$envio['nitR'][]       = $value['Venta']['documentoRemi'];
				$envio['nitR'][]       = $value['Venta']['documentoRemi'];
				$envio['direccionR'][] = $value['Venta']['direccionRemi'];
				$envio['direccionR'][] = $value['Venta']['direccionRemi'];
				$envio['telefonoR'][]  = $value['Venta']['telefonoRemi'];		
				$envio['telefonoR'][]  = $value['Venta']['telefonoRemi'];		
			}
			
			$envio['origen'][]       = $desti[$value['Venta']['origen']];
			$envio['origen'][]       = $desti[$value['Venta']['origen']];
			$envio['destino'][]      = $desti[$value['Venta']['destino']];
			$envio['destino'][]      = $desti[$value['Venta']['destino']];
			$destinatarioB         = $this->Despacho->importModel('Destinatario')->read(null,$value['Venta']['destinatario']);
			$contactoB             = json_decode($destinatarioB['Destinatario']['contacto'],true);
			$envio['destinatario'][] = $value['Venta']['nombreDest'];
			$envio['destinatario'][] = $value['Venta']['nombreDest'];
			$envio['ced'][]          = $value['Venta']['documentoDest'];
			$envio['ced'][]          = $value['Venta']['documentoDest'];
			$envio['direccionD'][]   = $value['Venta']['direccionDest'];
			$envio['direccionD'][]   = $value['Venta']['direccionDest'];
			$envio['telefonoD1'][]   = $value['Venta']['telefonoDest'];
			$envio['telefonoD1'][]   = $value['Venta']['telefonoDest'];
			$envio['telefonoD2'][]   = $contactoB[0]['telefono'];
			$envio['telefonoD2'][]   = $contactoB[0]['telefono'];
			$envio['contacto'][]     = $contactoB[0]['nombre'];
			$envio['contacto'][]     = $contactoB[0]['nombre'];
			$empaques_info         = json_decode($value['Venta']['empaque_info'],true);
			$empaquesIguales       = true;
			$sumaFlete             = 0;
			$sumaCantidad          = 0;
			$sumaPeso              = 0;
			$sumaAlto              = 0;
			$sumaAncho             = 0;
			$sumaLargo             = 0;
			$sumaPesoVol           = 0;
			$empaqueAct            = $empaques_info['empaques'][0];
			foreach ($empaques_info['empaques'] as $key5 => $value5) {
				$sumaFlete    = $sumaFlete + ($empaques_info['cantidad'][$key5]*$empaques_info['valor'][$key5]);
				$sumaLargo    = $sumaLargo + $empaques_info['largo'][$key5];
				$sumaAncho    = $sumaAncho + $empaques_info['ancho'][$key5];
				$sumaAlto     = $sumaAlto + $empaques_info['alto'][$key5];
				$sumaPeso     = $sumaPeso + ($empaques_info['cantidad'][$key5]*$empaques_info['peso'][$key5]);
				$sumaCantidad = $sumaCantidad + $empaques_info['cantidad'][$key5];
				$sumaPesoVol  = $sumaPesoVol + ($empaques_info['cantidad'][$key5]*(($empaques_info['largo'][$key5]/100)*($empaques_info['ancho'][$key5]/100)*($empaques_info['alto'][$key5]/100)*400));
				
				if(($empaqueAct != $empaques_info['empaques'][$key5]) && ($empaquesIguales)){
					$empaquesIguales = false;
				}
			}
			if($empaquesIguales){
				$envio['empaque'][] = $empaq[$empaqueAct];
				$envio['empaque'][] = $empaq[$empaqueAct];
			} else {
				$envio['empaque'][] = 'Otros empaques';
				$envio['empaque'][] = 'Otros empaques';
			}
			$envio['cantidad'][]    = $sumaCantidad;
			$envio['cantidad'][]    = $sumaCantidad;
			$envio['peso'][]        = $sumaPeso;
			$envio['peso'][]        = $sumaPeso;
			$envio['pesoVol'][]     = $sumaPesoVol;
			$envio['pesoVol'][]     = $sumaPesoVol;
			if(count($empaques_info['empaques']) > 1){
				$envio['largo'][]   = "";
				$envio['largo'][]   = "";
				$envio['ancho'][]   = "";
				$envio['ancho'][]   = "";
				$envio['alto'][]    = "";
				$envio['alto'][]    = "";
			} else {
				$envio['largo'][]   = $sumaLargo;
				$envio['largo'][]   = $sumaLargo;
				$envio['ancho'][]   = $sumaAncho;
				$envio['ancho'][]   = $sumaAncho;
				$envio['alto'][]    = $sumaAlto;
				$envio['alto'][]    = $sumaAlto;
			}

			$envio['barras'][]      = $value['Venta']['barras'];
			$envio['barras'][]      = $value['Venta']['barras'];
			$envio['observacion'][] = $value['Venta']['observaciones'];
			$envio['observacion'][] = $value['Venta']['observaciones'];
			$envio['contenido'][]   = $value['Venta']['contenido'];
			$envio['contenido'][]   = $value['Venta']['contenido'];
			$decla = str_replace(".",",",str_replace(",","",$value['Venta']['declarado']));
			$envio['valorDecla'][]  = number_format(floatval($decla),0,'.',',');
			$envio['valorDecla'][]  = number_format(floatval($decla),0,'.',',');
			$envio['valorFlete'][]  = number_format($sumaFlete,0,'.',',');
			$envio['valorFlete'][]  = number_format($sumaFlete,0,'.',',');

			$usuarioB = $this->Despacho->importModel('User')->read(null,$value['Venta']['usuario']);
			$envio['nombre'][]       = $usuarioB['User']['name'].' '.$usuarioB['User']['lastname'];
			$envio['nombre'][]       = $usuarioB['User']['name'].' '.$usuarioB['User']['lastname'];
			$envio['formaPago'][]    = $value['Venta']['clase'];
			$envio['formaPago'][]    = $value['Venta']['clase'];
			$envio['kiloAd'][]       = number_format($value['Venta']['kilo_adic'],0,'.',',');
			$envio['kiloAd'][]       = number_format($value['Venta']['kilo_adic'],0,'.',',');
			$envio['valorKiloAd'][]  = number_format($value['Venta']['valor_kilo_adic'],0,'.',',');
			$envio['valorKiloAd'][]  = number_format($value['Venta']['valor_kilo_adic'],0,'.',',');
			$envio['descFlete'][]    = number_format($value['Venta']['desc_flete'],0,'.',',');
			$envio['descFlete'][]    = number_format($value['Venta']['desc_flete'],0,'.',',');
			$envio['descKilo'][]     = number_format($value['Venta']['desc_kilo'],0,'.',',');
			$envio['descKilo'][]     = number_format($value['Venta']['desc_kilo'],0,'.',',');
			$envio['valorFirmado'][] = number_format($value['Venta']['valor_devolucion'],0,'.',',');
			$envio['valorFirmado'][] = number_format($value['Venta']['valor_devolucion'],0,'.',',');
			$envio['valorSeguro'][]  = number_format($value['Venta']['valor_seguro'],0,'.',',');
			$envio['valorSeguro'][]  = number_format($value['Venta']['valor_seguro'],0,'.',',');
			$envio['valorTotal'][]   = number_format($value['Venta']['valor_total'],0,'.',',');
			$envio['valorTotal'][]   = number_format($value['Venta']['valor_total'],0,'.',',');
			$envio['kiloNegoc'][]    = $value['Venta']['kilo_nego'];
			$envio['kiloNegoc'][]    = $value['Venta']['kilo_nego'];









		}

		$this->set(compact('conductor','envio','id','vehiculo','despa','negoc','venta','usuario','cantTotal'));
	}



	public function trazabilidad($id = null) {
		if($id != null){
			$empaques   = $this->Despacho->importModel('Empaque')->find('list');
			$destinos   = $this->Despacho->importModel('Destino')->find('list');
			$despacho   = $this->Despacho->find('first',array('recursive'=>'-1','conditions'=>array('Despacho.id'=>$id)));
			$negociador = $this->Despacho->importModel('Auxiliar')->find('first',array('conditions'=>array('Auxiliar.id'=>$despacho['Despacho']['negociador'])));
			$conductor  = $this->Despacho->importModel('Conductor')->find('first',array('conditions'=>array('Conductor.id'=>$despacho['Despacho']['conductor'])));
			$ventas     = $this->Despacho->importModel('Venta')->find('all',array('conditions'=>array('Venta.id'=>json_decode($despacho['Despacho']['guias'],true))));
			$despacho['Despacho']['nego']  = $negociador['Auxiliar']['nombre'];
			$despacho['Despacho']['cond']  = $conductor['Conductor']['listNombre'];
			$despacho['Despacho']['ced']   = $conductor['Conductor']['identificacion'];
			$despacho['Despacho']['dir']   = $conductor['Conductor']['direccion'];
			$despacho['Despacho']['tel']   = $conductor['Conductor']['telefono'];
			$despacho['Despacho']['cel']   = $conductor['Conductor']['celular'];
			$despacho['Despacho']['dest']   = $destinos[$despacho['Despacho']['destino']];
			$despacho['Despacho']['orig']   = $destinos[$despacho['Despacho']['origen']];
			
			$html2 = '<table class="table"><thead><tr><th>Remesa</th><th>Destinatario</th><th>Dirección</th><th>Destino</th><th>Empaques</th><th>Cantidad</th></tr></thead><tbody>';
			foreach ($ventas as $key => $value) {
				$empaquesInfo = json_decode($value['Venta']['empaque_info'],true);
				if(count(array_unique($empaquesInfo['empaques'])) > 1){
					$empa = 'Otros';
				} else {
					$empa = $empaques[$empaquesInfo['empaques'][0]];
				}
				$cant = 0;
				foreach ($empaquesInfo['empaques'] as $key2 => $value2) {
					$cant = $cant + $empaquesInfo['cantidad'][$key2];
				}
				$html2 = $html2.'<tr><td><a class="btn btn-info" target="_blank" href="../../ventas/trazabilidad/'.$value['Venta']['id'].'">'.$value['Venta']['remesa'].'</a></td><td>'.$value['Venta']['nombreDest'].'</td><td>'.$value['Venta']['direccionDest'].'</td><td>'.$value['Venta']['destinoNombre'].'</td><td>'.$empa.'</td><td>'.$cant.'</td></tr>';
			}
			$despacho['Despacho']['html2']  = $html2.'</tboby></table>';
		} else {
			$despacho = "";
		}
		$this->set(compact('despacho'));
	}

	public function trazabilidad2($id = null) {
		$this->autoRender = false;

		if($id != null){
			$despacho     = $this->Despacho->find('first',array('recursive'=>'-1','conditions'=>array('Despacho.id'=>$id)));
			if(!empty($despacho)){
				$empaques      = $this->Despacho->importModel('Empaque')->find('list');
				$destinos      = $this->Despacho->importModel('Destino')->find('list');
				$negociador    = $this->Despacho->importModel('Auxiliar')->find('first',array('conditions'=>array('Auxiliar.id'=>$despacho['Despacho']['negociador'])));
				//$representante = $this->Despacho->importModel('Representante')->find('first',array('conditions'=>array('Representante.id'=>$despacho['Despacho']['representante'])));
				$conductor  = $this->Despacho->importModel('Conductor')->find('first',array('conditions'=>array('Conductor.id'=>$despacho['Despacho']['conductor'])));
				$ventas        = $this->Despacho->importModel('Venta')->find('all',array('conditions'=>array('Venta.id'=>json_decode($despacho['Despacho']['guias'],true))));
				$despacho['Despacho']['nego']  = $negociador['Auxiliar']['nombre'];
				$despacho['Despacho']['cond']  = $conductor['Conductor']['listNombre'];
				$despacho['Despacho']['ced']   = $conductor['Conductor']['identificacion'];
				$despacho['Despacho']['dir']   = $conductor['Conductor']['direccion'];
				$despacho['Despacho']['tel']   = $conductor['Conductor']['telefono'];
				$despacho['Despacho']['cel']   = $conductor['Conductor']['celular'];
				$despacho['Despacho']['dest']   = $destinos[$despacho['Despacho']['destino']];
				$despacho['Despacho']['orig']   = $destinos[$despacho['Despacho']['origen']];
				
				$html2 = '<table class="table"><thead><tr><th>Remesa</th><th>Destinatario</th><th>Dirección</th><th>Destino</th><th>Empaques</th><th>Cantidad</th></tr></thead><tbody>';
				foreach ($ventas as $key => $value) {
					$empaquesInfo = json_decode($value['Venta']['empaque_info'],true);
					if(count(array_unique($empaquesInfo['empaques'])) > 1){
						$empa = 'Otros';
					} else {
						$empa = $empaques[$empaquesInfo['empaques'][0]];
					}
					$cant = 0;
					foreach ($empaquesInfo['empaques'] as $key2 => $value2) {
						$cant = $cant + $empaquesInfo['cantidad'][$key2];
					}
					$html2 = $html2.'<tr><td><a class="btn btn-info" target="_blank" href="../../ventas/trazabilidad/'.$value['Venta']['id'].'">'.$value['Venta']['remesa'].'</a></td><td>'.$value['Venta']['nombreDest'].'</td><td>'.$value['Venta']['direccionDest'].'</td><td>'.$value['Venta']['destinoNombre'].'</td><td>'.$empa.'</td><td>'.$cant.'</td></tr>';
				}
				$despacho['Despacho']['html2']  = $html2.'</tboby></table>';
			} else {
				$despacho = "";
			}
		} else {
			$despacho = "";
		}
		return json_encode($despacho);
	}

}
?>

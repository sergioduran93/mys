<?php
class ReempaquesController extends AppController {
	public $name = 'Reempaques';

	public function crear() {
		if(!empty($this->data)){
			$this->request->data['Reempaque']['fecha'] = date("Y-m-d H:i:s");
			$this->request->data['Reempaque']['guias'] = json_encode($this->data['Reempaque']['guias2']);
			if($this->data['Reempaque']['id'] == ''){
				$this->Reempaque->create();
			}
			if($this->Reempaque->save($this->data)) {
				$this->Reempaque->importModel('Venta')->updateAll(array('Venta.despachada'=>"'Despachada'",'Venta.tipo_despacho'=>"'Representante'",'Venta.reempaque'=>$this->Reempaque->id),array('Venta.id'=>$this->data['Reempaque']['guias2']));
    			$this->Session->setFlash('','ok',array('mensaje'=>'La Planilla No. '.$this->Reempaque->id.' de Reempaque se guardo con exito'));
				$this->redirect(array('action' => 'imprimir',$this->Reempaque->id));
				
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar la Reempaque. Por favor intente nuevamente'));
			}
		}
		$this->data = null;
		$negociadores   = $this->Reempaque->importModel('Auxiliar')->find('list');
		$representanteC = $this->Reempaque->importModel('Representante')->find('list',array('fields'=>array('Representante.codigo')));
		$representantes = $this->Reempaque->importModel('Representante')->find('all',array('recursive'=>-1));
		$conductores    = $this->Reempaque->importModel('Conductor')->find('all',array('conditions'=>array('Conductor.conductor2'=>1)));	
		$conductoresId  = $this->Reempaque->importModel('Conductor')->find('list',array('fields'=>array('Conductor.identificacion'),'conditions'=>array('Conductor.conductor2'=>1)));
		$destinos       = $this->Reempaque->importModel('Destino')->find('list');
		
		$user          = $this->Auth->user();
		$user          = $this->Reempaque->importModel('User')->read(null,$user['id']);
		$ventas        = $this->Reempaque->importModel('Venta')->find('all',array('conditions'=>array('Venta.lista'=>1,'Venta.despachada'=>$user['Oficina']['id'])));
		$ventasL       = array();
		$empaques      = $this->Reempaque->importModel('Empaque')->find('list');
		foreach ($ventas as $key => $value) {
			$ventasL[$value['Venta']['id']] = 'Remesa:'.$value['Venta']['remesa']." || ".$destinos[$value['Venta']['destino']]." || ".$value['Venta']['nombreDest'];
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
			$ventas[$key]['Venta']['destinoN'] = $destinos[$value['Venta']['destino']];
		}

		$this->generateJSON('ventas_reemp', $ventas, array('Venta' => array('id','remesa','barras','nombreDest','direccionDest','destinoN','telefonoDest','cantidad','empaque')));
		$this->set(compact('ventasL','pistola','negociadores','representantes','representanteC','conductoresId','conductores','destinos'));
	}

	public function traslado() {
		if(!empty($this->data)){
			$this->request->data['Reempaque']['fecha'] = date("Y-m-d H:i:s");
			$this->request->data['Reempaque']['guias'] = json_encode($this->data['Reempaque']['guias2']);
			App::import('model', 'Nacional');
        	$nacionalImport = new Nacional();

			if($this->data['Reempaque']['id'] == ''){
				$this->Reempaque->importModel('Nacional')->create();
			}
			$this->request->data['Nacional'] = $this->data['Reempaque'];
			if($nacionalImport->save($this->data)) {
				$this->Reempaque->importModel('Venta')->updateAll(array('Venta.despachada'=>$this->data['Reempaque']['destino']),array('Venta.id'=>$this->data['Reempaque']['guias2']));
    			$this->Session->setFlash('','ok',array('mensaje'=>'El traslado nacional se guardo con exito'));
				$this->redirect(array('controller'=>'nacionales','action' => 'imprimir',$nacionalImport->id));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar el traslado nacional. Por favor intente nuevamente'));
			}
		}
		$this->data = null;
		$negociadores   = $this->Reempaque->importModel('Auxiliar')->find('list');
		$representanteC = $this->Reempaque->importModel('Representante')->find('list',array('fields'=>array('Representante.codigo')));
		$representantes = $this->Reempaque->importModel('Representante')->find('all',array('recursive'=>-1));
		$conductores    = $this->Reempaque->importModel('Conductor')->find('all',array('conditions'=>array('Conductor.conductor2'=>1)));	
		$conductoresId  = $this->Reempaque->importModel('Conductor')->find('list',array('fields'=>array('Conductor.identificacion'),'conditions'=>array('Conductor.conductor2'=>1)));
		$oficinasL      = $this->Reempaque->importModel('Oficina')->find('list');
		$oficinas       = $this->Reempaque->importModel('Oficina')->find('all');
		
		$user          = $this->Auth->user();
		$user          = $this->Reempaque->importModel('User')->read(null,$user['id']);
		$ventas        = $this->Reempaque->importModel('Venta')->find('all',array('conditions'=>array('Venta.lista'=>1,'Venta.despachada'=>$user['Oficina']['id'])));
		$ventasL       = array();
		$empaques      = $this->Reempaque->importModel('Empaque')->find('list');
		foreach ($ventas as $key => $value) {
			$ventasL[$value['Venta']['id']] = 'Remesa:'.$value['Venta']['remesa']." || ".$value['Venta']['destinoNombre']." || ".$value['Venta']['nombreDest'];
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
			$ventas[$key]['Venta']['destinoN'] = $ventas[$key]['Venta']['destinoNombre'];
		}

		$this->generateJSON('ventas', $ventas, array('Venta' => array('id','remesa','nombreDest','direccionDest','destinoN','telefonoDest','cantidad','empaque')));
		$this->set(compact('ventasL','ventas','negociadores','representantes','representanteC','conductoresId','conductores','oficinasL','oficinas'));
	}


	public function getNegociacion($repreId = null) {
		$this->autoRender = false;
		$user          = $this->Auth->user();
		$user          = $this->Reempaque->importModel('User')->read(null,$user['id']);
		$representante = $this->Reempaque->importModel('Representante')->find('first',array('conditions'=>array('Representante.id'=>$repreId)));
		$destinatario  = $this->Reempaque->importModel('Destinatario')->find('first',array('fields'=>array('Destinatario.id'),'conditions'=>array('Destinatario.documento'=>$representante['Representante']['identificacion'])));
		$ventas = $this->Reempaque->importModel('Venta')->find('all',array('conditions'=>array('Venta.despachada'=>$user['Oficina']['id'])));
		
		foreach ($ventas as $key => $value) {
			$empaquesInfo = json_decode($value['Venta']['empaque_info'],true);
			$cantidad = 0;
			$valor    = 0;
			foreach ($empaquesInfo['empaques'] as $key2 => $value2) {
				$cantidadU = floatval($empaquesInfo['cantidad'][$key2]);
				$flag      = true;
				if($flag){
					if($value['Venta']['clase'] == "Especial"){
						$flag2 = true;
						if($value2 == '1'){
							if($representante['Representante']['sobre_espe'] != ""){
								$valor = $valor + (floatval($representante['Representante']['sobre_espe'])*$cantidadU);
								$flag  = false;
								$flag2 = false;
							}
						} else if($value2 == '2'){
							if($representante['Representante']['paquete_espe'] != ""){
								$valor = $valor + (floatval($representante['Representante']['paquete_espe'])*$cantidadU);
								$flag  = false;
								$flag2 = false;
							}
						} else if($value2 == '3'){
							if($representante['Representante']['caja_espe'] != ""){
								$valor = $valor + (floatval($representante['Representante']['caja_espe'])*$cantidadU);
								$flag  = false;
								$flag2 = false;
							}
						}
						if($flag2){
							if($representante['Representante']['base_espe'] != ""){
								$valor = $valor + (floatval($representante['Representante']['base_espe'])*$cantidadU);
								$flag  = false;
							}
						}
					}
				}
				if($flag){
					$negoEmp = $this->Reempaque->importModel('Negociacion')->find('first',array('conditions'=>array('Negociacion.representante'=>$repreId,'Negociacion.clientes'=>$value['Venta']['cliente'])));
					if(!empty($negoEmp)){
						$flag2 = true;
						if($value2 == '1'){
							if($negoEmp['Negociacion']['sobre_clie'] != ""){
								$valor = $valor + (floatval($negoEmp['Negociacion']['sobre_clie'])*$cantidadU);
								$flag  = false;
								$flag2 = false;
							}
						} else if($value2 == '2'){
							if($negoEmp['Negociacion']['paquete_clie'] != ""){
								$valor = $valor + (floatval($negoEmp['Negociacion']['paquete_clie'])*$cantidadU);
								$flag  = false;
								$flag2 = false;
							}
						} else if($value2 == '3'){
							if($negoEmp['Negociacion']['caja_clie'] != ""){
								$valor = $valor + (floatval($negoEmp['Negociacion']['caja_clie'])*$cantidadU);
								$flag  = false;
								$flag2 = false;
							}
						}
						if($flag2){
							$valor = $valor + (floatval($negoEmp['Negociacion']['base_clie'])*$cantidadU);
							$flag  = false;
						}
					}
				}
				if($flag){
					$flag2 = true;
					if($value2 == '1'){
						if($representante['Representante']['sobre'] != ""){
							$valor = $valor + (floatval($representante['Representante']['sobre'])*$cantidadU);
							$flag2 = false;
						}
					} else if($value2 == '2'){
						if($representante['Representante']['paquete'] != ""){
							$valor = $valor + (floatval($representante['Representante']['paquete'])*$cantidadU);
							$flag2 = false;
						}
					} else if($value2 == '3'){
						if($representante['Representante']['caja'] != ""){
							$valor = $valor + (floatval($representante['Representante']['caja'])*$cantidadU);
							$flag2 = false;
						}
					}
					if($flag2){
						$valor = $valor + (floatval($representante['Representante']['base'])*$cantidadU);
					}
				}
				$cantidad = $cantidad + $cantidadU;
			}
			$rangos = json_decode($representante['Representante']['rangos'],true);
			foreach ($rangos['datos'] as $key3 => $value3) {
				if($value3['desde'] <= $cantidad && $cantidad <= $value3['hasta'] ){
					$valor = $valor - ($valor * (floatval($value3['porcentaje'])/100));
				}
			}
			$data[$value['Venta']['id']] = $valor;
		}
		$data['Destinatario'] = $destinatario['Destinatario']['id'];
		return json_encode($data);
	}


	function imprimir($id = null){
		$desti   = $this->Reempaque->importModel('Destino')->find('list');
		$empaq   = $this->Reempaque->importModel('Empaque')->find('list');
		$reemp   = $this->Reempaque->find('first',array('conditions'=>array('Reempaque.id'=>$id)));
		$usuario = $this->Reempaque->importModel('User')->find('first',array('conditions'=>array('User.id'=>$reemp['Reempaque']['usuario'])));
		$negoc   = $this->Reempaque->importModel('Auxiliar')->find('first',array('conditions'=>array('Auxiliar.id'=>$reemp['Reempaque']['negociador'])));
		$repre   = $this->Reempaque->importModel('Representante')->find('first',array('conditions'=>array('Representante.id'=>$reemp['Reempaque']['representante'])));
		$venta   = $this->Reempaque->importModel('Venta')->find('all',array('recursive'=>-1,'conditions'=>array('Venta.id'=>json_decode($reemp['Reempaque']['guias'],true))));
		$reemp['Reempaque']['destino'] = $desti[$reemp['Reempaque']['destino']];
		$reemp['Reempaque']['origen']  = $desti[$reemp['Reempaque']['origen']];
		$reemp['Reempaque']['valor']   = number_format($reemp['Reempaque']['valor'], 0, '.', ',');
		
		$usuario = $usuario['User']['listNombre'];
		$valores = json_decode($reemp['Reempaque']['valores'],true);
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
			$oficinaB                = $this->Reempaque->importModel('Oficina')->find('first',array('recursive'=>-1,'fields'=>array('nombre','hasta','desde','resolucion','prefijo','codigo'),'conditions'=>array('Oficina.id'=>$value['Venta']['oficina'])));
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
			$destinatarioB         = $this->Reempaque->importModel('Destinatario')->read(null,$value['Venta']['destinatario']);
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

			$usuarioB = $this->Reempaque->importModel('User')->read(null,$value['Venta']['usuario']);
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

		$this->set(compact('envio','id','repre','reemp','negoc','venta','usuario','cantTotal'));
	}

	private function trazPrivada($id = null) {
		if($id != null){
			$empaques                        = $this->Reempaque->importModel('Empaque')->find('list');
			$destinos                        = $this->Reempaque->importModel('Destino')->find('list');
			$reempaque                       = $this->Reempaque->find('first',array('recursive'=>'-1','conditions'=>array('Reempaque.id'=>$id)));
			$negociador                      = $this->Reempaque->importModel('Auxiliar')->find('first',array('conditions'=>array('Auxiliar.id'=>$reempaque['Reempaque']['negociador'])));
			$representante                   = $this->Reempaque->importModel('Representante')->find('first',array('conditions'=>array('Representante.id'=>$reempaque['Reempaque']['representante'])));
			$ventas                          = $this->Reempaque->importModel('Venta')->find('all',array('conditions'=>array('Venta.id'=>json_decode($reempaque['Reempaque']['guias'],true))));
			$reempaque['Reempaque']['nego']  = $negociador['Auxiliar']['nombre'];
			$reempaque['Reempaque']['repre'] = $representante['Representante']['listNombre'];
			$reempaque['Reempaque']['cod']   = $representante['Representante']['codigo'];
			$reempaque['Reempaque']['ced']   = $representante['Representante']['identificacion'];
			$reempaque['Reempaque']['dir']   = $representante['Representante']['direccion'];
			$reempaque['Reempaque']['tel']   = $representante['Representante']['telefono1'];
			$reempaque['Reempaque']['cel']   = $representante['Representante']['celular'];
			$reempaque['Reempaque']['dest']  = $destinos[$reempaque['Reempaque']['destino']];
			$reempaque['Reempaque']['orig']  = $destinos[$reempaque['Reempaque']['origen']];
			$linkT                           = Router::url(array('controller'=>'ventas', 'action'=>'trazabilidad'), false);
			$guiaReemp                       = $this->Reempaque->importModel('Venta')->getGuiaReemp($id);
			$trazVenta                       = $this->Reempaque->importModel('Venta')->trazabilidad($guiaReemp['Venta']['id']);
			$html2                           = $trazVenta['Venta']['html2'];
			$html2                           = $html2.'<table class="table"><thead><tr><th>Remesa</th><th>Destinatario</th><th>Dirección</th><th>Destino</th><th>Empaques</th><th>Cantidad</th></tr></thead><tbody>';
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
				$html2 = $html2.'<tr><td><a class="btn btn-info" target="_blank" href="'.$linkT.'/'.$value['Venta']['id'].'">'.$value['Venta']['remesa'].'</a></td><td>'.$value['Venta']['nombreDest'].'</td><td>'.$value['Venta']['direccionDest'].'</td><td>'.$value['Venta']['destinoNombre'].'</td><td>'.$empa.'</td><td>'.$cant.'</td></tr>';
			}
			$reempaque['Reempaque']['html2']  = $html2.'</tboby></table>';
		} else {
			$reempaque = "";
		}
		return $reempaque;
	}
	public function trazabilidad($id = null) {
		$reempaque = $this->trazPrivada($id);
		$this->set(compact('reempaque'));
	}

	public function trazabilidad2($id = null) {
		$this->autoRender = false;
		$reempaque = $this->trazPrivada($id);
		return json_encode($reempaque);
	}
}
?>

<?php
class VentasRepreController extends AppController {
	public $name = 'VentaRepre';

	public function crear() {
		$user   = $this->Auth->user();
		$user   = $this->VentaRepre->importModel('User')->read(null,$user['id']);
		$rem    = $this->VentaRepre->importModel('Venta')->find('first', array('order' => array('Venta.id' =>'desc'),'fields'=>'Venta.id'));
		$remesa = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($rem['Venta']['id'])+1);
	
		if(!empty($this->data)){
			$this->request->data['VentaRepre']['fecha'] = date("Y-m-d");
			$this->request->data['VentaRepre']['hora']  = date("H:i:s");
			$empaqueInfo = array();
			$user         = $this->Auth->user();
			$user         = $this->VentaRepre->importModel('User')->read(null,$user['id']);
			$this->request->data['VentaRepre']['despachada'] = $user['Oficina']['id'];
			$this->request->data['VentaRepre']['clase'] = 'Contado';
			$empaqueInfo['empaques'] = $this->data['VentaRepre']['empaques'];
			$empaqueInfo['barras']      = $this->data['VentaRepre']['cbarras'];
			$empaqueInfo['descripcion'] = $this->data['VentaRepre']['descripcion'];
			$empaqueInfo['cantidad'] = $this->data['VentaRepre']['cantidad'];
			$empaqueInfo['largo']    = $this->data['VentaRepre']['largo'];
			$empaqueInfo['ancho']    = $this->data['VentaRepre']['ancho'];
			$empaqueInfo['alto']     = $this->data['VentaRepre']['alto'];
			$empaqueInfo['peso']     = $this->data['VentaRepre']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['VentaRepre']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['VentaRepre']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['VentaRepre']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['VentaRepre']['subtotal'];
			$this->request->data['VentaRepre']['empaque_info'] = json_encode($empaqueInfo);

			
			$this->request->data['VentaRepre']['facturacion'] = '';
			$this->request->data['VentaRepre']['remesa'] = $remesa;

			$this->request->data['Venta'] = $this->data['VentaRepre'];

			App::import('model', 'Venta');
        	$ventaImport = new Venta();
			if($ventaImport->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La venta se guardo con exito.'));
    			if($user['User']['oficina_id'] != 7){
					$this->request->data['Venta']['guia_id'] = $ventaImport->id;
					$this->request->data['Venta']['fecha']   = $this->data['Venta']['fecha'].' '.$this->data['Venta']['hora'];
    				if($this->data['Venta']['checkNatural'] == 1){
    					$this->request->data['Venta']['tipo'] = 'Natural';
    				} else {
						$this->request->data['Venta']['tipo']           = 'Juridica';
    					$repre = $this->VentaRepre->importModel('Representante')->read(null,$this->data['Venta']['recaudador']);
						$this->request->data['Venta']['negociador']     = $repre['Representante']['identificacion'];
						$this->request->data['Venta']['negociador_nom'] = $repre['Representante']['listNombre'];
    				}
    				App::import('model', 'Recibo');
        			$reciboImport = new Recibo();
					$recibo['Recibo']            = $this->data['Venta'];
					$recibo['Recibo']['destino'] = $this->data['Venta']['destino_recibo'];
					$recibo['Recibo']['fecha']   = date("Y-m-d H:i:s");
    				$reciboImport->save($recibo);
    			}
				$Remite     = $this->data['VentaRepre']['checkRemitente'];
				$Archiv     = $this->data['VentaRepre']['checkArchivo'];
				$Destin     = $this->data['VentaRepre']['checkDestinatario'];
				$Prueba     = $this->data['VentaRepre']['checkPrueba'];
				$ReciboRemi = $this->data['VentaRepre']['checkImpRemitente'];
				$ReciboArch = $this->data['VentaRepre']['checkImpArchivo'];
				$this->redirect(array('action' => 'imprimir',$ventaImport->id,$Remite,$Archiv,$Destin,$Prueba,$reciboImport->id,$ReciboRemi,$ReciboArch));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La venta no se puedo guardar.'));
			}
		}
		
		$tipo           = $this->VentaRepre->getEnumValues('tipo');
		$firmado        = $this->VentaRepre->getEnumValues('firmado');
		$destinos       = $this->VentaRepre->importModel('Destino')->find('list');
		$empaques       = $this->VentaRepre->importModel('Empaque')->find('list');
		
		$clientes       = $this->VentaRepre->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clientesD      = $this->VentaRepre->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'conditions'=>array('Cliente.id >'=>1)));
		
		$remitentes     = $this->VentaRepre->importModel('Remitente')->find('all',array('recursive'=>-1));
		$remitentesD    = $this->VentaRepre->importModel('Remitente')->find('list',array('fields'=>array('Remitente.documento')));
		
		$destinatarios  = $this->VentaRepre->importModel('Destinatario')->find('all',array('recursive'=>-1));
		$destinatariosD = $this->VentaRepre->importModel('Destinatario')->find('list',array('fields'=>array('Destinatario.documento')));
		

		$remitentesN = array();
		foreach ($remitentes as $key => $value) {
			$remitentesN[$value['Remitente']['id']] = $value;
		}
		$remitentes = $remitentesN;

		$destinatariosN = array();
		foreach ($destinatarios as $key => $value) {
			$desN = json_decode($destinatarios[$key]['Destinatario']['destinos'],true);
			foreach ($desN as $key2 => $value2) {
				$destinatariosN[$value2][] = $destinatarios[$key]['Destinatario']['id'];
			}
		}
		foreach ($clientes as $key => $value) {
			/*
			$remitentesId = json_decode($value['Cliente']['remitentes'],true);
			$temp = array();
			$temp['id']    = $value['Cliente']['id'];
			$temp['value'] = $value['Cliente']['documento'];
			foreach ($remitentesId as $idR) {
				$temp['SubData'][$idR] = $remitentesD[$idR];
			}
			$selectDep[] = $temp;
			*/
			$clientes[$key]['Cliente']['remitentes'] = json_decode($value['Cliente']['remitentes'],true);
		}
		$transportadoras = $this->VentaRepre->importModel('Transportadora')->find('all',array('recursive'=>-1,'fields'=>array('Transportadora.nit','Transportadora.razon','Transportadora.credito')));
		$vehiculos       = $this->VentaRepre->importModel('Vehiculo')->find('list');
		$vehiculos       = array_values($vehiculos);
		$conductores     = $this->VentaRepre->importModel('Conductor')->find('all',array('recursive'=>-1,'fields'=>array('Conductor.identificacion','Conductor.listNombre'),'conditions'=>array('Conductor.conductor2'=>'1')));
		$forma           = $this->VentaRepre->importModel('Recibo')->getEnumValues('forma_pago');
		$ingresos  = $this->VentaRepre->importModel('Ingreso')->find('list',array('fields'=>array('Ingreso.barras','Ingreso.cliente'),'conditions'=>array('Ingreso.estado'=>0)));

		$this->set(compact('ingresos','transportadoras','forma','conductores','vehiculos','selectDep','facturacion','remesa','destinos','empaques','firmado','tipo','clientes','clientesD','remitentes','remitentesD','destinatarios','destinatariosD','destinatariosN'));
	}
	public function pedido() {
		if(!empty($this->data)){
			$this->request->data['VentaRepre']['fecha'] = date("Y-m-d");
			$this->request->data['VentaRepre']['hora']  = date("H:i:s");
			$empaqueInfo = array();
			$user         = $this->Auth->user();
			$user         = $this->VentaRepre->importModel('User')->read(null,$user['id']);
			$this->request->data['VentaRepre']['despachada'] = $user['Oficina']['id'];
			$this->request->data['VentaRepre']['clase'] = 'Contado';
			$empaqueInfo['empaques'] = $this->data['VentaRepre']['empaques'];
			$empaqueInfo['cantidad'] = $this->data['VentaRepre']['cantidad'];
			$empaqueInfo['largo']    = $this->data['VentaRepre']['largo'];
			$empaqueInfo['ancho']    = $this->data['VentaRepre']['ancho'];
			$empaqueInfo['alto']     = $this->data['VentaRepre']['alto'];
			$empaqueInfo['peso']     = $this->data['VentaRepre']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['VentaRepre']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['VentaRepre']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['VentaRepre']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['VentaRepre']['subtotal'];
			$this->request->data['VentaRepre']['empaque_info'] = json_encode($empaqueInfo);

			$user           = $this->Auth->user();
			$user           = $this->VentaRepre->importModel('User')->read(null,$user['id']);
			$remesa         = $user['Oficina']['codigo'].$user['User']['codigo'].floatval($user['Oficina']['consecutivo']);
			
			$this->request->data['VentaRepre']['facturacion'] = '';
			$this->request->data['VentaRepre']['remesa']      = $remesa; 
			$this->request->data['Venta'] = $this->data['VentaRepre'];

			if($this->VentaRepre->importModel('Venta')->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La venta se guardo con exito.'));
				$Remite = $this->data['VentaRepre']['checkRemitente'];
				$Archiv = $this->data['VentaRepre']['checkArchivo'];
				$Destin = $this->data['VentaRepre']['checkDestinatario'];
				$Prueba = $this->data['VentaRepre']['checkPrueba'];
				$this->redirect(array('action' => 'imprimir',$this->VentaRepre->id,$Remite,$Archiv,$Destin,$Prueba));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La venta no se puedo guardar.'));
			}
		}
		$user           = $this->Auth->user();
		$user           = $this->VentaRepre->importModel('User')->read(null,$user['id']);
		$facturacion    = $user['Oficina']['prefijo'].'-'.(floatval($user['Oficina']['desde'])+floatval($user['Oficina']['consecutivo']));
		$remesa         = $user['Oficina']['codigo'].$user['User']['codigo'].floatval($user['Oficina']['consecutivo']);
		$tipo           = $this->VentaRepre->getEnumValues('tipo');
		$firmado        = $this->VentaRepre->getEnumValues('firmado');
		$destinos       = $this->VentaRepre->importModel('Destino')->find('list');
		$empaques       = $this->VentaRepre->importModel('Empaque')->find('list');
		
		$clientes       = $this->VentaRepre->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clientesD      = $this->VentaRepre->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'conditions'=>array('Cliente.id >'=>1)));
		
		$remitentes     = $this->VentaRepre->importModel('Remitente')->find('all',array('recursive'=>-1));
		$remitentesD    = $this->VentaRepre->importModel('Remitente')->find('list',array('fields'=>array('Remitente.documento')));
		
		$destinatarios  = $this->VentaRepre->importModel('Destinatario')->find('all',array('recursive'=>-1));
		$destinatariosD = $this->VentaRepre->importModel('Destinatario')->find('list',array('fields'=>array('Destinatario.documento')));
		

		$remitentesN = array();
		foreach ($remitentes as $key => $value) {
			$remitentesN[$value['Remitente']['id']] = $value;
		}
		$remitentes = $remitentesN;

		$destinatariosN = array();
		foreach ($destinatarios as $key => $value) {
			$desN = json_decode($destinatarios[$key]['Destinatario']['destinos'],true);
			foreach ($desN as $key2 => $value2) {
				$destinatariosN[$value2][] = $destinatarios[$key]['Destinatario']['id'];
			}
		}
		foreach ($clientes as $key => $value) {
			/*
			$remitentesId = json_decode($value['Cliente']['remitentes'],true);
			$temp = array();
			$temp['id']    = $value['Cliente']['id'];
			$temp['value'] = $value['Cliente']['documento'];
			foreach ($remitentesId as $idR) {
				$temp['SubData'][$idR] = $remitentesD[$idR];
			}
			$selectDep[] = $temp;
			*/
			$clientes[$key]['Cliente']['remitentes'] = json_decode($value['Cliente']['remitentes'],true);
		}
		
		$this->set(compact('selectDep','facturacion','remesa','destinos','empaques','firmado','tipo','clientes','clientesD','remitentes','remitentesD','destinatarios','destinatariosD','destinatariosN'));
	}

	public function getTarifa($cliente = null,$origen = null, $destino = null) {
		$this->autoRender = false;
		$tarifas   = array();
		$convenios = array();
		if(!empty($cliente) && !empty($origen) && !empty($destino)){
			$tarifas    = $this->VentaRepre->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
			$convenios  = $this->VentaRepre->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
			if($cliente != 1){
				$tarifasB   = $this->VentaRepre->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>1)));
				$conveniosB = $this->VentaRepre->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>1)));
			} else {
				$tarifasB   = $tarifas;
				$conveniosB = $convenios;
			}
		}
		$repreList = array();
		$representantes = $this->VentaRepre->importModel("Representantexdestino")->find('all',array('recursive'=>0,'conditions'=>array('Representantexdestino.destino_id'=>$origen)));
		foreach ($representantes as $key => $value) {
			$repreList[$value['Representante']['id']]  = $value['Representante']['identificacion'].' - '.$value['Representante']['listNombre'];
		}
		$data['Representante']    = $repreList;
		$data['TarifaBase']       = $tarifasB;
		$data['ConvenioBase']     = $conveniosB;
		$data['Tarifa']           = $tarifas;
		$data['Convenio']         = $convenios;
		return json_encode($data);
	}




	function imprimir($id = null, $Remite = null, $Archiv = null, $Destin = null, $Prueba = null, $ReciboId = null, $ReciboRemi = null,  $ReciboArch = null){
		$venta = $this->VentaRepre->importModel('Venta')->read(null,$id);
		if($ReciboId != null){
			$recibo                         = $this->VentaRepre->importModel('Recibo')->read(null,$ReciboId);
			$envio['reciboInfo']            = $recibo['Recibo'];
			$destinoB                       = $this->VentaRepre->importModel('Destino')->read(null,$recibo['Recibo']['destino']);
			$envio['reciboInfo']['destino'] = $destinoB['Destino']['nombre'];
			$usuarioB = $this->VentaRepre->importModel('User')->read(null,$recibo['Recibo']['usuario']);
			$envio['reciboInfo']['user'] = $usuarioB['User']['listNombre'];

			if($ReciboRemi == '1'){
				$envio['recibo'][] = '**REMITENTE**';
			}
			if($ReciboArch == '1'){
				$envio['recibo'][] = '**ARCHIVO**';
			}
		}
		
		if($Remite == '1'){
			$envio['hoja'][] = '**REMITENTE**';
		}
		if($Archiv == '1'){
			$envio['hoja'][] = '**ARCHIVO**';
		}
		if($Destin == '1'){
			$envio['hoja'][] = '**DESTINATARIO**';
		}
		if($Prueba == '1'){
			$envio['hoja'][] = '**PRUEBA DE ENTREGA**';
		}
		$envio['n']            = count($envio['hoja']);
		$envio['guia']         = $venta['Venta']['remesa'];
		$envio['contactoR']    = $venta['Venta']['contacto'];
		$envio['contactoTelR'] = $venta['Venta']['contacto_tel'];
		$oficinaB              = $this->VentaRepre->importModel('Oficina')->find('first',array('recursive'=>-1,'fields'=>array('nombre','hasta','desde','resolucion','prefijo','codigo'),'conditions'=>array('Oficina.id'=>$venta['Venta']['oficina'])));
		$envio['oficina']      = $oficinaB['Oficina']['nombre'];
		$envio['resolucion']   = 'Res. '.$oficinaB['Oficina']['resolucion'].' Autoriza del: '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['desde'].' al '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['hasta'];
		$envio['fecha']        = $venta['Venta']['fecha'];
		$envio['vence']        = $venta['Venta']['fecha'];
		$envio['factura']      = $venta['Venta']['facturacion'];
		$envio['servicio']     = 'Envío de Encomiendas';
		$envio['docRef']       = $venta['Venta']['tipo'].' '.$venta['Venta']['documento1'].' '.$venta['Venta']['documento2'].' '.$venta['Venta']['documento3'];
		$envio['hora']         = $venta['Venta']['hora'];
		$envio['cliente']      = $venta['Venta']['nombreClien'];
		$envio['nit']          = $venta['Venta']['documentoClien'];
		$envio['direccionC']   = $venta['Venta']['direccionClien'];
		$envio['telefonoC']    = $venta['Venta']['telefonoClien'];
		$envio['otro_remi']    = $venta['Venta']['otro_remi'];
		if($venta['Venta']['otro_remi'] == 0){
			$envio['otro_remi']  = false;
			$envio['remitente']  = "";
			$envio['nitR']       = "";
			$envio['direccionR'] = "";
			$envio['telefonoR']  = "";
		} else {
			$envio['otro_remi']  = true;
			$envio['remitente']  = $venta['Venta']['nombreRemi'];
			$envio['nitR']       = $venta['Venta']['documentoRemi'];
			$envio['direccionR'] = $venta['Venta']['direccionRemi'];
			$envio['telefonoR']  = $venta['Venta']['telefonoRemi'];		
		}
		
		$origenB               = $this->VentaRepre->importModel('Destino')->read(null,$venta['Venta']['origen']);
		$destinoB              = $this->VentaRepre->importModel('Destino')->read(null,$venta['Venta']['destino']);
		$envio['origen']       = $origenB['Destino']['nombre'];
		$envio['destino']      = $destinoB['Destino']['nombre'];
		$destinatarioB         = $this->VentaRepre->importModel('Destinatario')->read(null,$venta['Venta']['destinatario']);
		$contactoB             = json_decode($destinatarioB['Destinatario']['contacto'],true);
		$envio['destinatario'] = $venta['Venta']['nombreDest'];
		$envio['ced']          = $venta['Venta']['documentoDest'];
		$envio['direccionD']   = $venta['Venta']['direccionDest'];
		$envio['telefonoD1']   = $venta['Venta']['telefonoDest'];
		$envio['telefonoD2']   = $contactoB[0]['telefono'];
		$envio['contacto']     = $contactoB[0]['nombre'];
		$empaques_info         = json_decode($venta['Venta']['empaque_info'],true);
		$empaquesIguales       = true;
		$sumaFlete             = 0;
		$sumaCantidad          = 0;
		$sumaPeso              = 0;
		$sumaAlto              = 0;
		$sumaAncho             = 0;
		$sumaLargo             = 0;
		$sumaPesoVol           = 0;
		$empaqueAct            = $empaques_info['empaques'][0];
		foreach ($empaques_info['empaques'] as $key => $value) {
			$sumaFlete    = $sumaFlete + ($empaques_info['cantidad'][$key]*$empaques_info['valor'][$key]);
			$sumaLargo    = $sumaLargo + $empaques_info['largo'][$key];
			$sumaAncho    = $sumaAncho + $empaques_info['ancho'][$key];
			$sumaAlto     = $sumaAlto + $empaques_info['alto'][$key];
			$sumaPeso     = $sumaPeso + ($empaques_info['cantidad'][$key]*$empaques_info['peso'][$key]);
			$sumaCantidad = $sumaCantidad + $empaques_info['cantidad'][$key];
			$sumaPesoVol  = $sumaPesoVol + ($empaques_info['cantidad'][$key]*(($empaques_info['largo'][$key]/100)*($empaques_info['ancho'][$key]/100)*($empaques_info['alto'][$key]/100)*400));
			
			if(($empaqueAct != $empaques_info['empaques'][$key]) && ($empaquesIguales)){
				$empaquesIguales = false;
			}
		}
		if($empaquesIguales){
			$empaqueB = $this->VentaRepre->importModel('Empaque')->read(null, $empaqueAct);
			$envio['empaque'] = $empaqueB['Empaque']['nombre'];
		} else {
			$envio['empaque'] = 'Otros empaques';
		}
		$envio['cantidad']    = $sumaCantidad;
		$envio['peso']        = $sumaPeso;
		$envio['pesoVol']     = $sumaPesoVol;
		if(count($empaques_info['empaques']) > 1){
			$envio['largo']   = "";
			$envio['ancho']   = "";
			$envio['alto']    = "";
		} else {
			$envio['largo']   = $sumaLargo;
			$envio['ancho']   = $sumaAncho;
			$envio['alto']    = $sumaAlto;
		}

		$envio['barras']      = $venta['Venta']['barras'];
		$envio['observacion'] = $venta['Venta']['observaciones'];
		$envio['contenido']   = $venta['Venta']['contenido'];
		$decla                = str_replace(".",",",str_replace(",","",$venta['Venta']['declarado']));
		$envio['valorDecla']  = number_format(floatval($decla),0,'.',',');
		$envio['valorFlete']  = number_format($sumaFlete,0,'.',',');

		$usuarioB              = $this->VentaRepre->importModel('User')->read(null,$venta['Venta']['usuario']);
		$envio['nombre']       = $usuarioB['User']['name'].' '.$usuarioB['User']['lastname'];
		$envio['formaPago']    = 'CONTADO';
		$envio['kiloAd']       = number_format($venta['Venta']['kilo_adic'],0,'.',',');
		$envio['valorKiloAd']  = number_format($venta['Venta']['valor_kilo_adic'],0,'.',',');
		$envio['descFlete']    = number_format($venta['Venta']['desc_flete'],0,'.',',');
		$envio['descKilo']     = number_format($venta['Venta']['desc_kilo'],0,'.',',');
		$envio['valorFirmado'] = number_format($venta['Venta']['valor_devolucion'],0,'.',',');
		$envio['valorSeguro']  = number_format($venta['Venta']['valor_seguro'],0,'.',',');
		$envio['valorTotal']   = number_format($venta['Venta']['valor_total'],0,'.',',');
		$envio['kiloNegoc']    = $venta['Venta']['kilo_nego'];

		$this->set(compact('envio'));
	//	$this->layout = 'pdf'; 
	//	$this->render(); 
	}


}
?>

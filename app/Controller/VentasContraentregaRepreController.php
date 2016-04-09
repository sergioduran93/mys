<?php
class VentasContraentregaRepreController extends AppController {
	public $name = 'VentaContraentregaRepre';

	public function crear() {
		$this->layout = "red";
		if(!empty($this->data)){
			$this->request->data['VentaContraentregaRepre']['fecha'] = date("Y-m-d");
			$this->request->data['VentaContraentregaRepre']['hora']  = date("H:i:s");
			$empaqueInfo = array();
			$user         = $this->Auth->user();
			$user         = $this->VentaContraentregaRepre->importModel('User')->read(null,$user['id']);
			$this->request->data['VentaContraentregaRepre']['despachada'] = $user['Oficina']['id'];
			$this->request->data['VentaContraentregaRepre']['clase']      = 'Contraentrega';
			$empaqueInfo['empaques'] = $this->data['VentaContraentregaRepre']['empaques'];
			$empaqueInfo['barras']      = $this->data['VentaContraentregaRepre']['cbarras'];
			$empaqueInfo['descripcion'] = $this->data['VentaContraentregaRepre']['descripcion'];
			$empaqueInfo['cantidad'] = $this->data['VentaContraentregaRepre']['cantidad'];
			$empaqueInfo['largo']    = $this->data['VentaContraentregaRepre']['largo'];
			$empaqueInfo['ancho']    = $this->data['VentaContraentregaRepre']['ancho'];
			$empaqueInfo['alto']     = $this->data['VentaContraentregaRepre']['alto'];
			$empaqueInfo['peso']     = $this->data['VentaContraentregaRepre']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['VentaContraentregaRepre']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['VentaContraentregaRepre']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['VentaContraentregaRepre']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['VentaContraentregaRepre']['subtotal'];
			$this->request->data['VentaContraentregaRepre']['empaque_info'] = json_encode($empaqueInfo);

			$user           = $this->Auth->user();
			$user           = $this->VentaContraentregaRepre->importModel('User')->read(null,$user['id']);
			$facturacion    = $user['Oficina']['prefijo'].'-'.(floatval($user['Oficina']['desde'])+floatval($user['Oficina']['consecutivo']));
			$remesa         = $user['Oficina']['codigo'].$user['User']['codigo'].floatval($user['Oficina']['consecutivo']);
			
			$this->request->data['VentaContraentregaRepre']['facturacion'] = "";
			$this->request->data['VentaContraentregaRepre']['remesa']      = $remesa; 
			$this->request->data['Venta'] = $this->data['VentaContraentregaRepre'];

			App::import('model', 'Venta');
        	$ventaImport = new Venta();

			if($ventaImport->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La venta se guardo con exito.'));
				$Remite = $this->data['VentaContraentrega']['checkRemitente'];
				$Archiv = $this->data['VentaContraentrega']['checkArchivo'];
				$Destin = $this->data['VentaContraentrega']['checkDestinatario'];
				$Prueba = $this->data['VentaContraentrega']['checkPrueba'];
				$this->redirect(array('controller'=>'ventascontraentrega','action' => 'imprimir',$ventaImport->id,$Remite,$Archiv,$Destin,$Prueba));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La venta no se puedo guardar.'));
			}
		}
		$user           = $this->Auth->user();
		$user           = $this->VentaContraentregaRepre->importModel('User')->read(null,$user['id']);
		$facturacion    = $user['Oficina']['prefijo'].'-'.(floatval($user['Oficina']['desde'])+floatval($user['Oficina']['consecutivo']));
		$remesa         = $user['Oficina']['codigo'].$user['User']['codigo'].floatval($user['Oficina']['consecutivo']);
		$tipo           = $this->VentaContraentregaRepre->getEnumValues('tipo');
		$firmado        = $this->VentaContraentregaRepre->getEnumValues('firmado');
		$destinos       = $this->VentaContraentregaRepre->importModel('Destino')->find('list');
		$empaques       = $this->VentaContraentregaRepre->importModel('Empaque')->find('list');
		
		$clientes       = $this->VentaContraentregaRepre->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clientesD      = $this->VentaContraentregaRepre->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'conditions'=>array('Cliente.id >'=>1)));
		
		$remitentes     = $this->VentaContraentregaRepre->importModel('Remitente')->find('all',array('recursive'=>-1));
		$remitentesD    = $this->VentaContraentregaRepre->importModel('Remitente')->find('list',array('fields'=>array('Remitente.documento')));
		
		$destinatarios  = $this->VentaContraentregaRepre->importModel('Destinatario')->find('all',array('recursive'=>-1));
		$destinatariosD = $this->VentaContraentregaRepre->importModel('Destinatario')->find('list',array('fields'=>array('Destinatario.documento')));
		

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
		$ingresos  = $this->VentaContraentregaRepre->importModel('Ingreso')->find('list',array('fields'=>array('Ingreso.barras','Ingreso.cliente'),'conditions'=>array('Ingreso.estado'=>0)));
		
		$this->set(compact('ingresos','selectDep','facturacion','remesa','destinos','empaques','firmado','tipo','clientes','clientesD','remitentes','remitentesD','destinatarios','destinatariosD','destinatariosN'));
	}

	public function getTarifa($cliente = null,$origen = null, $destino = null) {
		$this->autoRender = false;
		$tarifas   = array();
		$convenios = array();
		if(!empty($cliente) && !empty($origen) && !empty($destino)){
			$tarifas    = $this->VentaContraentregaRepre->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
			$convenios  = $this->VentaContraentregaRepre->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
			if($cliente != 1){
				$tarifasB   = $this->VentaContraentregaRepre->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>1)));
				$conveniosB = $this->VentaContraentregaRepre->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>1)));
			} else {
				$tarifasB   = $tarifas;
				$conveniosB = $convenios;
			}
		}
		$representantes = array();
		$reca         = $this->VentaContraentregaRepre->importModel("Representantexdestino")->find('all',array('conditions'=>array('Representantexdestino.destino_id'=>$destino)));
		foreach ($reca as $key => $value) {
			$representantes[$value['Representante']['id']] = $value['Representante']['identificacion'].' - '.$value['Representante']['listNombre'];
		}
		$data['Representante'] = $representantes;
		$data['TarifaBase']    = $tarifasB;
		$data['ConvenioBase']  = $conveniosB;
		$data['Tarifa']        = $tarifas;
		$data['Convenio']      = $convenios;
		return json_encode($data);
	}


	function imprimir($id = null, $Remite = null, $Archiv = null, $Destin = null, $Prueba = null){
		$venta               = $this->VentaContraentregaRepre->read(null,$id);
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
		$envio['guia']         = $venta['VentaContraentregaRepre']['remesa'];
		$oficinaB              = $this->VentaContraentregaRepre->importModel('Oficina')->find('first',array('recursive'=>-1,'fields'=>array('nombre','hasta','desde','resolucion','prefijo','codigo'),'conditions'=>array('Oficina.id'=>$venta['VentaContraentregaRepre']['oficina'])));
		$envio['oficina']      = $oficinaB['Oficina']['nombre'];
		$envio['resolucion']   = 'Res. '.$oficinaB['Oficina']['resolucion'].' Autoriza del: '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['desde'].' al '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['hasta'];
		$envio['fecha']        = $venta['VentaContraentregaRepre']['fecha'];
		$envio['vence']        = $venta['VentaContraentregaRepre']['fecha'];
		$envio['factura']      = $venta['VentaContraentregaRepre']['facturacion'];
		$envio['servicio']     = 'Envío de Encomiendas';
		$envio['docRef']       = $venta['VentaContraentregaRepre']['tipo'].' '.$venta['VentaContraentregaRepre']['documento1'];
		$envio['hora']         = $venta['VentaContraentregaRepre']['hora'];
		$envio['cliente']      = $venta['VentaContraentregaRepre']['nombreClien'];
		$envio['nit']          = $venta['VentaContraentregaRepre']['documentoClien'];
		$envio['direccionC']   = $venta['VentaContraentregaRepre']['direccionClien'];
		$envio['telefonoC']    = $venta['VentaContraentregaRepre']['telefonoClien'];
		$envio['otro_remi']    = $venta['VentaContraentregaRepre']['otro_remi'];
		if($venta['VentaContraentregaRepre']['otro_remi'] == 0){
			$envio['otro_remi']  = false;
			$envio['remitente']  = "";
			$envio['nitR']       = "";
			$envio['direccionR'] = "";
			$envio['telefonoR']  = "";
		} else {
			$envio['otro_remi']  = true;
			$envio['remitente']  = $venta['VentaContraentregaRepre']['nombreRemi'];
			$envio['nitR']       = $venta['VentaContraentregaRepre']['documentoRemi'];
			$envio['direccionR'] = $venta['VentaContraentregaRepre']['direccionRemi'];
			$envio['telefonoR']  = $venta['VentaContraentregaRepre']['telefonoRemi'];		
		}
		
		$origenB               = $this->VentaContraentregaRepre->importModel('Destino')->read(null,$venta['VentaContraentregaRepre']['origen']);
		$destinoB              = $this->VentaContraentregaRepre->importModel('Destino')->read(null,$venta['VentaContraentregaRepre']['destino']);
		$envio['origen']       = $origenB['Destino']['nombre'];
		$envio['destino']      = $destinoB['Destino']['nombre'];
		$destinatarioB         = $this->VentaContraentregaRepre->importModel('Destinatario')->read(null,$venta['VentaContraentregaRepre']['destinatario']);
		$contactoB             = json_decode($destinatarioB['Destinatario']['contacto'],true);
		$envio['destinatario'] = $venta['VentaContraentregaRepre']['nombreDest'];
		$envio['ced']          = $venta['VentaContraentregaRepre']['documentoDest'];
		$envio['direccionD']   = $venta['VentaContraentregaRepre']['direccionDest'];
		$envio['telefonoD1']   = $venta['VentaContraentregaRepre']['telefonoDest'];
		$envio['telefonoD2']   = $venta['VentaContraentregaRepre']['telefono2Dest'];
		$envio['contacto']     = $contactoB[0]['nombre'];
		$empaques_info         = json_decode($venta['VentaContraentregaRepre']['empaque_info'],true);
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
			$empaqueB = $this->VentaContraentregaRepre->importModel('Empaque')->read(null, $empaqueAct);
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

		$envio['barras']      = $venta['VentaContraentregaRepre']['barras'];
		$envio['observacion'] = $venta['VentaContraentregaRepre']['observaciones'];
		$envio['contenido']   = $venta['VentaContraentregaRepre']['contenido'];
		$decla = str_replace(".",",",str_replace(",","",$venta['VentaContraentregaRepre']['declarado']));
		$envio['valorDecla']  = number_format(floatval($decla),0,'.',',');
		$envio['valorFlete']  = number_format($sumaFlete,0,'.',',');

		$usuarioB = $this->VentaContraentregaRepre->importModel('User')->read(null,$venta['VentaContraentregaRepre']['usuario']);
		$envio['nombre']       = $usuarioB['User']['name'].' '.$usuarioB['User']['lastname'];
		$envio['formaPago']    = 'CONTADO';
		$envio['kiloAd']       = number_format($venta['VentaContraentregaRepre']['kilo_adic'],0,'.',',');
		$envio['valorKiloAd']  = number_format($venta['VentaContraentregaRepre']['valor_kilo_adic'],0,'.',',');
		$envio['descFlete']    = number_format($venta['VentaContraentregaRepre']['desc_flete'],0,'.',',');
		$envio['descKilo']     = number_format($venta['VentaContraentregaRepre']['desc_kilo'],0,'.',',');
		$envio['valorFirmado'] = number_format($venta['VentaContraentregaRepre']['valor_devolucion'],0,'.',',');
		$envio['valorSeguro']  = number_format($venta['VentaContraentregaRepre']['valor_seguro'],0,'.',',');
		$envio['valorTotal']   = number_format($venta['VentaContraentregaRepre']['valor_total'],0,'.',',');
		$envio['kiloNegoc']    = $venta['VentaContraentregaRepre']['kilo_nego'];

		$this->set(compact('envio'));
	//	$this->layout = 'pdf'; 
	//	$this->render(); 
	}


}
?>

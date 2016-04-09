<?php
class VentasCredicontadoRepreController extends AppController {
	public $name = 'VentaCredicontadoRepre';

	public function crear() {
		if(!empty($this->data)){
			$this->request->data['VentaCredicontadoRepre']['fecha'] = date("Y-m-d");
			$this->request->data['VentaCredicontadoRepre']['hora']  = date("H:i:s");
			$empaqueInfo = array();
			$user         = $this->Auth->user();
			$user         = $this->VentaCredicontadoRepre->importModel('User')->read(null,$user['id']);
			$this->request->data['VentaCredicontadoRepre']['despachada'] = $user['Oficina']['id'];
			$this->request->data['VentaCredicontadoRepre']['clase']      = 'Credicontado';
			$empaqueInfo['empaques'] = $this->data['VentaCredicontadoRepre']['empaques'];
			$empaqueInfo['descripcion'] = $this->data['Venta']['descripcion'];
			$empaqueInfo['cantidad'] = $this->data['VentaCredicontadoRepre']['cantidad'];
			$empaqueInfo['largo']    = $this->data['VentaCredicontadoRepre']['largo'];
			$empaqueInfo['ancho']    = $this->data['VentaCredicontadoRepre']['ancho'];
			$empaqueInfo['alto']     = $this->data['VentaCredicontadoRepre']['alto'];
			$empaqueInfo['peso']     = $this->data['VentaCredicontadoRepre']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['VentaCredicontadoRepre']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['VentaCredicontadoRepre']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['VentaCredicontadoRepre']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['VentaCredicontadoRepre']['subtotal'];
			$this->request->data['VentaCredicontadoRepre']['empaque_info'] = json_encode($empaqueInfo);

			$user           = $this->Auth->user();
			$user           = $this->VentaCredicontadoRepre->importModel('User')->read(null,$user['id']);
			$facturacion    = $user['Oficina']['prefijo'].'-'.(floatval($user['Oficina']['desde'])+floatval($user['Oficina']['consecutivo']));
			$remesa         = $user['Oficina']['codigo'].$user['User']['codigo'].floatval($user['Oficina']['consecutivo']);
			
			$this->request->data['VentaCredicontadoRepre']['facturacion'] = $facturacion;
			$this->request->data['VentaCredicontadoRepre']['remesa']      = $remesa; 
			$this->request->data['Venta'] = $this->data['VentaCredicontadoRepre'];
			App::import('model', 'Venta');
        	$ventaImport = new Venta();

			if($ventaImport->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La VentaCredicontadoRepre se guardo con exito.'));
    			$ofi = $this->VentaCredicontadoRepre->importModel('Oficina')->read(null,$this->data['VentaCredicontadoRepre']['oficina']);
    			$ofi['Oficina']['consecutivo'] = floatval($ofi['Oficina']['consecutivo']) + 1;
    			$this->VentaCredicontadoRepre->importModel('Oficina')->save($ofi);
				$Remite = $this->data['VentaCredicontadoRepre']['checkRemitente'];
				$Archiv = $this->data['VentaCredicontadoRepre']['checkArchivo'];
				$Destin = $this->data['VentaCredicontadoRepre']['checkDestinatario'];
				$Prueba = $this->data['VentaCredicontadoRepre']['checkPrueba'];
				$this->redirect(array('action' => 'imprimir',$ventaImport->id,$Remite,$Archiv,$Destin,$Prueba));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La VentaCredicontadoRepre no se puedo guardar.'));
			}
		}
		$user           = $this->Auth->user();
		$user           = $this->VentaCredicontadoRepre->importModel('User')->read(null,$user['id']);
		$facturacion    = $user['Oficina']['prefijo'].'-'.(floatval($user['Oficina']['desde'])+floatval($user['Oficina']['consecutivo']));
		$remesa         = $user['Oficina']['codigo'].$user['User']['codigo'].floatval($user['Oficina']['consecutivo']);
		$tipo           = $this->VentaCredicontadoRepre->getEnumValues('tipo');
		$firmado        = $this->VentaCredicontadoRepre->getEnumValues('firmado');
		$destinos       = $this->VentaCredicontadoRepre->importModel('Destino')->find('list');
		$empaques       = $this->VentaCredicontadoRepre->importModel('Empaque')->find('list');
		
		$clientes       = $this->VentaCredicontadoRepre->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clientesD      = $this->VentaCredicontadoRepre->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'conditions'=>array('Cliente.id >'=>1)));
		
		$remitentes     = $this->VentaCredicontadoRepre->importModel('Remitente')->find('all',array('recursive'=>-1));
		$remitentesD    = $this->VentaCredicontadoRepre->importModel('Remitente')->find('list',array('fields'=>array('Remitente.documento')));
		
		$destinatarios  = $this->VentaCredicontadoRepre->importModel('Destinatario')->find('all',array('recursive'=>-1));
		$destinatariosD = $this->VentaCredicontadoRepre->importModel('Destinatario')->find('list',array('fields'=>array('Destinatario.documento')));
		

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
		$this->log($cliente.'-'.$origen.'-'.$destino);
		$this->autoRender = false;
		$tarifas   = array();
		$convenios = array();
		if(!empty($cliente) && !empty($origen) && !empty($destino)){
			$tarifas    = $this->VentaCredicontadoRepre->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
			$convenios  = $this->VentaCredicontadoRepre->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
			if($cliente != 1){
				$tarifasB   = $this->VentaCredicontadoRepre->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>1)));
				$conveniosB = $this->VentaCredicontadoRepre->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>1)));
			} else {
				$tarifasB   = $tarifas;
				$conveniosB = $convenios;
			}
		}
		$data['TarifaBase']   = $tarifasB;
		$data['ConvenioBase'] = $conveniosB;
		$data['Tarifa']       = $tarifas;
		$data['Convenio']     = $convenios;
		$representante            = $this->VentaCredicontadoRepre->importModel("Representantexdestino")->find('first',array('recursive'=>0,'conditions'=>array('Representantexdestino.destino_id'=>$destino)));
		$data['Representante']    = $representante['Representante']['identificacion'].' - '.$representante['Representante']['listNombre'];
		$data['Representante_id'] = $representante['Representante']['id'];
		return json_encode($data);
	}




	function imprimir($id = null, $Remite = null, $Archiv = null, $Destin = null, $Prueba = null){
		$VentaCredicontadoRepre               = $this->VentaCredicontadoRepre->read(null,$id);
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
		$envio['guia']         = $VentaCredicontadoRepre['VentaCredicontadoRepre']['remesa'];
		$oficinaB              = $this->VentaCredicontadoRepre->importModel('Oficina')->find('first',array('recursive'=>-1,'fields'=>array('nombre','hasta','desde','resolucion','prefijo','codigo'),'conditions'=>array('Oficina.id'=>$VentaCredicontadoRepre['VentaCredicontadoRepre']['oficina'])));
		$envio['oficina']      = $oficinaB['Oficina']['nombre'];
		$envio['resolucion']   = 'Res. '.$oficinaB['Oficina']['resolucion'].' Autoriza del: '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['desde'].' al '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['hasta'];
		$envio['fecha']        = $VentaCredicontadoRepre['VentaCredicontadoRepre']['fecha'];
		$envio['vence']        = $VentaCredicontadoRepre['VentaCredicontadoRepre']['fecha'];
		$envio['factura']      = $VentaCredicontadoRepre['VentaCredicontadoRepre']['facturacion'];
		$envio['servicio']     = 'Envío de Encomiendas';
		$envio['docRef']       = $VentaCredicontadoRepre['VentaCredicontadoRepre']['tipo'].' '.$VentaCredicontadoRepre['VentaCredicontadoRepre']['documento1'];
		$envio['hora']         = $VentaCredicontadoRepre['VentaCredicontadoRepre']['hora'];
		$envio['cliente']      = $VentaCredicontadoRepre['VentaCredicontadoRepre']['nombreClien'];
		$envio['nit']          = $VentaCredicontadoRepre['VentaCredicontadoRepre']['documentoClien'];
		$envio['direccionC']   = $VentaCredicontadoRepre['VentaCredicontadoRepre']['direccionClien'];
		$envio['telefonoC']    = $VentaCredicontadoRepre['VentaCredicontadoRepre']['telefonoClien'];
		$envio['otro_remi']    = $VentaCredicontadoRepre['VentaCredicontadoRepre']['otro_remi'];
		if($VentaCredicontadoRepre['VentaCredicontadoRepre']['otro_remi'] == 0){
			$envio['otro_remi']  = false;
			$envio['remitente']  = "";
			$envio['nitR']       = "";
			$envio['direccionR'] = "";
			$envio['telefonoR']  = "";
		} else {
			$envio['otro_remi']  = true;
			$envio['remitente']  = $VentaCredicontadoRepre['VentaCredicontadoRepre']['nombreRemi'];
			$envio['nitR']       = $VentaCredicontadoRepre['VentaCredicontadoRepre']['documentoRemi'];
			$envio['direccionR'] = $VentaCredicontadoRepre['VentaCredicontadoRepre']['direccionRemi'];
			$envio['telefonoR']  = $VentaCredicontadoRepre['VentaCredicontadoRepre']['telefonoRemi'];		
		}
		
		$origenB               = $this->VentaCredicontadoRepre->importModel('Destino')->read(null,$VentaCredicontadoRepre['VentaCredicontadoRepre']['origen']);
		$destinoB              = $this->VentaCredicontadoRepre->importModel('Destino')->read(null,$VentaCredicontadoRepre['VentaCredicontadoRepre']['destino']);
		$envio['origen']       = $origenB['Destino']['nombre'];
		$envio['destino']      = $destinoB['Destino']['nombre'];
		$destinatarioB         = $this->VentaCredicontadoRepre->importModel('Destinatario')->read(null,$VentaCredicontadoRepre['VentaCredicontadoRepre']['destinatario']);
		$contactoB             = json_decode($destinatarioB['Destinatario']['contacto'],true);
		$envio['destinatario'] = $VentaCredicontadoRepre['VentaCredicontadoRepre']['nombreDest'];
		$envio['ced']          = $VentaCredicontadoRepre['VentaCredicontadoRepre']['documentoDest'];
		$envio['direccionD']   = $VentaCredicontadoRepre['VentaCredicontadoRepre']['direccionDest'];
		$envio['telefonoD1']   = $VentaCredicontadoRepre['VentaCredicontadoRepre']['telefonoDest'];
		$envio['telefonoD2']   = $VentaCredicontadoRepre['VentaCredicontadoRepre']['telefono2Dest'];
		$envio['contacto']     = $contactoB[0]['nombre'];
		$empaques_info         = json_decode($VentaCredicontadoRepre['VentaCredicontadoRepre']['empaque_info'],true);
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
			$empaqueB = $this->VentaCredicontadoRepre->importModel('Empaque')->read(null, $empaqueAct);
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

		$envio['barras']      = $VentaCredicontadoRepre['VentaCredicontadoRepre']['barras'];
		$envio['observacion'] = $VentaCredicontadoRepre['VentaCredicontadoRepre']['observaciones'];
		$envio['contenido']   = $VentaCredicontadoRepre['VentaCredicontadoRepre']['contenido'];
		$decla = str_replace(".",",",str_replace(",","",$VentaCredicontadoRepre['VentaCredicontadoRepre']['declarado']));
		$envio['valorDecla']  = number_format(floatval($decla),0,'.',',');
		$envio['valorFlete']  = number_format($sumaFlete,0,'.',',');

		$usuarioB = $this->VentaCredicontadoRepre->importModel('User')->read(null,$VentaCredicontadoRepre['VentaCredicontadoRepre']['usuario']);
		$envio['nombre']       = $usuarioB['User']['name'].' '.$usuarioB['User']['lastname'];
		$envio['formaPago']    = 'CONTADO';
		$envio['kiloAd']       = number_format($VentaCredicontadoRepre['VentaCredicontadoRepre']['kilo_adic'],0,'.',',');
		$envio['valorKiloAd']  = number_format($VentaCredicontadoRepre['VentaCredicontadoRepre']['valor_kilo_adic'],0,'.',',');
		$envio['descFlete']    = number_format($VentaCredicontadoRepre['VentaCredicontadoRepre']['desc_flete'],0,'.',',');
		$envio['descKilo']     = number_format($VentaCredicontadoRepre['VentaCredicontadoRepre']['desc_kilo'],0,'.',',');
		$envio['valorFirmado'] = number_format($VentaCredicontadoRepre['VentaCredicontadoRepre']['valor_devolucion'],0,'.',',');
		$envio['valorSeguro']  = number_format($VentaCredicontadoRepre['VentaCredicontadoRepre']['valor_seguro'],0,'.',',');
		$envio['valorTotal']   = number_format($VentaCredicontadoRepre['VentaCredicontadoRepre']['valor_total'],0,'.',',');
		$envio['kiloNegoc']    = $VentaCredicontadoRepre['VentaCredicontadoRepre']['kilo_nego'];

		$this->set(compact('envio'));
	//	$this->layout = 'pdf'; 
	//	$this->render(); 
	}


}
?>

<?php
class VentasCreditoRepreController extends AppController {
	public $name = 'VentasCreditoRepre';

	public function crear() {
		$this->layout = "grey";

		$clientes       = $this->VentasCreditoRepre->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1,'Cliente.credito'=>'Si')));
		$clientesD      = $this->VentasCreditoRepre->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'conditions'=>array('Cliente.id >'=>1,'Cliente.credito'=>'Si')));
		$clientesN      = $this->VentasCreditoRepre->importModel('Cliente')->find('list',array('fields'=>array('Cliente.listNombre'),'conditions'=>array('Cliente.id >'=>1,'Cliente.credito'=>'Si')));
		
		$user   = $this->Auth->user();
		$user   = $this->VentasCreditoRepre->importModel('User')->read(null,$user['id']);
		$rem    = $this->VentasCreditoRepre->importModel('Venta')->find('first', array('order' => array('Venta.id' =>'desc'),'fields'=>'Venta.id'));
		$remesa = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($rem['Venta']['id'])+1);
	
		if(!empty($this->data)){
			$this->request->data['VentasCreditoRepre']['fecha'] = date("Y-m-d");
			$this->request->data['VentasCreditoRepre']['hora']  = date("H:i:s");
			$empaqueInfo = array();
			$this->request->data['VentasCreditoRepre']['nombreClien']    = $clientesN[$this->data['VentasCreditoRepre']['nombreClien']];
			$this->request->data['VentasCreditoRepre']['documentoClien'] = $clientesD[$this->data['VentasCreditoRepre']['documentoClien']];
			$this->request->data['VentasCreditoRepre']['clase']      = 'Credito';
			$this->request->data['VentasCreditoRepre']['despachada'] = $user['Oficina']['id'];
			$empaqueInfo['empaques'] = $this->data['VentasCreditoRepre']['empaques'];
			$empaqueInfo['cantidad'] = $this->data['VentasCreditoRepre']['cantidad'];
			$empaqueInfo['barras']      = $this->data['VentasCreditoRepre']['cbarras'];
			$empaqueInfo['descripcion'] = $this->data['VentasCreditoRepre']['descripcion'];
			$empaqueInfo['largo']    = $this->data['VentasCreditoRepre']['largo'];
			$empaqueInfo['ancho']    = $this->data['VentasCreditoRepre']['ancho'];
			$empaqueInfo['alto']     = $this->data['VentasCreditoRepre']['alto'];
			$empaqueInfo['peso']     = $this->data['VentasCreditoRepre']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['VentasCreditoRepre']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['VentasCreditoRepre']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['VentasCreditoRepre']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['VentasCreditoRepre']['subtotal'];
			$this->request->data['VentasCreditoRepre']['empaque_info'] = json_encode($empaqueInfo);

			$this->request->data['VentasCreditoRepre']['facturacion'] = "";
			$this->request->data['VentasCreditoRepre']['remesa']      = $remesa;
			$this->request->data['Venta'] = $this->data['VentasCreditoRepre'];
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
    					$repre = $this->VentasCreditoRepre->importModel('Representante')->read(null,$this->data['Venta']['recaudador']);
						$this->request->data['Venta']['negociador']     = $repre['Representante']['identificacion'];
						$this->request->data['Venta']['negociador_nom'] = $repre['Representante']['listNombre'];
    				}
    				$recibo = $this->request->data['Venta'];
					$this->request->data['VentasCreditoRepre']['fecha'] = date("Y-m-d H:i:s");
    				$this->VentasCreditoRepre->importModel('Recibo')->save($recibo);
    			}
				$Remite = $this->data['VentasCreditoRepre']['checkRemitente'];
				$Archiv = $this->data['VentasCreditoRepre']['checkArchivo'];
				$Destin = $this->data['VentasCreditoRepre']['checkDestinatario'];
				$Prueba = $this->data['VentasCreditoRepre']['checkPrueba'];
				$this->redirect(array('controller'=>'VentasCredito','action' => 'imprimir',$ventaImport->id,$Remite,$Archiv,$Destin,$Prueba));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La venta no se puedo guardar.'));
			}
		}
		$user           = $this->Auth->user();
		$user           = $this->VentasCreditoRepre->importModel('User')->read(null,$user['id']);
		$remesa         = $user['Oficina']['codigo'].$user['User']['codigo'].floatval($user['Oficina']['consecutivo']);
		$tipo           = $this->VentasCreditoRepre->getEnumValues('tipo');
		$firmado        = $this->VentasCreditoRepre->getEnumValues('firmado');
		$destinos       = $this->VentasCreditoRepre->importModel('Destino')->find('list');
		$empaques       = $this->VentasCreditoRepre->importModel('Empaque')->find('list');
		
		$remitentes     = $this->VentasCreditoRepre->importModel('Remitente')->find('all',array('recursive'=>-1));
		$remitentesD    = $this->VentasCreditoRepre->importModel('Remitente')->find('list',array('fields'=>array('Remitente.documento')));
		$remitentesNom  = $this->VentasCreditoRepre->importModel('Remitente')->find('list',array('fields'=>array('Remitente.nombre')));
		
		$destinatarios  = $this->VentasCreditoRepre->importModel('Destinatario')->find('all',array('recursive'=>-1));
		$destinatariosD = $this->VentasCreditoRepre->importModel('Destinatario')->find('list',array('fields'=>array('Destinatario.documento')));

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
			$clientes[$key]['Cliente']['remitentes'] = json_decode($value['Cliente']['remitentes'],true);
		}
		$transportadoras = $this->VentasCreditoRepre->importModel('Transportadora')->find('all',array('recursive'=>-1,'fields'=>array('Transportadora.nit','Transportadora.razon','Transportadora.credito')));
		$vehiculos       = $this->VentasCreditoRepre->importModel('Vehiculo')->find('list');
		$vehiculos       = array_values($vehiculos);
		$conductores     = $this->VentasCreditoRepre->importModel('Conductor')->find('all',array('recursive'=>-1,'fields'=>array('Conductor.identificacion','Conductor.listNombre'),'conditions'=>array('Conductor.conductor2'=>'1')));
		$forma           = $this->VentasCreditoRepre->importModel('Recibo')->getEnumValues('forma_pago');

		$ingresos  = $this->VentasCreditoRepre->importModel('Ingreso')->find('list',array('fields'=>array('Ingreso.barras','Ingreso.cliente'),'conditions'=>array('Ingreso.estado'=>0)));
		$this->set(compact('ingresos','transportadoras','forma','conductores','vehiculos','selectDep','remesa','destinos','empaques','firmado','tipo','clientes','clientesD','clientesN','remitentes','remitentesD','remitentesNom','destinatarios','destinatariosD','destinatariosN'));
	}

	public function getTarifa($cliente = null,$origen = null, $destino = null) {
		//$this->log($cliente.'-'.$origen.'-'.$destino);
		$this->autoRender = false;
		$tarifas   = array();
		$convenios = array();
		if(!empty($cliente) && !empty($origen) && !empty($destino)){
			$tarifas    = $this->VentasCreditoRepre->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
			$convenios  = $this->VentasCreditoRepre->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
			if($cliente != 1){
				$tarifasB   = $this->VentasCreditoRepre->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>1)));
				$conveniosB = $this->VentasCreditoRepre->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>1)));
			} else {
				$tarifasB   = $tarifas;
				$conveniosB = $convenios;
			}
		}
		$cupo = $this->VentasCreditoRepre->importModel('Cliente')->find('first',array('recursive'=>-1,'fields'=>array('Cliente.cupo'),'conditions'=>array('Cliente.id'=>$cliente)));
		$suma = $this->VentasCreditoRepre->importModel('Venta')->find('all',array('fields'=>array('SUM(Venta.valor_total) AS saldoPend'),'conditions'=>array('Venta.cliente'=>$cliente)));
		if($suma[0][0]['saldoPend'] == null){
			$data['Saldo'] = 0;
		} else {
			$data['Saldo'] = $suma[0][0]['saldoPend'];
		}
		$data['Cupo']             = $cupo['Cliente']['cupo'];
		$data['TarifaBase']       = $tarifasB;
		$data['ConvenioBase']     = $conveniosB;
		$data['Tarifa']           = $tarifas;
		$data['Convenio']         = $convenios;
		$repreList = array();
		$representantes = $this->VentasCreditoRepre->importModel("Representantexdestino")->find('all',array('recursive'=>0,'conditions'=>array('Representantexdestino.destino_id'=>$origen)));
		foreach ($representantes as $key => $value) {
			$repreList[$value['Representante']['id']]  = $value['Representante']['identificacion'].' - '.$value['Representante']['listNombre'];
		}
		$data['Representante']    = $repreList;
		return json_encode($data);
	}


	function imprimir($id = null, $Remite = null, $Archiv = null, $Destin = null, $Prueba = null){
		$venta               = $this->VentasCreditoRepre->read(null,$id);
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
		$envio['guia']         = $venta['VentasCreditoRepre']['remesa'];
		$oficinaB              = $this->VentasCreditoRepre->importModel('Oficina')->find('first',array('recursive'=>-1,'fields'=>array('nombre','hasta','desde','resolucion','prefijo','codigo'),'conditions'=>array('Oficina.id'=>$venta['VentasCreditoRepre']['oficina'])));
		$envio['oficina']      = $oficinaB['Oficina']['nombre'];
		$envio['resolucion']   = 'Res. '.$oficinaB['Oficina']['resolucion'].' Autoriza del: '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['desde'].' al '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['hasta'];
		$envio['fecha']        = $venta['VentasCreditoRepre']['fecha'];
		$envio['vence']        = $venta['VentasCreditoRepre']['fecha'];
		$envio['factura']      = $venta['VentasCreditoRepre']['facturacion'];
		$envio['servicio']     = 'Envío de Encomiendas';
		$envio['docRef']       = $venta['VentasCreditoRepre']['tipo'].' '.$venta['VentasCreditoRepre']['documento1'];
		$envio['hora']         = $venta['VentasCreditoRepre']['hora'];
		$envio['cliente']      = $venta['VentasCreditoRepre']['nombreClien'];
		$envio['nit']          = $venta['VentasCreditoRepre']['documentoClien'];
		$envio['direccionC']   = $venta['VentasCreditoRepre']['direccionClien'];
		$envio['telefonoC']    = $venta['VentasCreditoRepre']['telefonoClien'];
		$envio['otro_remi']    = $venta['VentasCreditoRepre']['otro_remi'];
		if($venta['VentasCreditoRepre']['otro_remi'] == 0){
			$envio['otro_remi']  = false;
			$envio['remitente']  = "";
			$envio['nitR']       = "";
			$envio['direccionR'] = "";
			$envio['telefonoR']  = "";
		} else {
			$envio['otro_remi']  = true;
			$envio['remitente']  = $venta['VentasCreditoRepre']['nombreRemi'];
			$envio['nitR']       = $venta['VentasCreditoRepre']['documentoRemi'];
			$envio['direccionR'] = $venta['VentasCreditoRepre']['direccionRemi'];
			$envio['telefonoR']  = $venta['VentasCreditoRepre']['telefonoRemi'];		
		}
		
		$origenB               = $this->VentasCreditoRepre->importModel('Destino')->read(null,$venta['VentasCreditoRepre']['origen']);
		$destinoB              = $this->VentasCreditoRepre->importModel('Destino')->read(null,$venta['VentasCreditoRepre']['destino']);
		$envio['origen']       = $origenB['Destino']['nombre'];
		$envio['destino']      = $destinoB['Destino']['nombre'];
		$destinatarioB         = $this->VentasCreditoRepre->importModel('Destinatario')->read(null,$venta['VentasCreditoRepre']['destinatario']);
		$contactoB             = json_decode($destinatarioB['Destinatario']['contacto'],true);
		$envio['destinatario'] = $venta['VentasCreditoRepre']['nombreDest'];
		$envio['ced']          = $venta['VentasCreditoRepre']['documentoDest'];
		$envio['direccionD']   = $venta['VentasCreditoRepre']['direccionDest'];
		$envio['telefonoD1']   = $venta['VentasCreditoRepre']['telefonoDest'];
		$envio['telefonoD2']   = $venta['VentasCreditoRepre']['telefono2Dest'];
		$envio['contacto']     = $contactoB[0]['nombre'];
		$empaques_info         = json_decode($venta['VentasCreditoRepre']['empaque_info'],true);
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
			$empaqueB = $this->VentasCreditoRepre->importModel('Empaque')->read(null, $empaqueAct);
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

		$envio['barras']      = $venta['VentasCreditoRepre']['barras'];
		$envio['observacion'] = $venta['VentasCreditoRepre']['observaciones'];
		$envio['contenido']   = $venta['VentasCreditoRepre']['contenido'];
		$decla = str_replace(".",",",str_replace(",","",$venta['VentasCreditoRepre']['declarado']));
		$envio['valorDecla']  = number_format(floatval($decla),0,'.',',');
		$envio['valorFlete']  = number_format($sumaFlete,0,'.',',');

		$usuarioB = $this->VentasCreditoRepre->importModel('User')->read(null,$venta['VentasCreditoRepre']['usuario']);
		$envio['nombre']       = $usuarioB['User']['name'].' '.$usuarioB['User']['lastname'];
		$envio['formaPago']    = 'CONTADO';
		$envio['kiloAd']       = number_format($venta['VentasCreditoRepre']['kilo_adic'],0,'.',',');
		$envio['valorKiloAd']  = number_format($venta['VentasCreditoRepre']['valor_kilo_adic'],0,'.',',');
		$envio['descFlete']    = number_format($venta['VentasCreditoRepre']['desc_flete'],0,'.',',');
		$envio['descKilo']     = number_format($venta['VentasCreditoRepre']['desc_kilo'],0,'.',',');
		$envio['valorFirmado'] = number_format($venta['VentasCreditoRepre']['valor_devolucion'],0,'.',',');
		$envio['valorSeguro']  = number_format($venta['VentasCreditoRepre']['valor_seguro'],0,'.',',');
		$envio['valorTotal']   = number_format($venta['VentasCreditoRepre']['valor_total'],0,'.',',');
		$envio['kiloNegoc']    = $venta['VentasCreditoRepre']['kilo_nego'];

		$this->set(compact('envio'));
	//	$this->layout = 'pdf'; 
	//	$this->render(); 
	}




}
?>

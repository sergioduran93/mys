<?php
class VentasCreditoController extends AppController {
	public $name = 'VentasCredito';
	public $components = array('JqImgcrop','Util','Excel');


	public function crear() {
		$this->layout = "grey";

		$clientes       = $this->VentasCredito->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1,'Cliente.credito'=>'Si')));
		$clientesD      = $this->VentasCredito->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'conditions'=>array('Cliente.id >'=>1,'Cliente.credito'=>'Si')));
		$clientesN      = $this->VentasCredito->importModel('Cliente')->find('list',array('fields'=>array('Cliente.listNombre'),'conditions'=>array('Cliente.id >'=>1,'Cliente.credito'=>'Si')));
		
		if(!empty($this->data)){
			$this->request->data['VentasCredito']['fecha'] = date("Y-m-d");
			$this->request->data['VentasCredito']['hora']  = date("H:i:s");
			$empaqueInfo = array();
			$this->request->data['VentasCredito']['nombreClien']    = $clientesN[$this->data['VentasCredito']['nombreClien']];
			$this->request->data['VentasCredito']['documentoClien'] = $clientesD[$this->data['VentasCredito']['documentoClien']];
			
			$this->request->data['VentasCredito']['clase']      = 'Credito';
			$empaqueInfo['barras']   = $this->data['VentasCredito']['cbarras'];
			$empaqueInfo['empaques'] = $this->data['VentasCredito']['empaques'];
			$empaqueInfo['cantidad'] = $this->data['VentasCredito']['cantidad'];
			$empaqueInfo['largo']    = $this->data['VentasCredito']['largo'];
			$empaqueInfo['ancho']    = $this->data['VentasCredito']['ancho'];
			$empaqueInfo['alto']     = $this->data['VentasCredito']['alto'];
			$empaqueInfo['peso']     = $this->data['VentasCredito']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['VentasCredito']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['VentasCredito']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['VentasCredito']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['VentasCredito']['subtotal'];
			$this->request->data['VentasCredito']['empaque_info'] = json_encode($empaqueInfo);

			$user   = $this->Auth->user();
			$user   = $this->VentasCredito->importModel('User')->read(null,$user['id']);
			$rem    = $this->VentasCredito->importModel('Venta')->find('first', array('order' => array('Venta.id' =>'desc'),'fields'=>'Venta.id'));
			$remesa = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($rem['Venta']['id'])+1);
			
			$this->request->data['VentasCredito']['despachada'] = $user['Oficina']['id'];
			$this->request->data['VentasCredito']['facturacion'] = '';
			$this->request->data['VentasCredito']['remesa'] = $remesa;

			$this->request->data['Venta'] = $this->data['VentasCredito'];

			$this->request->data['Venta']['kilo_adic']        = str_replace(".",",",str_replace(",","",$this->data['Venta']['kilo_adic']));
			$this->request->data['Venta']['valor_kilo_adic']  = str_replace(".",",",str_replace(",","",$this->data['Venta']['valor_kilo_adic']));
			$this->request->data['Venta']['desc_flete']       = str_replace(".",",",str_replace(",","",$this->data['Venta']['desc_flete']));
			$this->request->data['Venta']['desc_kilo']        = str_replace(".",",",str_replace(",","",$this->data['Venta']['desc_kilo']));
			$this->request->data['Venta']['valor_devolucion'] = str_replace(".",",",str_replace(",","",$this->data['Venta']['valor_devolucion']));
			$this->request->data['Venta']['valor_seguro']     = str_replace(".",",",str_replace(",","",$this->data['Venta']['valor_seguro']));
			$this->request->data['Venta']['valor_total']      = str_replace(".",",",str_replace(",","",$this->data['Venta']['valor_total']));
			
			App::import('model', 'Venta');
        	$ventaImport = new Venta();
			if($ventaImport->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La venta se guardo con exito.'));
				$Remite = $this->data['VentasCredito']['checkRemitente'];
				$Archiv = $this->data['VentasCredito']['checkArchivo'];
				$Destin = $this->data['VentasCredito']['checkDestinatario'];
				$Prueba = $this->data['VentasCredito']['checkPrueba'];
				$this->redirect(array('action' => 'imprimir',$ventaImport->id,$Remite,$Archiv,$Destin,$Prueba));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La venta no se puedo guardar.'));
			}
		}
		$user           = $this->Auth->user();
		$user           = $this->VentasCredito->importModel('User')->read(null,$user['id']);
		$rem            = $this->VentasCredito->importModel('Venta')->find('first', array('order' => array('Venta.id' =>'desc'),'fields'=>'Venta.id'));
		$remesa         = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($rem['Venta']['id'])+1);
		$tipo           = $this->VentasCredito->getEnumValues('tipo');
		$firmado        = $this->VentasCredito->getEnumValues('firmado');
		$destinos       = $this->VentasCredito->importModel('Destino')->find('list');
		$empaques       = $this->VentasCredito->importModel('Empaque')->find('list');
		
		$remitentes     = $this->VentasCredito->importModel('Remitente')->find('all',array('recursive'=>-1));
		$remitentesD    = $this->VentasCredito->importModel('Remitente')->find('list',array('fields'=>array('Remitente.documento')));
		$remitentesNom  = $this->VentasCredito->importModel('Remitente')->find('list',array('fields'=>array('Remitente.nombre')));
		
		$destinatarios  = $this->VentasCredito->importModel('Destinatario')->find('all',array('recursive'=>-1));
		$destinatariosD = $this->VentasCredito->importModel('Destinatario')->find('list',array('fields'=>array('Destinatario.documento')));

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
		
		$ingresos  = $this->VentasCredito->importModel('Ingreso')->find('list',array('fields'=>array('Ingreso.barras','Ingreso.cliente'),'conditions'=>array('Ingreso.estado'=>0)));
		$this->set(compact('ingresos','selectDep','remesa','destinos','empaques','firmado','tipo','clientes','clientesD','clientesN','remitentes','remitentesD','remitentesNom','destinatarios','destinatariosD','destinatariosN'));
	}

	public function clientes() {

		$clientes       = $this->VentasCredito->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1,'Cliente.credito'=>'Si')));
		$clientesD      = $this->VentasCredito->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'conditions'=>array('Cliente.id >'=>1,'Cliente.credito'=>'Si')));
		$clientesN      = $this->VentasCredito->importModel('Cliente')->find('list',array('fields'=>array('Cliente.listNombre'),'conditions'=>array('Cliente.id >'=>1,'Cliente.credito'=>'Si')));
		
		$user   = $this->Auth->user();
		$user   = $this->VentasCredito->importModel('User')->read(null,$user['id']);
		$rem    = $this->VentasCredito->find('first', array('order' => array('VentasCredito.id' =>'desc'),'fields'=>'VentasCredito.id'));
		$remesa = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($rem['VentasCredito']['id'])+1);
		
		
		if(!empty($this->data)){
			$this->request->data['VentasCredito']['fecha'] = date("Y-m-d");
			$this->request->data['VentasCredito']['hora']  = date("H:i:s");
			$empaqueInfo = array();
			$this->request->data['VentasCredito']['nombreClien']    = $clientesN[$this->data['VentasCredito']['nombreClien']];
			$this->request->data['VentasCredito']['documentoClien'] = $clientesD[$this->data['VentasCredito']['documentoClien']];
			
			$this->request->data['VentasCredito']['clase']      = 'Cliente';
			$empaqueInfo['empaques'] = $this->data['VentasCredito']['empaques'];
			$empaqueInfo['cantidad'] = $this->data['VentasCredito']['cantidad'];
			$empaqueInfo['largo']    = $this->data['VentasCredito']['largo'];
			$empaqueInfo['ancho']    = $this->data['VentasCredito']['ancho'];
			$empaqueInfo['alto']     = $this->data['VentasCredito']['alto'];
			$empaqueInfo['peso']     = $this->data['VentasCredito']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['VentasCredito']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['VentasCredito']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['VentasCredito']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['VentasCredito']['subtotal'];
			$this->request->data['VentasCredito']['empaque_info'] = json_encode($empaqueInfo);

			
			$this->request->data['Venta'] = $this->data['VentasCredito'];

			$this->request->data['Venta']['kilo_adic']        = str_replace(".",",",str_replace(",","",$this->data['Venta']['kilo_adic']));
			$this->request->data['Venta']['valor_kilo_adic']  = str_replace(".",",",str_replace(",","",$this->data['Venta']['valor_kilo_adic']));
			$this->request->data['Venta']['desc_flete']       = str_replace(".",",",str_replace(",","",$this->data['Venta']['desc_flete']));
			$this->request->data['Venta']['desc_kilo']        = str_replace(".",",",str_replace(",","",$this->data['Venta']['desc_kilo']));
			$this->request->data['Venta']['valor_devolucion'] = str_replace(".",",",str_replace(",","",$this->data['Venta']['valor_devolucion']));
			$this->request->data['Venta']['valor_seguro']     = str_replace(".",",",str_replace(",","",$this->data['Venta']['valor_seguro']));
			$this->request->data['Venta']['valor_total']      = str_replace(".",",",str_replace(",","",$this->data['Venta']['valor_total']));
			
			$this->request->data['VentasCredito']['facturacion'] = '';
			$this->request->data['VentasCredito']['remesa']      = $remesa;
			$this->request->data['VentasCredito']['despachada']  = $user['Oficina']['id'];

			if($this->VentasCredito->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La venta se guardo con exito.'));
    			$this->VentasCredito->importModel('Oficina')->save($ofi);
				$Remite = $this->data['VentasCredito']['checkRemitente'];
				$Archiv = $this->data['VentasCredito']['checkArchivo'];
				$Destin = $this->data['VentasCredito']['checkDestinatario'];
				$Prueba = $this->data['VentasCredito']['checkPrueba'];
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La venta no se puedo guardar.'));
			}
		}
		$tipo           = $this->VentasCredito->getEnumValues('tipo');
		$firmado        = $this->VentasCredito->getEnumValues('firmado');
		$destinos       = $this->VentasCredito->importModel('Destino')->find('list');
		$empaques       = $this->VentasCredito->importModel('Empaque')->find('list');
		
		$remitentes     = $this->VentasCredito->importModel('Remitente')->find('all',array('recursive'=>-1));
		$remitentesD    = $this->VentasCredito->importModel('Remitente')->find('list',array('fields'=>array('Remitente.documento')));
		$remitentesNom  = $this->VentasCredito->importModel('Remitente')->find('list',array('fields'=>array('Remitente.nombre')));
		
		$destinatarios  = $this->VentasCredito->importModel('Destinatario')->find('all',array('recursive'=>-1));
		$destinatariosD = $this->VentasCredito->importModel('Destinatario')->find('list',array('fields'=>array('Destinatario.documento')));

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
		$this->set(compact('selectDep','remesa','destinos','empaques','firmado','tipo','clientes','clientesD','clientesN','remitentes','remitentesD','remitentesNom','destinatarios','destinatariosD','destinatariosN'));
	}

	public function getTarifa($cliente = null,$origen = null, $destino = null) {
		//$this->log($cliente.'-'.$origen.'-'.$destino);
		$this->autoRender = false;
		$tarifas   = array();
		$convenios = array();
		if(!empty($cliente) && !empty($origen) && !empty($destino)){
			$tarifas    = $this->VentasCredito->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
			$convenios  = $this->VentasCredito->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
			if($cliente != 1){
				$tarifasB   = $this->VentasCredito->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>1)));
				$conveniosB = $this->VentasCredito->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>1)));
			} else {
				$tarifasB   = $tarifas;
				$conveniosB = $convenios;
			}
		}
		$cupo = $this->VentasCredito->importModel('Cliente')->find('first',array('recursive'=>-1,'fields'=>array('Cliente.cupo'),'conditions'=>array('Cliente.id'=>$cliente)));
		$suma = $this->VentasCredito->importModel('Venta')->find('all',array('fields'=>array('SUM(Venta.valor_total) AS saldoPend'),'conditions'=>array('Venta.cliente'=>$cliente)));
		if($suma[0][0]['saldoPend'] == null){
			$data['Saldo'] = 0;
		} else {
			$data['Saldo'] = $suma[0][0]['saldoPend'];
		}
		$data['Cupo']         = $cupo['Cliente']['cupo'];
		$data['TarifaBase']   = $tarifasB;
		$data['ConvenioBase'] = $conveniosB;
		$data['Tarifa']       = $tarifas;
		$data['Convenio']     = $convenios;
		return json_encode($data);
	}

	public function relacion(){
		$user     = $this->Auth->user();
		$ventasL  = $this->VentasCredito->find('list',array('recursive'=>-1,'conditions'=>array('VentasCredito.cliente'=>$user['id'],'VentasCredito.despachada !='=>'Planillada')));
		if(!empty($this->data)){
			$nuevaRelacion['Relacion']['relacion'] = json_encode($ventasL);
			$this->VentasCredito->importModel('Relacion')->save($nuevaRelacion);
			$this->VentasCredito->updateAll(array('VentasCredito.despachada'=>'"Planillada"'),array('VentasCredito.cliente'=>$user['cliente_id']));
		}
		$ventas   = $this->VentasCredito->find('all',array('recursive'=>-1,'conditions'=>array('VentasCredito.cliente'=>$user['cliente_id'],'VentasCredito.despachada !='=>'Planillada')));
		$rem      = $this->VentasCredito->importModel('Relacion')->find('first', array('order' => array('Relacion.id' =>'desc'),'fields'=>'Relacion.id'));
		$planilla = (floatval($rem['Relacion']['id'])+1);
		$this->generateJSON('relacion', $ventas, array('VentasCredito' => array('id','remesa','nombreDest','direccionDest','destinoNombre','telefonoDest')));
		$this->set(compact('ventas','ventasL','planilla'));
	}

	public function imprimir($id = null, $Remite = null, $Archiv = null, $Destin = null, $Prueba = null){
		$venta               = $this->VentasCredito->importModel('Venta')->read(null,$id);
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
		$oficinaB              = $this->VentasCredito->importModel('Oficina')->find('first',array('recursive'=>-1,'fields'=>array('nombre','hasta','desde','resolucion','prefijo','codigo'),'conditions'=>array('Oficina.id'=>$venta['Venta']['oficina'])));
		$envio['oficina']      = $oficinaB['Oficina']['nombre'];
		$envio['fecha']        = $venta['Venta']['fecha'];
		$envio['servicio']     = 'Envío de Encomiendas';
		$envio['docRef']       = $venta['Venta']['tipo'].' '.$venta['Venta']['documento1'];
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
		
		$origenB               = $this->VentasCredito->importModel('Destino')->read(null,$venta['Venta']['origen']);
		$destinoB              = $this->VentasCredito->importModel('Destino')->read(null,$venta['Venta']['destino']);
		$envio['origen']       = $origenB['Destino']['nombre'];
		$envio['destino']      = $destinoB['Destino']['nombre'];
		$destinatarioB         = $this->VentasCredito->importModel('Destinatario')->read(null,$venta['Venta']['destinatario']);
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
			$empaqueB = $this->VentasCredito->importModel('Empaque')->read(null, $empaqueAct);
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
		$decla = str_replace(".",",",str_replace(",","",$venta['Venta']['declarado']));
		$envio['valorDecla']  = number_format(floatval($decla),0,'.',',');
		$envio['valorFlete']  = number_format($sumaFlete,0,'.',',');

		$usuarioB = $this->VentasCredito->importModel('User')->read(null,$venta['Venta']['usuario']);
		$envio['nombre']       = $usuarioB['User']['name'].' '.$usuarioB['User']['lastname'];
		$envio['formaPago']    = 'CREDITO';
		$envio['kiloAd']       = number_format(floatval($venta['Venta']['kilo_adic']),0,'.',',');
		$envio['valorKiloAd']  = number_format(floatval($venta['Venta']['valor_kilo_adic']),0,'.',',');
		$envio['descFlete']    = number_format(floatval($venta['Venta']['desc_flete']),0,'.',',');
		$envio['descKilo']     = number_format(floatval($venta['Venta']['desc_kilo']),0,'.',',');
		$envio['valorFirmado'] = number_format(floatval($venta['Venta']['valor_devolucion']),0,'.',',');
		$envio['valorSeguro']  = number_format(floatval($venta['Venta']['valor_seguro']),0,'.',',');
		$envio['valorTotal']   = number_format(floatval($venta['Venta']['valor_total']),0,'.',',');
		$envio['kiloNegoc']    = $venta['Venta']['kilo_nego'];

		$this->set(compact('envio'));
		//	$this->layout = 'pdf'; 
		//	$this->render(); 
	}

	public function editar($id = null) {
		$clientes  = $this->VentasCredito->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1,'Cliente.credito'=>'Si')));
		$clientesD = $this->VentasCredito->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'conditions'=>array('Cliente.id >'=>1,'Cliente.credito'=>'Si')));
		$clientesN = $this->VentasCredito->importModel('Cliente')->find('list',array('fields'=>array('Cliente.listNombre'),'conditions'=>array('Cliente.id >'=>1,'Cliente.credito'=>'Si')));
		$user      = $this->Auth->user();
		$user      = $this->VentasCredito->importModel('User')->read(null,$user['id']);
		$activo    = $this->VentasCredito->importModel('Cliente')->find('count',array('conditions'=>array('Cliente.id'=>$user['User']['cliente_id'],'Cliente.causal !='=>'Activo')));
		if($activo > 0){
			$this->Session->setFlash('','error',array('mensaje'=>'Su cuenta tiene un causal pendiente, Por favor contacte con el administrador.'));
			$this->redirect(array('controller'=>'users','action' => 'index'));
		}
		if(!empty($this->data)){
			$this->request->data['VentasCredito']['fecha'] = date("Y-m-d");
			$this->request->data['VentasCredito']['hora']  = date("H:i:s");
			$empaqueInfo = array();
			$this->request->data['VentasCredito']['despachada']     = $user['Oficina']['id'];
			$this->request->data['VentasCredito']['clase']          = 'Cliente';
			$empaqueInfo['empaques']    = $this->data['VentasCredito']['empaques'];
			$empaqueInfo['descripcion'] = $this->data['VentasCredito']['descripcion'];
			$empaqueInfo['cantidad']    = $this->data['VentasCredito']['cantidad'];
			$empaqueInfo['largo']       = $this->data['VentasCredito']['largo'];
			$empaqueInfo['ancho']       = $this->data['VentasCredito']['ancho'];
			$empaqueInfo['alto']        = $this->data['VentasCredito']['alto'];
			$empaqueInfo['peso']        = $this->data['VentasCredito']['peso'];
			$empaqueInfo['pesoVol']     = $this->data['VentasCredito']['pesoVol'];
			$empaqueInfo['valor']       = $this->data['VentasCredito']['valor'];
			$empaqueInfo['kiloAd']      = $this->data['VentasCredito']['kiloAd'];
			$this->request->data['VentasCredito']['empaque_info'] = json_encode($empaqueInfo);

			if($this->VentasCredito->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La venta se guardo con exito.'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La venta no se puedo guardar.'));
			}
		}

		$guiaEditar  = $this->VentasCredito->read(null,$id);
		$empaqueInfo = json_decode($guiaEditar['VentasCredito']['empaque_info'],true);
		$empaqueKO   = array();
		foreach ($empaqueInfo['empaques'] as $key => $value) {
			$empaqueKO[$key]['empaques']    = $empaqueInfo['empaques'][$key];
			$empaqueKO[$key]['descripcion'] = $empaqueInfo['descripcion'][$key];
			$empaqueKO[$key]['cantidad']    = $empaqueInfo['cantidad'][$key];
			$empaqueKO[$key]['valKilo']     = 0;
			$empaqueKO[$key]['pesoUni']     = 0;
			$empaqueKO[$key]['largo']       = $empaqueInfo['largo'][$key];
			$empaqueKO[$key]['ancho']       = $empaqueInfo['ancho'][$key];
			$empaqueKO[$key]['alto']        = $empaqueInfo['alto'][$key];
			$empaqueKO[$key]['peso']        = $empaqueInfo['peso'][$key];
			$empaqueKO[$key]['pesoVol']     = $empaqueInfo['pesoVol'][$key];
			$empaqueKO[$key]['valor']       = $empaqueInfo['valor'][$key];
			$empaqueKO[$key]['kiloAd']      = $empaqueInfo['kiloAd'][$key];
		}
		$guiaEditar['VentasCredito']['empaque_info'] = json_encode($empaqueKO);

		$this->data = $guiaEditar;

		$tipo           = $this->VentasCredito->getEnumValues('tipo');
		$firmado        = $this->VentasCredito->getEnumValues('firmado');
		$destinos       = $this->VentasCredito->importModel('Destino')->find('list');
		$empaques       = $this->VentasCredito->importModel('Empaque')->find('list');
		
		$remitentes     = $this->VentasCredito->importModel('Remitente')->find('all',array('recursive'=>-1));
		$remitentesD    = $this->VentasCredito->importModel('Remitente')->find('list',array('fields'=>array('Remitente.documento')));
		$remitentesNom  = $this->VentasCredito->importModel('Remitente')->find('list',array('fields'=>array('Remitente.nombre')));
		
		$destinatarios  = $this->VentasCredito->importModel('Destinatario')->find('all',array('recursive'=>-1));
		$destinatariosD = $this->VentasCredito->importModel('Destinatario')->find('list',array('fields'=>array('Destinatario.documento')));

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
		$this->set(compact('selectDep','remesa','destinos','empaques','firmado','tipo','clientes','clientesD','clientesN','remitentes','remitentesD','remitentesNom','destinatarios','destinatariosD','destinatariosN'));
	}

	public function eliminar($id = null) {
		if($this->VentasCredito->delete($id)){
			$this->Session->setFlash('','ok',array('mensaje'=>'La guia se elimino con exito'));
		} else {
			$this->Session->setFlash('','error',array('mensaje'=>'La guia no se pudo eliminar'));
		}
		$this->redirect(array('action' => 'relacion'));
	}

	public function reliquidar(){
		$user     = $this->Auth->user();
		$ventasL  = $this->VentasCredito->find('list',array('recursive'=>-1,'conditions'=>array('VentasCredito.cliente'=>$user['id'],'VentasCredito.despachada !='=>'Planillada')));
		if(!empty($this->data)){
			$nuevaRelacion['Relacion']['relacion'] = json_encode($ventasL);
			$this->VentasCredito->importModel('Relacion')->save($nuevaRelacion);
			$this->VentasCredito->updateAll(array('VentasCredito.despachada'=>'"Planillada"'),array('VentasCredito.cliente'=>$user['cliente_id']));
		}

		$ventas   = $this->VentasCredito->find('all',array('recursive'=>-1,'conditions'=>array()));
		
		$this->generateJSON('relacion', $ventas, array('VentasCredito' => array('id','remesa','nombreDest','direccionDest','destinoNombre','telefonoDest')));
		$this->set(compact('ventas','ventasL'));
	}

	public function getReliquidar2($id = null) {
		$this->layout = 'empty';
		$empaques = $this->VentasCredito->importModel('Empaque')->find('list');
		$guia     = $this->VentasCredito->read(null,$id);
		if(!empty($this->data)){
			$guia = $this->VentasCredito->read(null,$this->data['VentasCredito']['id']);
			$empaqueInfo = array();
			$empaqueInfo['barras']   = $this->data['VentasCredito']['cbarras'];
			$empaqueInfo['empaques'] = $this->data['VentasCredito']['empaques'];
			$empaqueInfo['cantidad'] = $this->data['VentasCredito']['cantidad'];
			$empaqueInfo['largo']    = $this->data['VentasCredito']['largo'];
			$empaqueInfo['ancho']    = $this->data['VentasCredito']['ancho'];
			$empaqueInfo['alto']     = $this->data['VentasCredito']['alto'];
			$empaqueInfo['peso']     = $this->data['VentasCredito']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['VentasCredito']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['VentasCredito']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['VentasCredito']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['VentasCredito']['subtotal'];
			$guia['VentasCredito']['empaque_info']    = json_encode($empaqueInfo);
			$guia['VentasCredito']['kilo_nego']       = $this->data['VentasCredito']['kilo_nego'];
			$guia['VentasCredito']['kilo_adic']       = $this->data['VentasCredito']['kilo_adic'];
			$guia['VentasCredito']['valor_kilo_adic'] = $this->data['VentasCredito']['valor_kilo_adic'];
			$guia['VentasCredito']['desc_flete']      = $this->data['VentasCredito']['desc_flete'];
			$guia['VentasCredito']['desc_kilo']       = $this->data['VentasCredito']['desc_kilo'];
			$guia['VentasCredito']['valor_total']     = $this->data['VentasCredito']['valor_total'];
			$guia['VentasCredito']['despachada']      = $this->data['VentasCredito']['valor_total'];
			$guia['Venta'] = $guia['VentasCredito'];
			$guia['Venta']['id'] = "";
			if($this->VentasCredito->importModel('Venta')->save($guia)){
				$this->VentasCredito->delete($this->data['VentasCredito']['id']);
    			$this->Session->setFlash('','ok',array('mensaje'=>'La guia se reliquido exitosamente.'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La guia no se puedo reliquidar.'));
			}
		}
		if($id == null){
			$this->data = null;
		} else {
			$this->data = $guia;
		}
		
		$cliente = $guia['VentasCredito']['cliente'];
		$origen  = $guia['VentasCredito']['origen'];
		$destino = $guia['VentasCredito']['destino'];

		$tarifas   = array();
		$convenios = array();
		if(!empty($cliente) && !empty($origen) && !empty($destino)){
			$tarifas    = $this->VentasCredito->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
			$convenios  = $this->VentasCredito->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
			if($cliente != 1){
				$tarifasB   = $this->VentasCredito->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>1)));
				$conveniosB = $this->VentasCredito->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>1)));
			} else {
				$tarifasB   = $tarifas;
				$conveniosB = $convenios;
			}
		}
		
		$data['TarifaBase']   = $tarifasB;
		$data['ConvenioBase'] = $conveniosB;
		$data['Tarifa']       = $tarifas;
		$data['Convenio']     = $convenios;
		$data = json_encode($data);

		$empaqueInfo = json_decode($guia['VentasCredito']['empaque_info'],true);
		$empaqueKO   = array();
		$cantidadCheck = 0;
		foreach ($empaqueInfo['empaques'] as $key => $value) {
			$empaqueKO[$key]['empaques']    = $empaqueInfo['empaques'][$key];
			$empaqueKO[$key]['descripcion'] = $empaqueInfo['descripcion'][$key];
			$empaqueKO[$key]['cantidad']    = $empaqueInfo['cantidad'][$key];
			$cantidadCheck = $cantidadCheck + floatval($empaqueInfo['cantidad'][$key]);
			$empaqueKO[$key]['valKilo']     = 0;
			$empaqueKO[$key]['pesoUni']     = 0;
			$empaqueKO[$key]['largo']       = $empaqueInfo['largo'][$key];
			$empaqueKO[$key]['ancho']       = $empaqueInfo['ancho'][$key];
			$empaqueKO[$key]['alto']        = $empaqueInfo['alto'][$key];
			$empaqueKO[$key]['peso']        = $empaqueInfo['peso'][$key];
			$empaqueKO[$key]['pesoVol']     = $empaqueInfo['pesoVol'][$key];
			$empaqueKO[$key]['valor']       = $empaqueInfo['valor'][$key];
			$empaqueKO[$key]['kiloAd']      = $empaqueInfo['kiloAd'][$key];
		}
		$empaque_info = json_encode($empaqueKO);
		$costoSeguro  = $guia['VentasCredito']['valor_seguro'];
		$costoDevol   = $guia['VentasCredito']['valor_devolucion'];
		$this->set(compact('cantidadCheck','costoDevol','costoSeguro','empaques','data','empaque_info'));
	}

	public function getReliquidar($id = null) {
		$this->layout = 'empty';
		$empaques = $this->VentasCredito->importModel('Empaque')->find('list');
		$guia     = $this->VentasCredito->read(null,$id);
		$recibo   = $this->VentasCredito->importModel('Recibo')->find('count',array('conditions'=>array('Recibo.guia_id'=>$id)));
		if(!empty($this->data)){
			$guia = $this->VentasCredito->read(null,$this->data['VentasCredito']['id']);
			$empaqueInfo = array();
			$empaqueInfo['barras']      = $this->data['VentasCredito']['cbarras'];
			$empaqueInfo['descripcion'] = $this->data['VentasCredito']['descripcion'];
			$empaqueInfo['empaques']    = $this->data['VentasCredito']['empaques'];
			$empaqueInfo['cantidad']    = $this->data['VentasCredito']['cantidad'];
			$empaqueInfo['largo']       = $this->data['VentasCredito']['largo'];
			$empaqueInfo['ancho']       = $this->data['VentasCredito']['ancho'];
			$empaqueInfo['alto']        = $this->data['VentasCredito']['alto'];
			$empaqueInfo['peso']        = $this->data['VentasCredito']['peso'];
			$empaqueInfo['pesoVol']     = $this->data['VentasCredito']['pesoVol'];
			$empaqueInfo['valor']       = $this->data['VentasCredito']['valor'];
			$empaqueInfo['kiloAd']      = $this->data['VentasCredito']['kiloAd'];
			$empaqueInfo['subtotal']    = $this->data['VentasCredito']['subtotal'];
			$guia['VentasCredito']['empaque_info']    = json_encode($empaqueInfo);
			$guia['VentasCredito']['despachada']      = $this->data['VentasCredito']['oficina_trae'];
			$guia['VentasCredito']['lista']           = 1;
			$guia['VentasCredito']['clase']           = 'Credito';
			$guia['VentasCredito']['kilo_nego']       = $this->data['VentasCredito']['kilo_nego'];
			$guia['VentasCredito']['kilo_adic']       = $this->data['VentasCredito']['kilo_adic'];
			$guia['VentasCredito']['valor_kilo_adic'] = $this->data['VentasCredito']['valor_kilo_adic'];
			$guia['VentasCredito']['desc_flete']      = $this->data['VentasCredito']['desc_flete'];
			$guia['VentasCredito']['desc_kilo']       = $this->data['VentasCredito']['desc_kilo'];
			$guia['VentasCredito']['valor_total']     = $this->data['VentasCredito']['valor_total'];
			$guia['Venta'] = $guia['VentasCredito'];
			$guia['Venta']['id'] = '';
			$idd = $this->request->data['Venta']['id'];
			$this->request->data['Venta'] = $guia['VentasCredito'];
			$this->request->data['Venta']['id'] = '';

			unset($guia['VentasCredito']);
			$this->VentasCredito->importModel('Venta')->create();
			if($this->VentasCredito->importModel('Venta')->save($guia)){
				$this->VentasCredito->delete($idd);
    			$this->Session->setFlash('','ok',array('mensaje'=>'La guia se reliquido exitosamente.'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La guia no se puedo reliquidar.'));
			}
		}
		if($id == null){
			$this->data = null;
		} else {
			$this->data = $guia;
		}
		
		$cliente = $guia['VentasCredito']['cliente'];
		$origen  = $guia['VentasCredito']['origen'];
		$destino = $guia['VentasCredito']['destino'];

		$tarifas   = array();
		$convenios = array();
		if(!empty($cliente) && !empty($origen) && !empty($destino)){
			$tarifas    = $this->VentasCredito->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
			$convenios  = $this->VentasCredito->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
			if($cliente != 1){
				$tarifasB   = $this->VentasCredito->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>1)));
				$conveniosB = $this->VentasCredito->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>1)));
			} else {
				$tarifasB   = $tarifas;
				$conveniosB = $convenios;
			}
		}
		
		$data['TarifaBase']   = $tarifasB;
		$data['ConvenioBase'] = $conveniosB;
		$data['Tarifa']       = $tarifas;
		$data['Convenio']     = $convenios;
		$data = json_encode($data);

		$empaqueInfo = json_decode($guia['VentasCredito']['empaque_info'],true);
		$empaqueKO   = array();
		$cantidadCheck = 0;
		foreach ($empaqueInfo['empaques'] as $key => $value) {
			$empaqueKO[$key]['empaques']    = $empaqueInfo['empaques'][$key];
			$empaqueKO[$key]['descripcion'] = $empaqueInfo['descripcion'][$key];
			$empaqueKO[$key]['cantidad']    = $empaqueInfo['cantidad'][$key];
			$cantidadCheck = $cantidadCheck + floatval($empaqueInfo['cantidad'][$key]);
			$empaqueKO[$key]['valKilo']     = 0;
			$empaqueKO[$key]['pesoUni']     = 0;
			$empaqueKO[$key]['largo']       = $empaqueInfo['largo'][$key];
			$empaqueKO[$key]['ancho']       = $empaqueInfo['ancho'][$key];
			$empaqueKO[$key]['alto']        = $empaqueInfo['alto'][$key];
			$empaqueKO[$key]['peso']        = $empaqueInfo['peso'][$key];
			$empaqueKO[$key]['pesoVol']     = number_format(floatval($empaqueInfo['pesoVol'][$key]),2);
			$empaqueKO[$key]['valor']       = $empaqueInfo['valor'][$key];
			$empaqueKO[$key]['kiloAd']      = $empaqueInfo['kiloAd'][$key];
		}
		$empaque_info = json_encode($empaqueKO);
		$costoSeguro  = $guia['VentasCredito']['valor_seguro'];
		$costoDevol   = $guia['VentasCredito']['valor_devolucion'];
		$this->set(compact('recibo','cantidadCheck','costoDevol','costoSeguro','empaques','data','empaque_info'));
	}

	public function importar(){
		if(!empty($this->data)){
			$file = $this->data['VentasCredito']['excel']['tmp_name'];
			move_uploaded_file($file, 'files/excel/'.$this->data['VentasCredito']['excel']['name']);
			if(!empty($file)){
				$dataExcel = $this->Excel->readVenta('files/excel/'.$this->data['VentasCredito']['excel']['name']);				
			}
			$user     = $this->Auth->user();
			$user     = $this->VentasCredito->importModel('User')->read(null,$user['id']);
			$cliente  = $this->VentasCredito->importModel('Cliente')->read(null,$user['User']['cliente_id']);
			$rem      = $this->VentasCredito->importModel('Venta')->find('first', array('order' => array('Venta.id' =>'desc'),'fields'=>'Venta.id'));
			$remesa   = floatval($rem['Venta']['id'])+1;
			$ventas   = array();
			$destinos = $this->VentasCredito->importModel('Destino')->find('list');
			$empaqueInfo = array();
			$remi = $dataExcel[0][4];
			foreach ($dataExcel as $key => $value) {
				if($value[20] == "SOBRE"){
					$empaqueInfo['empaques'][] = '1';
				} else if($value[20] == "PAQUETE"){
					$empaqueInfo['empaques'][] = '2';
				} else if($value[20] == "CAJA"){
					$empaqueInfo['empaques'][] = '3';
				} else if($value[20] == "OTROS"){
					$empaqueInfo['empaques'][] = '5';
				}
				$empaqueInfo['cantidad'][] = $value[23];
				$empaqueInfo['largo'][]    = $value[25];
				$empaqueInfo['ancho'][]    = $value[26];
				$empaqueInfo['alto'][]     = $value[27];
				$empaqueInfo['peso'][]     = $value[24]*$value[23];
				$empaqueInfo['pesoVol'][]  = '0';
				$empaqueInfo['valor'][]    = '0';
				$empaqueInfo['kiloAd'][]   = '0';
				$empaqueInfo['subtotal'][] = '0';

				if($remi != $value[4] || (count($dataExcel) == ($key+1))){
					$guia['VentasCredito']['oficina']        = $user['User']['oficina_id'];
					$guia['VentasCredito']['remesa']         = $user['User']['oficina_id'].$user['User']['codigo'].'-'.($key+$remesa);
					$guia['VentasCredito']['documento1']     = $value[0];
					$guia['VentasCredito']['documento2']     = $value[2];
					$guia['VentasCredito']['documento3']     = $value[3];
					$guia['VentasCredito']['tipo']           = $value[1];
					$guia['VentasCredito']['cliente']        = $user['User']['cliente_id'];
					$guia['VentasCredito']['contacto']       = $value[10];
					$guia['VentasCredito']['origen']         = array_search($value[11], $destinos);
					$guia['VentasCredito']['destino']        = array_search($value[12], $destinos);
					if($value[30] == "SI"){
						$guia['VentasCredito']['firmado']        = "Si";
					} else {
						$guia['VentasCredito']['firmado']        = "No";
					}
					$guia['VentasCredito']['contenido']      = $value[29];
					$guia['VentasCredito']['fecha']          = date("Y-m-d");
					$guia['VentasCredito']['hora']           = date("H:i:s");
					$guia['VentasCredito']['declarado']      = $value[28];
					$guia['VentasCredito']['empaque_info']   = json_encode($empaqueInfo);
					$guia['VentasCredito']['usuario']        = $user['User']['id'];
					$guia['VentasCredito']['faxDest']        = $value[19];
					$guia['VentasCredito']['emailDest']      = $value[18];
					$guia['VentasCredito']['telefono2Dest']  = $value[17];
					$guia['VentasCredito']['telefonoDest']   = $value[16];
					$guia['VentasCredito']['direccionDest']  = $value[15];
					$guia['VentasCredito']['nombreDest']     = $value[14];
					$guia['VentasCredito']['documentoDest']  = $value[13];
					$guia['VentasCredito']['emailRemi']      = $value[9];
					$guia['VentasCredito']['celularRemi']    = $value[7];
					$guia['VentasCredito']['telefonoRemi']   = $value[8];
					$guia['VentasCredito']['direccionRemi']  = $value[6];
					$guia['VentasCredito']['nombreRemi']     = $value[5];
					$guia['VentasCredito']['documentoRemi']  = $value[4];
					$guia['VentasCredito']['faxClien']       = $cliente['Cliente']['fax'];
					$guia['VentasCredito']['emailClien']     = $cliente['Cliente']['email'];
					$guia['VentasCredito']['telefono2Clien'] = $cliente['Cliente']['telefono2'];
					$guia['VentasCredito']['telefonoClien']  = $cliente['Cliente']['telefono'];
					$guia['VentasCredito']['direccionClien'] = $cliente['Cliente']['direccion'];
					$guia['VentasCredito']['nombreClien']    = $cliente['Cliente']['listNombre'];
					$guia['VentasCredito']['documentoClien'] = $cliente['Cliente']['documento'];
					$guia['VentasCredito']['clase']          = 'Credito';
					$guia['VentasCredito']['despachada']     = $user['User']['oficina_id'];
					$ventas[] = $guia;
					$empaqueInfo = array();
				}

			}
			//$ventas[] = $guia;
			$this->log($ventas);
			if($this->VentasCredito->saveAll($ventas)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La importación se guardo con exito.'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La importación no se puedo guardar.'));
			}
		}
	}
}
?>

<?php
class VentasEspecialRepreController extends AppController {
	public $name = 'VentaEspecialRepre';

	public function crear() {
		$this->layout = "grey";

		$clientes       = $this->VentaEspecialRepre->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1,'Cliente.Especial'=>'Si')));
		$clientesD      = $this->VentaEspecialRepre->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'conditions'=>array('Cliente.id >'=>1,'Cliente.Especial'=>'Si')));
		$clientesN      = $this->VentaEspecialRepre->importModel('Cliente')->find('list',array('fields'=>array('Cliente.listNombre'),'conditions'=>array('Cliente.id >'=>1,'Cliente.Especial'=>'Si')));
		
		if(!empty($this->data)){
			$this->request->data['VentaEspecialRepre']['fecha'] = date("Y-m-d");
			$this->request->data['VentaEspecialRepre']['hora']  = date("H:i:s");
			$empaqueInfo = array();
			$this->request->data['VentaEspecialRepre']['nombreClien']    = $clientesN[$this->data['VentaEspecialRepre']['nombreClien']];
			$this->request->data['VentaEspecialRepre']['documentoClien'] = $clientesD[$this->data['VentaEspecialRepre']['documentoClien']];
			$user         = $this->Auth->user();
			$user         = $this->VentaEspecialRepre->importModel('User')->read(null,$user['id']);
			$this->request->data['VentaEspecialRepre']['despachada'] = $user['Oficina']['id'];
			$this->request->data['VentaEspecialRepre']['clase']      = 'Especial';
			$empaqueInfo['empaques'] = $this->data['VentaEspecialRepre']['empaques'];
			$empaqueInfo['barras']      = $this->data['VentaEspecialRepre']['cbarras'];
			$empaqueInfo['descripcion'] = $this->data['VentaEspecialRepre']['descripcion'];
			$empaqueInfo['cantidad'] = $this->data['VentaEspecialRepre']['cantidad'];
			$empaqueInfo['largo']    = $this->data['VentaEspecialRepre']['largo'];
			$empaqueInfo['ancho']    = $this->data['VentaEspecialRepre']['ancho'];
			$empaqueInfo['alto']     = $this->data['VentaEspecialRepre']['alto'];
			$empaqueInfo['peso']     = $this->data['VentaEspecialRepre']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['VentaEspecialRepre']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['VentaEspecialRepre']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['VentaEspecialRepre']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['VentaEspecialRepre']['subtotal'];
			$this->request->data['VentaEspecialRepre']['empaque_info'] = json_encode($empaqueInfo);

			$user           = $this->Auth->user();
			$user           = $this->VentaEspecialRepre->importModel('User')->read(null,$user['id']);
			$remesa         = $user['Oficina']['codigo'].$user['User']['codigo'].floatval($user['Oficina']['consecutivo']);
			
			$this->request->data['VentaEspecialRepre']['facturacion'] = "";
			$this->request->data['VentaEspecialRepre']['remesa']      = $remesa;
			$this->request->data['Venta'] = $this->data['VentaEspecialRepre'];

			App::import('model', 'Venta');
        	$ventaImport = new Venta();

			if($ventaImport->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La venta se guardo con exito.'));
				$Remite = $this->data['VentaEspecialRepre']['checkRemitente'];
				$Archiv = $this->data['VentaEspecialRepre']['checkArchivo'];
				$Destin = $this->data['VentaEspecialRepre']['checkDestinatario'];
				$Prueba = $this->data['VentaEspecialRepre']['checkPrueba'];
				$this->redirect(array('action' => 'imprimir',$this->VentaEspecialRepre->id,$Remite,$Archiv,$Destin,$Prueba));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La venta no se puedo guardar.'));
			}
		}
		$user           = $this->Auth->user();
		$user           = $this->VentaEspecialRepre->importModel('User')->read(null,$user['id']);
		$remesa         = $user['Oficina']['codigo'].$user['User']['codigo'].floatval($user['Oficina']['consecutivo']);
		$tipo           = $this->VentaEspecialRepre->getEnumValues('tipo');
		$firmado        = $this->VentaEspecialRepre->getEnumValues('firmado');
		$destinos       = $this->VentaEspecialRepre->importModel('Destino')->find('list');
		$empaques       = $this->VentaEspecialRepre->importModel('Empaque')->find('list');
		
		$remitentes     = $this->VentaEspecialRepre->importModel('Remitente')->find('all',array('recursive'=>-1));
		$remitentesD    = $this->VentaEspecialRepre->importModel('Remitente')->find('list',array('fields'=>array('Remitente.documento')));
		$remitentesNom  = $this->VentaEspecialRepre->importModel('Remitente')->find('list',array('fields'=>array('Remitente.nombre')));
		
		$destinatarios  = $this->VentaEspecialRepre->importModel('Destinatario')->find('all',array('recursive'=>-1));
		$destinatariosD = $this->VentaEspecialRepre->importModel('Destinatario')->find('list',array('fields'=>array('Destinatario.documento')));

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
			$tarifas    = $this->VentaEspecialRepre->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
			$convenios  = $this->VentaEspecialRepre->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
			if($cliente != 1){
				$tarifasB   = $this->VentaEspecialRepre->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>1)));
				$conveniosB = $this->VentaEspecialRepre->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>1)));
			} else {
				$tarifasB   = $tarifas;
				$conveniosB = $convenios;
			}
		}
		
		$reca         = $this->VentaEspecialRepre->importModel("Representantexdestino")->find('all',array('conditions'=>array('Representantexdestino.destino_id'=>$destino)));
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
		$venta               = $this->VentaEspecialRepre->read(null,$id);
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
		$envio['guia']         = $venta['VentaEspecialRepre']['remesa'];
		$oficinaB              = $this->VentaEspecialRepre->importModel('Oficina')->find('first',array('recursive'=>-1,'fields'=>array('nombre','hasta','desde','resolucion','prefijo','codigo'),'conditions'=>array('Oficina.id'=>$venta['VentaEspecialRepre']['oficina'])));
		$envio['oficina']      = $oficinaB['Oficina']['nombre'];
		$envio['resolucion']   = 'Res. '.$oficinaB['Oficina']['resolucion'].' Autoriza del: '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['desde'].' al '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['hasta'];
		$envio['fecha']        = $venta['VentaEspecialRepre']['fecha'];
		$envio['vence']        = $venta['VentaEspecialRepre']['fecha'];
		$envio['factura']      = $venta['VentaEspecialRepre']['facturacion'];
		$envio['servicio']     = 'Envío de Encomiendas';
		$envio['docRef']       = $venta['VentaEspecialRepre']['tipo'].' '.$venta['VentaEspecialRepre']['documento1'];
		$envio['hora']         = $venta['VentaEspecialRepre']['hora'];
		$envio['cliente']      = $venta['VentaEspecialRepre']['nombreClien'];
		$envio['nit']          = $venta['VentaEspecialRepre']['documentoClien'];
		$envio['direccionC']   = $venta['VentaEspecialRepre']['direccionClien'];
		$envio['telefonoC']    = $venta['VentaEspecialRepre']['telefonoClien'];
		$envio['otro_remi']    = $venta['VentaEspecialRepre']['otro_remi'];
		if($venta['VentaEspecialRepre']['otro_remi'] == 0){
			$envio['otro_remi']  = false;
			$envio['remitente']  = "";
			$envio['nitR']       = "";
			$envio['direccionR'] = "";
			$envio['telefonoR']  = "";
		} else {
			$envio['otro_remi']  = true;
			$envio['remitente']  = $venta['VentaEspecialRepre']['nombreRemi'];
			$envio['nitR']       = $venta['VentaEspecialRepre']['documentoRemi'];
			$envio['direccionR'] = $venta['VentaEspecialRepre']['direccionRemi'];
			$envio['telefonoR']  = $venta['VentaEspecialRepre']['telefonoRemi'];		
		}
		
		$origenB               = $this->VentaEspecialRepre->importModel('Destino')->read(null,$venta['VentaEspecialRepre']['origen']);
		$destinoB              = $this->VentaEspecialRepre->importModel('Destino')->read(null,$venta['VentaEspecialRepre']['destino']);
		$envio['origen']       = $origenB['Destino']['nombre'];
		$envio['destino']      = $destinoB['Destino']['nombre'];
		$destinatarioB         = $this->VentaEspecialRepre->importModel('Destinatario')->read(null,$venta['VentaEspecialRepre']['destinatario']);
		$contactoB             = json_decode($destinatarioB['Destinatario']['contacto'],true);
		$envio['destinatario'] = $venta['VentaEspecialRepre']['nombreDest'];
		$envio['ced']          = $venta['VentaEspecialRepre']['documentoDest'];
		$envio['direccionD']   = $venta['VentaEspecialRepre']['direccionDest'];
		$envio['telefonoD1']   = $venta['VentaEspecialRepre']['telefonoDest'];
		$envio['telefonoD2']   = $venta['VentaEspecialRepre']['telefono2Dest'];
		$envio['contacto']     = $contactoB[0]['nombre'];
		$empaques_info         = json_decode($venta['VentaEspecialRepre']['empaque_info'],true);
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
			$empaqueB = $this->VentaEspecialRepre->importModel('Empaque')->read(null, $empaqueAct);
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

		$envio['barras']      = $venta['VentaEspecialRepre']['barras'];
		$envio['observacion'] = $venta['VentaEspecialRepre']['observaciones'];
		$envio['contenido']   = $venta['VentaEspecialRepre']['contenido'];
		$decla = str_replace(".",",",str_replace(",","",$venta['VentaEspecialRepre']['declarado']));
		$envio['valorDecla']  = number_format(floatval($decla),0,'.',',');
		$envio['valorFlete']  = number_format($sumaFlete,0,'.',',');

		$usuarioB = $this->VentaEspecialRepre->importModel('User')->read(null,$venta['VentaEspecialRepre']['usuario']);
		$envio['nombre']       = $usuarioB['User']['name'].' '.$usuarioB['User']['lastname'];
		$envio['formaPago']    = 'CONTADO';
		$envio['kiloAd']       = number_format($venta['VentaEspecialRepre']['kilo_adic'],0,'.',',');
		$envio['valorKiloAd']  = number_format($venta['VentaEspecialRepre']['valor_kilo_adic'],0,'.',',');
		$envio['descFlete']    = number_format($venta['VentaEspecialRepre']['desc_flete'],0,'.',',');
		$envio['descKilo']     = number_format($venta['VentaEspecialRepre']['desc_kilo'],0,'.',',');
		$envio['valorFirmado'] = number_format($venta['VentaEspecialRepre']['valor_devolucion'],0,'.',',');
		$envio['valorSeguro']  = number_format($venta['VentaEspecialRepre']['valor_seguro'],0,'.',',');
		$envio['valorTotal']   = number_format($venta['VentaEspecialRepre']['valor_total'],0,'.',',');
		$envio['kiloNegoc']    = $venta['VentaEspecialRepre']['kilo_nego'];

		$this->set(compact('envio'));
	//	$this->layout = 'pdf'; 
	//	$this->render(); 
	}




}
?>
